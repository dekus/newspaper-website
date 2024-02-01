<nav class="  navbar navbar-expand-lg ">
    <div class="container-fluid d-flex justify-content-between my-2">
        
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 ms-3 ">
                <a class="navbar-brand LogoNav" href="#">The Aulab Post</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 ms-2  d-flex justify-content-center ">
                {{-- <li class="nav-item">
                            <a class="nav-link" id="openSidebarButton" href="#">Categorie</a>
                        </li> --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            @guest
                            <a class="nav-link" href="{{route('register')}}">Registrati</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Accedi</a>
                        </li>
                        
                        @endguest
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Benvenuto {{Auth::user()->name}}   
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.querySelector('#form-logout').submit()"; >Logout</a></li>
                                <form method="POST" action="{{route('logout')}}" id="form-logout" class="d-none"> 
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('article.create')}}">Crea Articolo</a>
                        </li>
                        @if (Auth::user()->is_admin)
                            <li class="nav-item"><a href="{{route('admin.dashboard')}}" class="nav-link dropdown-item">Dashboard Admin</a></li>
                        @endif
                        @if (Auth::user()->is_revisor)
                            <li class="nav-item"><a href="{{route('revisor.dashboard')}}" class="nav-link ">Dashboard Revisor</a></li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 ps-5   ">
                <form class="d-flex " role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
        
        
        
    </div>
    {{--  --}}
    
    
</nav>