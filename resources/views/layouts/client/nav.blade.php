




<nav class="navbar navbar-expand-lg navbar-theme-custom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <i class="fas fa-utensils me-2"></i>Mon Restaurant
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('/')}}"><i class="fas fa-home me-1"></i>Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/menu')}}"><i class="fas fa-book-open me-1"></i>Menu</a>
                </li>

                @auth('client')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/commande') }}"><i class="fas fa-list me-1"></i>Mes Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/fcaturesclient') }}"><i class="fas fa-file-invoice me-1"></i>Mes Factures</a>
                </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/panier') }}">
                        <i class="fas fa-shopping-cart me-1"></i>Panier
                        <span class="badge bg-danger" id="panier-count">0</span>
                    </a>
                </li>

                {{-- Si client connecté --}}
                @auth('client')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>Compte
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/profileclient') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logoutclient') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                {{-- Si client NON connecté --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>Compte
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/loginclient') }}">Connexion</a></li>
                            <li><a class="dropdown-item" href="{{ url('/registerclient') }}">Inscription</a></li>
                        </ul>
                    </li>
            </ul>
        </div>
    </div>
</nav>





















{{--<nav class="navbar navbar-expand-lg navbar-theme-custom sticky-top">--}}
{{--    <div class="container">--}}
{{--        <a class="navbar-brand" href="{{url('/')}}">--}}
{{--            <i class="fas fa-utensils me-2"></i>Mon Restaurant--}}
{{--        </a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarNav">--}}
{{--            <ul class="navbar-nav me-auto">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" href="{{url('/')}}"><i class="fas fa-home me-1"></i>Accueil</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{url('/menu')}}"><i class="fas fa-book-open me-1"></i>Menu</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ url('/commande') }}"><i class="fas fa-list me-1"></i>Mes Commandes</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ url('/fcaturesclient') }}"><i class="fas fa-file-invoice me-1"></i>Mes Factures</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <ul class="navbar-nav ms-auto">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ url('/panier') }}">--}}
{{--                        <i class="fas fa-shopping-cart me-1"></i>Panier--}}
{{--                        <span class="badge bg-danger" id="panier-count">0</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">--}}
{{--                        <i class="fas fa-user me-1"></i>Compte--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                        <li><a class="dropdown-item" href="{{ url('/loginclient') }}">Connexion</a></li>--}}
{{--                        <li><a class="dropdown-item" href="{{ url('/registerclient') }}">Inscription</a></li>--}}
{{--                        <li><hr class="dropdown-divider"></li>--}}
{{--                        <li><a class="dropdown-item" href="{{ url('/profileclient') }}">Profile</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
