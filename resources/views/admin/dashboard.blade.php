<x-layout>
    <x-header title="Benvenuto Amministratore" />
    
    @if (session('message'))
    <div class="alert alert-success text-center">
        {{session('message')}}
    </div>
    
    @endif
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Richieste per ruolo Amministratore</h2>
                <x-request-table :roleRequests="$adminRequests" role="amministratore" />
            </div>
        </div>
        {{-- @if ($adminRequests->hasPages() && $adminRequests->lastPage() > 1)
        <span class="SwitchColor">{{$adminRequests->links()}}</span>
        @endif    --}}
    </div>
    <hr>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Richieste per ruolo Revisore</h2>
                <x-request-table :roleRequests="$revisorRequests" role="revisore" />
            </div>
        </div>
        
        {{-- @if ($revisorRequests->hasPages() && $revisorRequests->lastPage() > 1)
        <span class="SwitchColor">{{$revisorRequests->links()}}</span>
        @endif --}}
    </div>
    <hr>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Richieste per ruolo Redattore</h2>
                <x-request-table :roleRequests="$writerRequests" role="redattore" />
            </div>
        </div>
        {{-- @if ($writerRequests->hasPages() && $writerRequests->lastPage() > 1)
        <span class="SwitchColor">{{$writerRequests->links()}}</span>
        @endif --}}
    </div>
    
    <hr>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>I tags della piattaforma</h2>
                <x-metainfo-table :metaInfos="$tags" metaType="tags" />
            </div>
        </div>
    </div>
    
    <hr>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Le categorie della piattaforma</h2>
                <x-metainfo-table :metaInfos="$categories" metaType="categorie" />
                <form action="{{route('admin.storeCategory')}}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="name" class="form-control me-2 " placeholder="Inserisci una nuova categoria" >
                    <button type="submit" class="btn btnAdmAggCat">Aggiungi</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    
    
    
    
</x-layout>

