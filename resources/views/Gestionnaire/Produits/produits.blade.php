@extends('layouts.gestionnaire.master')
@section('main')
    <style>

        .small-alert {
            font-size: 12px; /* Réduit la taille du texte */
            padding: 5px 10px; /* Réduit le padding de l'alerte */
            max-width: 100%; /* S'assure que l'alerte utilise tout l'espace disponible */
        }

        .alert-container {
            display: flex;
            justify-content: space-between; /* Aligne les alertes horizontalement */
            gap: 10px; /* Ajoute un espacement entre les alertes */
        }

        .col-4 {
            flex: 1; /* Les alertes se partagent l'espace disponible en 3 parties égales */
            padding: 0; /* Supprime tout padding supplémentaire */
        }

        /* Alerte générique */
        .general-alert {
            font-size: 14px; /* Taille du texte plus grande pour l'alerte générale */
            padding: 10px 15px;
            max-width: 100%;
        }
        .card-footer .btn-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-footer .btn {
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
        }

        .card-footer .btn-outline-primary, .card-footer .btn-outline-danger {
            margin: 0 5px;
        }
        .main-content {
            padding: 20px;
        }
        .product-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 150px;
            object-fit: cover;
        }
        .product-filter {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h1 class="h2">Gestion des Produits</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($lowStockProducts->count() > 2)
            <!-- Si plus de deux produits sont en rupture de stock -->
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center general-alert" role="alert">
                <i class="fas fa-exclamation-triangle alert-icon" style="font-size: 12px;"></i>
                <strong>Attention !</strong> Plusieurs produits sont en rupture de stock avec seulement 2 articles en inventaire.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif($lowStockProducts->count() > 0)
            <div class="row alert-container">
                @foreach($lowStockProducts as $product)
                    <div class="col-4">
                        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center small-alert" role="alert">
                            <i class="fas fa-exclamation-triangle alert-icon" style="font-size: 16px;"></i>
                            <strong>Le "{{ $product['nom'] }}" a seulement 2 articles en stock</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
            <div class="content  mt-3">
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
                                <select class="form-select" id="categoryFilter" name="categorie_id">
                                    <option value="">Toutes les catégories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="statusFilter" name="disponible">
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


                <!-- Boutons d'action -->
                <div class="mb-3 d-flex justify-content-between w-100">
                    <div>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus"></i> Nouveau Produit
                        </button>
                        <button class="btn btn-secondary me-2">
                            <i class="fas fa-file-export"></i> Exporter
                        </button>
                        <button class="btn btn-info">
                            <i class="fas fa-print"></i> Imprimer
                        </button>
                    </div>
                    <button class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#addcategorietModal">
                        <i class="fas fa-plus"></i> Categorie
                    </button>
                </div>
                <div class="row ">
                    @foreach($produits as $product)
                        <div class="col-md-4 col-lg-3">
                            <div class="card product-card">
                                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top product-image" alt="{{ $product->nom }}">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $product->description }}</h6>
                                    <h5 class="card-title">{{ $product->nom }}</h5>
                                    <p class="card-text text-muted">{{ $product->Categorie->nom }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->disponible ? 'Disponible' : 'Indisponible' }}
                                    </span>
                                        <span class="fw-bold">{{ number_format($product->prix, 2) }} fcfa</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top-0">
                                    <div class="btn-group w-100">
                                        <a href="{{ route('produits.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <form action="{{ route('produits.destroy', $product->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn mt-3 btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-4">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $produits->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $produits->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Précédent</a>
                        </li>

                        <!-- Page Number Links -->
                        @foreach($produits->getUrlRange(1, $produits->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $produits->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ $produits->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $produits->nextPageUrl() }}">Suivant</a>
                        </li>
                    </ul>
                </nav>

            </div>
@endsection

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Ajouter un Produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" name="nom" id="productName" required>
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Prix (fcfa)</label>
                        <input type="number" class="form-control" name="prix" id="productPrice" step="0.01" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription"  name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="productImage" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="productImage">
                    </div>

                    <div class="mb-3">
                        <label for="productStatus" class="form-label">Statut</label>
                        <select class="form-select" id="productStatus" name="disponible" required>
                            <option value="1">Disponible</option>
                            <option value="0">Indisponible</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="stock" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Catégorie</label>
                        <select class="form-select" id="productCategory" name="category_id" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addcategorietModal" tabindex="-1" aria-labelledby="addcategorietModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Ajouter un Categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout de catégorie -->
                <form action="{{ route('categorie.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nom du Categorie</label>
                        <input type="text" class="form-control" name="nom" id="productName" required>
                    </div>

                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription"  name="description" rows="2"></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <hr>
                <h5>Catégories existantes</h5>
                <table class="table table-bordered w-100">
                    <thead class="">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->nom }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <form action="{{ route('categorie.destroy',$category) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <!-- Vous pouvez ajouter d'autres boutons ou actions ici si nécessaire -->
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
