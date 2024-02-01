<nav class="navbar  navBorderColor bg-dark fixed-top d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand LogoNav  " href="#">The Aulab Post</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            {{-- <span class="navbar-toggler-icon"></span> --}}
            <i class="fa-solid fa-bars fs-1" style="color:#f5e5d5;"></i>
        </button>
        <div class="offcanvas offcanvas-end colorCard" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title LogoNavCanvas" id="offcanvasNavbarLabel">The Aulab Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-dark ">
                <ul class="navbar-nav justify-content-end flex-grow-1  pe-3">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="{{route('homepage')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('careers')}}">Lavora con noi</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('login')}}">Accedi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('register')}}">Registrati</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Benvenuto {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.querySelector('#form-logout').submit()";>Logout</a></li>
                            <form method="POST" action="{{route('logout')}}" id="form-logout" class="d-none"> 
                                @csrf
                            </form>                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('article.create')}}">Crea Articolo</a>
                    </li>
                    @if (Auth::user()->is_admin)
                    <li class="nav-item "><a href="{{route('admin.dashboard')}}" class="nav-link text-white">Dashboard Admin</a></li>
                    @endif
                    @if (Auth::user()->is_revisor)
                    <li class="nav-item"><a href="{{route('revisor.dashboard')}}" class="nav-link  text-white">Dashboard Revisor</a></li>
                    @endif
                    @endauth
                    
                </ul>
                <form class="d-flex mt-3" method="GET" action="{{route('article.search')}}">
                    <input class="form-control colorCard me-2" type="search" name="query" placeholder="Cosa stai cercando?" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<nav class="container-fluid d-none d-lg-block sticky-top navBorderColor bg-dark">
    <div class="row justify-content-between">
        <div class="col-3">
            <a class="navbar-brand LogoNav" href="#">The Aulab Post</a>
        </div>
        <div class="col-7 d-flex justify-content-center me-5">
            <ul class="mb-0 w-75 align-items-center list-unstyled d-flex justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('homepage')}}">Home</a>
                </li>
                <li class="nav-item mx-5">
                    <a class="nav-link text-center" href="{{route('article.index')}}">Tutti gli Articoli</a>
                </li>
                @guest
                <li class="nav-item me-5">
                    <a class="nav-link text-center" href="{{route('register')}}">Registrati</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-center" href="{{route('login')}}">Accedi</a>
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
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('article.create')}}">Crea Articolo</a>
                </li> --}}
                @if (Auth::user()->is_admin)
                <li class="nav-item mx-5"><a href="{{route('admin.dashboard')}}" class="nav-link dropdown-item">Dashboard Admin</a></li>
                @endif
                @if (Auth::user()->is_revisor)
                <li class="nav-item mx-5"><a href="{{route('revisor.dashboard')}}" class="nav-link ">Dashboard Revisor</a></li>
                @endif
                @if (Auth::user()->is_writer)
                <li><a href="{{route('writer.dashboard')}}" class="dropdown-item  mx-5">Dashboard del redattore</a></li>                    
                @endif
                @endauth
            </ul>
        </div>
        <div class="col-1 d-flex justify-content-end align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-1"></i>
            </button>
            
            <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="sidebar" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header colorCard">
                    <h5 class="offcanvas-title LogoNavCanvas" id="offcanvasExampleLabel">The Aulab Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        <ul class="list-unstyled">
                            @auth
                            <li class="nav-item">
                                <a class="nav-link text-white mb-2" href="{{route('article.create')}}">Crea Articolo</a>
                            </li>
                           @endauth
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{route('careers')}}">Lavora con noi</a>
                            </li>

                        </ul>
                        
                    </div>
                    <form class="d-flex mt-3" method="GET" action="{{route('article.search')}}">
                        <input class="form-control colorCard me-2" type="search" name="query" placeholder="Cosa stai cercando?" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Cerca</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>