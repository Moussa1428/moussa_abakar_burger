@extends('layouts.gestionnaire.master')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  mb-4 border-bottom">
        <h1 class="h2">Produits Filtrés</h1>
        <a href="{{ route('admin.produits') }}" class="btn btn-primary">
            Tous les produits
        </a>
    </div>
    <div class="content mt-3">
        <!-- Filtres et recherche -->
        <div class="product-filter mb-2">
            <form method="GET" action="{{ route('produits.filtered') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Rechercher un produit..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="status">
                            <option value="">Tous les statuts</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Indisponible</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Filtrer</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Affichage des produits -->
        <div class="row">
            @foreach($produits as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card product-card">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top product-image" alt="{{ $product->nom }}">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->description }}</h6>
                            <h5 class="card-title">{{ $product->nom }}</h5>
                            <p class="card-text text-muted">{{ $product->Categorie->nom }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge {{ $product->disponible ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->disponible ? 'Disponible' : 'Indisponible' }}
                                </span>
                                <span class="fw-bold">{{ number_format($product->prix, 2) }} €</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <!-- Pagination Logic here -->
                <li class="page-item {{ $produits->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $produits->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Précédent</a>
                </li>
                @foreach($produits->getUrlRange(1, $produits->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $produits->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $produits->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $produits->nextPageUrl() }}">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>


@endsection
