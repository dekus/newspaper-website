<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\CareerRequestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('homepage');
    }
    
    public function homepage()
    {

        // $articles = Article::orderBy('created_at', 'desc')->take(10)->get();

        $articles = Article::where('is_accepted', true)
        ->orderBy('created_at', 'desc')
        // sostituito il take con il paginate
        ->paginate(6);

        $articles->getCollection()->transform(function ($article) {
            // Verifica se il contenuto esiste e se è una stringa prima di procedere
            if ($article->body && is_string($article->body)) {
                // Limita la lunghezza del testo solo se è più lungo di 50 caratteri
                $article->body = strlen($article->body) > 50 ? substr($article->body, 0, 450) . '...' : $article->body;
            }

            return $article;
        });

        return view('welcome',compact('articles'));
    }
    
    public function careers(){
        return view('careers');
    }
    
    public function careersSubmit(Request $request){
        
        $request->validate([
            'role'=> 'required',
            'email'=> 'required|email',
            'message'=>'required'
        ]);
        
        $user = Auth::user();
        $role = $request->role;
        $email = $request->email;
        $message = $request->message;
        
        Mail::to('admin@theaulabpost.it')->send(new CareerRequestMail(compact('role', 'email', 'message')));
        
        switch($role) {
            
            case 'admin' : 
                $user->is_admin = NULL;
                break;
            case 'revisor' : 
                $user->is_revisor = NULL;
                break;
            case 'writer' : 
                $user->is_writer = NULL;
                break;
                        
                        
                        
            }

        $user->update();  //Controllare Update
        return redirect(route('homepage')) ->with('message', 'Grazie per averci contattato');
                    
    }
                
                
                
}
            