<x-layout>
    {{-- <div class="container-fluid p-5 bg-info">
        <div class="row justify-content-center">
            <h1 class="text-center display-1">Tutti gli articoli</h1>
        </div>  
    </div> --}}
    <x-header title="Tutti gli articoli"/>
    <div class="container-fluid  my-5">
        @if (session('message'))
        <div class="alert alert-success text-center">
            {{session('message')}}
        </div>
        @endif
        <div class="row  justify-content-around">
            @foreach ($articles as $article)
            {{-- <div class="col-12 col-md-5 col-lg-4 col-xl-3 d-flex justify-content-center my-4 "> --}}
                <div class="col-7 col-md-7 col-lg-7 col-xl-7 d-flex justify-content-center my-4">
                    
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
                                    <div class="col-6  ">
                                        <p class="ms-3 mt-2">Redatto il: {{$article->created_at->format('d/m/Y')}} </p>
                                    </div>
                                    <div class="col-6 d-flex align-items-center justify-content-end pe-2">
                                        <p class="mt-2">da: <a href="{{route('article.byUser',['user'=>$article->user->id])}}" class="small fontWeightBold text-muted fst-italic text-capitalize">{{$article->user->name}}</a></p>
                                        <a href="{{route('article.show' , compact('article'))}}" class="ms-5 my-2 btn btn-outline-dark ">Leggi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                    </div>
                    @endforeach
                </div>  
            </div>
            {{-- pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links('pagination') }}
            </div>
        </x-layout>