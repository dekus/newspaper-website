
<x-layout>
    {{-- <div class="container-fluid bg-success">
        <div class="row justify-content-center">
            <h1 class="text-center display-1">The Aulab Post</h1>
        </div>  
    </div> --}}
    <x-header title="Registrati"/>

    <div class="container ">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 ">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
                
            @endif
            <form class=" my-5 bg-white  border shadow rounded FormColor" method="POST" action="{{route('register')}}">
                @csrf
                <div class="m-3">
                    <label for="username"  class="form-label">Nome</label>
                    <input type="text" class="form-control FormInputColor" placeholder="Nome" name="name" id="username" value="{{old('name')}}">
                </div>
                <div class="m-3">
                    <label  for="email" class="form-label">Email</label>
                    <input type="email" class="form-control FormInputColor" placeholder="Email" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="m-3">
                    <label   class="form-label">Password</label>
                    <input type="password" class="form-control FormInputColor" placeholder="Password" name="password">
                </div>
                <div class="m-3">
                    <label for="password_confimation"  class="form-label">Conferma Password</label>
                    <input type="password" class="form-control FormInputColor" placeholder="Conferma Password" name="password_confirmation" id="password_confirmation">
                </div>
                
                <button type="submit" class="btn btn-outline-dark FormInputColor mx-4">Registrati</button>
                <p class="small mt-2 mx-3">Già registrato?<a href="{{route('login')}}">Clicca qui</a></p>
            </form>
        </div>
    </div>
</div>
</div>
</x-layout>