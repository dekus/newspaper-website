<x-layout>
    {{-- <div class="container-fluidn p-5 bg-info">
        <div class="row justify-content-center">
            <h1 class="text-center display-1">{{$article->title}}</h1>
        </div>  
    </div> --}}
    <x-header title="{!!$article->title!!}"/>
        
        
        <div class="container my-5">
            <div class="row justify-content-around">
                <div class="col-12 d-flex justify-content-center">
                    <img  src="{{Storage::url($article->image)}}" alt="" class="img-fluid my-3">
                    
                </div>
                <div class="col-12 col-md-8 ">
                    <div class="text-center">
                        <h2>{{$article->subtitle}}</h2>
                        <div class="my-3 text-muted fst-italic">
                            <p>Redatto da {{$article->user->name}} il {{$article->created_at->format('d/m/Y')}}</p>
                        </div>
                    </div>
                    <hr>
                    <p>{!! nl2br(e($article->body)) !!}</p>
                    <div class="text-center">
                        <a href="{{route('article.index')}}" class="btn btn-outline-dark  my-5">Torna indietro</a>
                    </div>
                    @if (Auth::user() && Auth::user()->is_revisor)
                    <a href="{{route('revisor.acceptArticle', compact('article'))}}" class="btn btnAdmAgg text-white my-5">Accetta articolo</a>
                    <a href="{{route('revisor.rejectArticle', compact('article'))}}" class="btn btnAdmCanc text-white my-5">Rifiuta articolo</a>
                    
                    @endif
                </div>
            </div>  
        </div>
        
        
        
        
    </x-layout>