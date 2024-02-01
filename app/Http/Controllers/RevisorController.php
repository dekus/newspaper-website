<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function dashboard(){
        // $unrevisionedArticles = Article::where('is_accepted', NULL)->paginate(3);
        // $rejectedArticles = Article::where('is_accepted', false)->paginate(3);
        $unrevisionedArticles = Article::where('is_accepted', NULL)->orderBy('created_at', 'desc')->get();
        // $acceptedArticles = Article::where('is_accepted', true)->();
        $rejectedArticles = Article::where('is_accepted', false)->orderBy('created_at', 'desc')->get();




        //aggiunto per pagiazione tabelle

        $acceptedArticles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->get();

        // dd($acceptedArticles);





        return view('revisor.dashboard', compact('unrevisionedArticles', 'acceptedArticles', 'rejectedArticles'));

    }

    public function acceptArticle(Article $article){
        $article->update([
            'is_accepted' => true,
        ]);

        return redirect(route('revisor.dashboard'))->with('message', 'Hai accettato l\'articolo scelto');
    }


    public function rejectArticle(Article $article){
        $article->update([
            'is_accepted' => false,
        ]);

        return redirect(route('revisor.dashboard'))->with('message', 'Hai rifiutato l\'articolo scelto');
    }

    public function undoArticle(Article $article){
        $article->update([
            'is_accepted' => NULL,
        ]);

        return redirect(route('revisor.dashboard'))->with('message', 'Hai riportato l\'articolo scelto di nuovo in revisione');
    }
    
}
