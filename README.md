# Newspaper Website

Laravel-based online newspaper platform. Users register, request writer status, submit articles with title, body, category, tags, and media. A revisor role reviews the queue and either publishes or rejects each submission. Approved articles appear on the public site. Administrators manage users, roles, and categories.

Standard Laravel stack: MVC controllers, Eloquent models, Blade views, Fortify for authentication. No JavaScript SPA layer, just server-rendered Blade with a small `resources/js` bundle for the frontend polish.

## Role Model

Four roles, each with its own controller and view namespace:

| Role     | Can                                                                                     |
| -------- | --------------------------------------------------------------------------------------- |
| Guest    | Read published articles, browse categories, register.                                   |
| User     | Read + request writer status ("Careers").                                               |
| Writer   | Create, edit, and submit articles for review.                                           |
| Revisor  | Approve or reject articles in the review queue.                                         |
| Admin    | Full control: users, roles, categories, tags, articles.                                 |

The `is_accepted` column on `articles` gates public visibility. A revisor flips it; the public feed queries on it.

## Repository Layout

```
newspaper-website/
├── .github/
├── README.md
├── app/
│   ├── Actions/                # Fortify actions (registration, password update)
│   ├── Console/                # Artisan command stubs
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Kernel.php
│   │   ├── Middleware/
│   │   └── Controllers/
│   │       ├── AdminController.php     # user + role + category management
│   │       ├── ArticleController.php   # CRUD on articles
│   │       ├── Controller.php          # base controller
│   │       ├── PublicController.php    # public feed, article detail, careers page
│   │       ├── RevisorController.php   # review queue, accept/reject
│   │       └── WriterController.php    # writer dashboard
│   ├── Mail/                   # queued mail (writer request, article accepted/rejected)
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Category.php
│   │   ├── Tag.php
│   │   └── User.php
│   └── Providers/
├── bootstrap/
├── config/                     # Laravel config (auth, database, fortify, mail, ...)
├── database/
│   ├── factories/
│   └── migrations/
│       ├── 2014_10_12_000000_create_users_table.php
│       ├── 2014_10_12_100000_create_password_reset_tokens_table.php
│       ├── 2014_10_12_200000_add_two_factor_columns_to_users_table.php
│       ├── 2019_08_19_000000_create_failed_jobs_table.php
│       ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│       ├── 2024_01_18_150958_create_categories_table.php
│       ├── 2024_01_18_151844_create_articles_table.php
│       ├── 2024_01_23_110544_create_care_table.php
│       ├── 2024_01_23_163833_add_is_accepted_to_articles_table.php
│       ├── 2024_01_26_090250_create_tags_table.php
│       ├── 2024_01_26_090520_create_article_tag_table.php
│       └── 2024_01_30_140622_add_slug_to_articles_table.php
└── resources/
    ├── css/
    ├── js/
    └── views/
        ├── admin/
        ├── article/
        ├── auth/
        ├── components/
        ├── mail/
        ├── revisor/
        ├── writer/
        ├── careers.blade.php
        ├── pagination.blade.php
        └── welcome.blade.php
```

## Data Model

Migrations map to four core models:

* `users` (+ `password_reset_tokens`, two-factor columns, personal_access_tokens for Sanctum).
* `categories` (title, slug).
* `articles` (title, body, image, category_id, user_id, `is_accepted`, `slug`).
* `tags` + pivot `article_tag`.
* `care` (writer applications, aka the "Careers" queue).

Relationships wired in the Eloquent models:

* `User hasMany Article`.
* `Article belongsTo Category` and `belongsTo User`.
* `Article belongsToMany Tag` through `article_tag`.

## Requirements

* **PHP 8.1+** (Laravel 10 baseline).
* **Composer 2.x**.
* **Node.js 16+ and npm** for Vite asset compilation.
* **MySQL 8+ / MariaDB 10.4+** (SQLite works if you swap `.env`).
* Web server: local dev via `php artisan serve`, production via Nginx or Apache with a public document root pointed at `/public`.

The repo does not ship `composer.json`, `package.json`, `.env.example`, `public/`, `routes/`, or `storage/` in the tree browsed here. These are standard Laravel scaffolding: initialize them with the steps below.

## Installation

### 1. Clone

```bash
git clone https://github.com/dekus/newspaper-website.git
cd newspaper-website
```

### 2. Restore Laravel scaffolding (if missing)

If the checkout does not include `composer.json`, `routes/`, or `public/`, drop this app into a fresh Laravel skeleton:

```bash
composer create-project laravel/laravel:^10.0 fresh
```

Copy the `app/`, `resources/`, `config/`, `database/` folders from this repo over the fresh skeleton, keeping the skeleton's `composer.json`, `public/`, `routes/`, `storage/`, `.env.example`, `vite.config.js`, `package.json`.

Then install:

```bash
composer install
npm install
```

### 3. Environment

Copy the example env and generate an app key:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```env
APP_NAME="Newspaper"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newspaper
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@newspaper.local"
MAIL_FROM_NAME="${APP_NAME}"

FILESYSTEM_DISK=public
```

### 4. Database

Create the schema, then run migrations:

```bash
mysql -u root -p -e "CREATE DATABASE newspaper CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate
```

If `database/seeders/` exists in your fork, seed roles and a starter admin:

```bash
php artisan db:seed
```

Otherwise create the first admin manually via `tinker`:

```bash
php artisan tinker
>>> \App\Models\User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'is_admin' => true]);
```

Adjust the field to match whatever column your `User` model uses for the admin flag (`role`, `is_admin`, or a `roles` pivot).

### 5. Storage

Link the public disk so uploaded article images are reachable:

```bash
php artisan storage:link
```

### 6. Assets

```bash
npm run build         # production
# or
npm run dev           # Vite dev server with HMR
```

### 7. Serve

Local:

```bash
php artisan serve
```

Then open `http://localhost:8000`.

Production: point Nginx / Apache at `public/`. Set `APP_ENV=production`, `APP_DEBUG=false` in `.env`.

## Common Flows

### Reader

Land on `/`. Browse the paginated feed, category filters, and individual article pages. All content is served by `PublicController`.

### Writer application (Careers)

1. User signs up, logs in.
2. Visits `/careers`, submits a writer application.
3. Application lands in the `care` table.
4. Admin reviews from `admin/` views and promotes the user.

### Article submission

1. Writer opens their dashboard (`writer/` views).
2. Uses `ArticleController@create` to draft: title, body, category, tags, image upload.
3. Save creates an `articles` row with `is_accepted = null` (pending).
4. Article enters the revisor queue.

### Review

1. Revisor opens the review dashboard (`revisor/` views).
2. `RevisorController` lists pending articles.
3. Accept sets `is_accepted = 1`, article now surfaces on the public feed.
4. Reject sets `is_accepted = 0` (or deletes, depending on the controller action). Mail is sent to the writer from `app/Mail/`.

### Admin

`admin/` views expose CRUD on users, categories, tags. `AdminController` handles role changes.

## Configuration Notes

* **Fortify**: Laravel Fortify handles registration, login, password reset, and two-factor scaffolding. Views live under `resources/views/auth/`. Configure feature flags in `config/fortify.php`.
* **Scout**: `config/scout.php` is present, so article search is expected to run through Laravel Scout. Pick a driver (`database`, `meilisearch`, `algolia`) and set `SCOUT_DRIVER` in `.env`. The `database` driver needs no extra service.
* **Sanctum**: token guard configured. Not required unless you plan to expose an API.
* **CORS**: `config/cors.php` present. Tune allowed origins if you front the site with a separate domain for admin or API.

## Notes and Limits

* Language: originally built in Italian (view labels, mail templates, controller comments may all be in Italian).
* Migration name `create_care_table` is intentional. The "Careers" table stores writer applications.
* `articles.slug` was added late (`2024_01_30_140622_add_slug_to_articles_table.php`). Backfill slugs for any existing rows before deploying.
* Two-factor auth is scaffolded via Fortify but not necessarily wired into the UI. Enable in `config/fortify.php` if you want it live.
* Public routes and admin routes are almost certainly split. Do not expose the revisor / admin routes to unauthenticated users; verify `routes/web.php` middleware groups after restoring scaffolding.
* No CI in `.github/` beyond what may already exist. Add a Laravel Pint + PHPStan pipeline if you plan collaborators.
