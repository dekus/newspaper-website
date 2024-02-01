<?php

use App\Models\User;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('two_factor_secret')
                ->after('password')
                ->nullable();

            $table->text('two_factor_recovery_codes')
                ->after('two_factor_secret')
                ->nullable();

            $table->boolean('is_admin')->after('email')->nullable()->default(false);
            $table->boolean('is_revisor')->after('is_admin')->nullable()->default(false);
            $table->boolean('is_writer')->after('is_revisor')->nullable()->default(false);

            
            if (Fortify::confirmsTwoFactorAuthentication()) {
                $table->timestamp('two_factor_confirmed_at')
                ->after('two_factor_recovery_codes')
                ->nullable();
            }
            
        });
        $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@theaulabpost.it',
        'password' => bcrypt('12345678'),
        'is_admin' => true,
    ]);
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email', 'admin@theaulabpost.it')->delete();

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin','is_revisor','is_writer']);  //forse va nello stesso dropColumn
            $table->dropColumn(array_merge([
                'two_factor_secret',
                'two_factor_recovery_codes',
            ], Fortify::confirmsTwoFactorAuthentication() ? [
                'two_factor_confirmed_at',
            ] : []));


        });
    }
};
