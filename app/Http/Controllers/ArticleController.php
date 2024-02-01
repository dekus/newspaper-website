<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show','byCategory','byUser');
    }


    public function destroy(Article $article)
    {
        foreach($article->tags as $tag){
            $article->tags()->detach($tag);
        }

        $article->delete();

        return redirect(route('writer.dashboard'))->with('message', 'Hai correttamente cancellato l\'articolo scelto');
    }


    public function update(Request $request, Article $article){
        // dd($request->all(), $article);
        $request->validate([
            'title' => 'required|min:5|unique:articles,title,' . $article->id,
            'subtitle' => 'required|min:5|unique:articles,subtitle,' . $article->id,
            'body' => 'required|min:10',
            'image' => 'image',
            'category' => 'required',
            'tags' => 'required',
        ]);

        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title),
            'is_accepted' => NULL
        ]);

        

        if ($request->image) {
            Storage::delete($article->image);
            $article->update([
                'image' => $request->file('image')->store('public/images'),
            ]);
        }

        $tags = explode(', ', $request->tags);
        $newTags = [];

        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate([
                'name' => $tag,
            ]);
            $newTags[] = $newTag->id;
        }

        $article->tags()->sync($newTags);

        return redirect(route('writer.dashboard'))->with('message', 'Hai correttamente aggiornato l\'articolo scelto');


    }

    public function edit(Article $article){

        return view('article.edit', compact('article'));
    }
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(10);

        // Limita la lunghezza del testo di ciascun articolo
        $articles->getCollection()->transform(function ($article) {
            // Verifica se il contenuto esiste e se è una stringa prima di procedere
            if ($article->body && is_string($article->body)) {
                // Limita la lunghezza del testo solo se è più lungo di 50 caratteri
                $article->body = strlen($article->body) > 50 ? substr($article->body, 0, 450) . '...': $article->body;
            }

            return $article;
        });

        return view('article.index', compact('articles'));
    }


    public function articleSearch(Request $request){
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->orderBy('created_at', 'desc')->get();

        $articles->transform(function ($article) {
            // Verifica se il contenuto esiste e se è una stringa prima di procedere
            if ($article->body && is_string($article->body)) {
                // Limita la lunghezza del testo solo se è più lungo di 50 caratteri
                $article->body = strlen($article->body) > 50 ? substr($article->body, 0, 450) . '...' : $article->body;
            }

            return $article;
        });

        return view('article.search-index', compact('articles', 'query'));
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('article.create');
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articles|min:5',
            'subtitle' => 'required|unique:articles|min:5',
            'body' => 'required|min:10',
            'image' => 'image|required',
            'category' => 'required',
            'tags' => 'required',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'image' => $request->file('image')->store('public/images'),
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->title),
        ]);

        $tags =explode(', ', $request->tags);

        foreach($tags as $tag){
            $newTag = Tag::updateOrCreate([
                'name'=>$tag,
            ]);

            $article->tags()->attach($newTag);
        }

        
        return redirect()->route('homepage')->with('message','Articolo creato con successo');
    }
    
    /**
    * Display the specified resource.
    */
    public function show(Article $article)
    {
        
        return view('article.show',compact('article')); 
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()
            ->where('is_accepted', true)
            ->orderByDesc('created_at') // Ordina gli articoli per data di creazione in modo decrescente
            ->paginate(6);

        // Limita la lunghezza del testo di ciascun articolo
        $articles->getCollection()->transform(function ($article) {
            // Verifica se il contenuto esiste e se è una stringa prima di procedere
            if ($article->body && is_string($article->body)) {
                // Limita la lunghezza del testo solo se è più lungo di 50 caratteri
                $article->body = strlen($article->body) > 50 ? substr($article->body, 0, 450) . '...' : $article->body;
            }

            return $article;
        });

        return view('article.by-category', compact('category', 'articles'));
    }

    

    public function byWriter(User $user){
        $articles = $user->articles->sortByDesc('created_at')->filter(function($article){
        return $article->is_accepted == true;
    });
        return view('article.by-user', compact('user', 'article'));
}

    public function byUser(User $user , Article $article)
    {
        $articles = $user->articles()
        ->where('is_accepted', true)
        ->orderByDesc('created_at')
        ->paginate(6);

        // Limita la lunghezza del testo di ciascun articolo
        $articles->getCollection()->transform(function ($article) {
            // Verifica se il contenuto esiste e se è una stringa prima di procedere
            if ($article->body && is_string($article->body)) {
                // Limita la lunghezza del testo solo se è più lungo di 50 caratteri
                $article->body = strlen($article->body) > 50 ? substr($article->body, 0, 450) . '...' : $article->body;
            }

            return $article;
        });
        return view('article.by-user', compact('user' , 'articles'));
    }
    
  
}
