<table class="table table-striped table-hover border">
    {{-- colore thead da customizzare  --}}
    <thead class="table-dark">      
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Sottotitolo</th>
            <th scope="col">Redattore</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
       
        
        <tr>
            <th scope="row">{{$article->id}}</th>
            <td>{{$article->title}}</td>
            <td>{{$article->subtitle}}</td>
            <td>{{$article->user->name}}</td>
            <td>
                @if (is_null($article->is_accepted))
                <a href="{{route('article.show', compact('article'))}}" class="btn btnAdmAggCat "> Leggi l'articolo</a>
                @else
                <a href="{{route('revisor.undoArticle', compact('article'))}}" class="btn btn-secondary text-white"> Riporta in revisione</a>
                @endif
                
                {{-- <button class="btn btn-info text-white">Attiva {{$role}}</button> --}}
                {{-- @switch($role)
                    @case('amministratore')
                    <a href="{{route('admin.setAdmin', compact('user'))}}" class="btn btn-info text-white">Attiva {{$role}}</a>
                    @break
                    @case('revisore')
                    <a href="{{route('admin.setRevisor', compact('user'))}}" class="btn btn-info text-white">Attiva {{$role}}</a>
                    @break
                    @case('redattore')
                    <a href="{{route('admin.setWriter', compact('user'))}}" class="btn btn-info text-white">Attiva {{$role}}</a>
                    @break
                    @default
                    
                    
                    
                    @endswitch --}}
                </td>
            </tr>
            
            @endforeach
            
            
            
             
            
        </tbody>
    </table>
       