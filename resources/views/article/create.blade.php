<x-layout>
    {{-- <div class="container-fluid bg-info p-5 text-center text-white">
        <div class="row justify-content-center">
            <h1 class="text-center display-1">Gli aticloli piu recenti</h1>
        </div>  
    </div> --}}
    <x-header title="Crea un nuovo articolo"/>
    <div class="container-fluid my-5 ">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                
                @endif
                <form class="card FormColor p-5 shadow" method="POST" action="{{route('article.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title"  class="form-label">Titolo</label>
                        <input type="text" class="form-control FormInputColor" name="title" id="title" value="{{old('title')}}">
                    </div>
                    <div class="mb-3">
                        <label  for="subtitle" class="form-label">Sottotitolo</label>
                        <input type="text" class="form-control FormInputColor" name="subtitle" id="subtitle" value="{{old('subtitle')}}">
                    </div>
                    <div class="mb-3">
                        <label  for="image" class="form-label">Immagine</label>
                        <input type="file" class="form-control FormInputColor" name="image" id="image" value="{{old('image')}}">
                    </div>
                    <div class="mb-3">
                        <label  for="category" class="form-label">Categoria</label>
                        <select name="category" id="category" class="form-control FormInputColor text-capitalize">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label  for="body" class="form-label">Corpo del testo</label>
                        <textarea class="form-control FormInputColor" name="body" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label  for="tags" class="form-label">Tags:</label>
                        <input  class="form-control FormInputColor" name="tags" id="tags" value="{{old('tags')}}">
                        <span class="small fst-italic">Dividi ogni tag con una virgola</span>
                    </div>
                    
                    <div class="mt-2">
                        <button class="btn btn-outline-dark FormInputColor">Inserisci un articolo</button>
                        <span>
                            <a class="btn btn-dark ms-2" href="{{route('homepage')}}">Torna alla home</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>  
    </div>
    
</x-layout>