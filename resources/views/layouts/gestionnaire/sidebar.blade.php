<!-- Sidebar fixe -->
<div class="col-md-4 col-lg-2 sidebar">
    <div class="position-sticky">
        <div class="text-center">
            <h3>Admin</h3>
        </div>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{url('/dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i> Tableau de bord
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('commandes') ? 'active' : '' }}" href="{{url('/commandes')}}">
                    <i class="fas fa-shopping-cart"></i> Commandes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('produits') ? 'active' : '' }}" href="{{url('/produits')}}">
                    <i class="fas fa-utensils"></i> Produits
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('stocks') ? 'active' : '' }}" href="{{url('/stocks')}}">
                    <i class="fas fa-boxes"></i> Stocks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('paiements') ? 'active' : '' }}" href="{{url('/paiements')}}">
                    <i class="fas fa-credit-card"></i> Paiements
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('utilisateurs') ? 'active' : '' }}" href="{{url('/utilisateurs')}}">
                    <i class="fas fa-users"></i> Utilisateurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('parametres') ? 'active' : '' }}" href="{{url('/parametres')}}">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="#">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </li>
        </ul>
    </div>
</div>
