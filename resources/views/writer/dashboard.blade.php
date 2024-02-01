<x-layout>
    <x-header title="Bentornato Redattore" />

    @if (session('message'))
        <div class="alert alert-success text-center">
            {{session('message')}}
        </div>
        
    @endif
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Articoli in fase di revisione</h2>
                <x-writer-articles-table :articles="$unrevisionedArticles" />
            </div>
        </div>
        {{-- @if ($unrevisionedArticles->hasPages() && $unrevisionedArticles->lastPage() > 1)
            <span class="SwitchColor">{{$unrevisionedArticles->links()}}</span>
        @endif --}}
    </div>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Articoli pubblicati</h2>
                <x-writer-articles-table :articles="$acceptedArticles" />
            </div>
        </div>
        {{-- @if ($acceptedArticles->hasPages() && $acceptedArticles->lastPage() > 1)
            <span class="SwitchColor">{{$acceptedArticles->links()}}</span>
        @endif --}}
        </div>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Articoli respinti</h2>
                <x-writer-articles-table :articles="$rejectedArticles" />
            </div>
        </div>
        {{-- @if ($rejectedArticles->hasPages() && $rejectedArticles->lastPage() > 1)
            <span class="SwitchColor">{{$rejectedArticles->links()}}</span>
        @endif --}}
    </div>
    
</x-layout>