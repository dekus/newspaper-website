<x-layout>
    
    <x-header title="Notizie del giorno"/>
    
    <div class="container-fluid  my-5">
        @if (session('message'))
        <div class="alert alert-success text-center">
            {{session('message')}}
        </div>
        @endif
        <div class="row  justify-content-center">
            @foreach ($articles as $article)
            <div class="col-12 col-md-7 col-lg-9 col-xl-9 my-4 d-flex justify-content-center ">
                
                <div class="card shadow colorCard mb-3" style="width: 100%" >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="ImgCardSize"  src="{{Storage::url($article->image)}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$article->title}}</h5>
                                <p class="card-text fontWeightBold">{{$article->subtitle}}</p>
                                <p class="card-text">{{$article->body}}</p>
                                
                                @if ($article->category)
                                
                                <a href="{{route('article.byCategory', ['category' => $article->category->id])}}" class=" my-2 ms-3 small fontWeightBold text-muted fst-italic text-capitalize ms-2">
                                    {{$article->category->name}}</a>
                                    @else
                                    <p class="small text-muted fst-italic text-capitalize"> Non Categorizzato</p>
                                    @endif
                                </div>
                                <span class="ms-3 mb-2 text-muted small fst-italic">tempo di lettura {{$article->readDuration()}} min</span>
                                <p class=" ms-3 small fst-italic text text-capitalize">
                                    @foreach ($article->tags as $tag)
                                    #{{$tag->name}}        
                                    @endforeach
                                </p>
                                
                            </div>
                            <div class=" col-12 p-0 card-footer text-muted d-flex justify-content-between align-items-center">
                                <div class="col-6 ">
                                    <p class="ms-3">Redatto il: {{$article->created_at->format('d/m/Y')}} </p>
                                </div>
                                <div class="col-6 d-flex justify-content-end pe-2">
                                    <p>da: <a href="{{route('article.byUser',['user'=>$article->user->id])}}" class="small fontWeightBold text-muted fst-italic text-capitalize">{{$article->user->name}}</a></p>
                                    <a href="{{route('article.show' , compact('article'))}}" class="ms-5 my-2 btn btn-outline-dark ">Leggi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>  
        </div>
        {{-- aggiunto in pausa --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links('pagination') }}
        </div>
        
    </x-layout>
    
    
    