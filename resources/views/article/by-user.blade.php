<x-layout>
    {{-- <div class="container-fluidn p-5 bg-info">
        <div class="row justify-content-center">
            <h1 class="text-center display-1 text-capitalize">
                Utente {{$user->name}}
            </h1>
        </div>  
    </div> --}}
    <x-header title="Utente {{$user->name}}"/>
        
        
        <div class="container my-5">
            <div class="row justify-content-center">
                @foreach ($articles as $article)
                <div class="col-12 col-md-7 col-lg-9 col-xl-9 my-4 d-flex justify-content-center ">
                    {{-- <div class="card shadow colorCard " style="width: 18rem;">
                        <img src="{{Storage::url($article->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="card-text fontWeightSubtitle">{{$article->subtitle}}</p>                        
                            <p class="card-text">{{$article->body}}</p>                        
                            
                        </div>
                        <a href="{{route('article.byCategory', ['category'=>$article->category->id])}}"class=" my-2 ms-3 small fontWeightBold text-muted fst-italic text-capitalize">
                            {{$article->category->name}}
                        </a>
                        <div class=" col-12 p-0 card-footer text-muted d-flex justify-content-between align-items-center">
                            <div class="col-9 ">
                                <p class="ms-3 mt-3 ">Redatto il:  {{$article->created_at->format('d/m/Y')}} </p>
                            </div>
                            <div class="col-3">
                                <a href="{{route('article.show' , compact('article'))}}" class=" my-2 btn btn-outline-dark ">Leggi</a>
                            </div>
                        </div>
                    </div> --}}
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
                                    
                                    <p class="ms-3 small fst-italic text text-capitalize">
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
                                        <a href="{{route('article.show' , compact('article'))}}" class="ms-5 my-2 btn btn-outline-dark ">Leggi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>  
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links('pagination') }}
            </div>
            
            
            
        </x-layout>