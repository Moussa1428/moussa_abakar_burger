@extends('layouts.gestionnaire.master')
@section('main')
    <style>

        .stock-card {
            transition: transform 0.3s;
        }
        .stock-card:hover {
            transform: translateY(-5px);
        }
        .stock-low {
            background-color: #fff3cd;
        }
        .stock-out {
            background-color: #f8d7da;
        }
    </style>

    <!-- Top Navigation -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h1 class="h2">Gestion des Stocks</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addStockModal">
                    <i class="fas fa-plus"></i> Ajouter un produit
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-download"></i> Exporter
                </button>
            </div>
        </div>
    </div>
    <!-- Filtres et recherche -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher un produit...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary active">Tous</button>
                <button type="button" class="btn btn-outline-secondary">En stock</button>
                <button type="button" class="btn btn-outline-secondary">Rupture de stock</button>
            </div>
        </div>
    </div>

    <!-- Catégories de produits -->
    <div class="row mt-4">
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('stocks') ? 'active' : '' }}" href="{{ route('admin.stocks') }}">Tous les produits</a>
                </li>
                @foreach($categories as  $categorie)
                    <li class="nav-item">
                        <a class="nav-link  @if (Request::is('stocks/dynamic/'.$categorie->id))  active  @endif " href="{{ route('stocks.index', $categorie->id)  }}"> {{ $categorie->nom }} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


    <!-- Liste des produits en stock -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Produits en stock</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produits as $product)
                        <tr>
                            <td>#PRD-{{ $product->id }}</td>
                            <td>{{ $product->nom }}</td>
                            <td>{{ $product->Categorie->nom }}</td>
                            <td>{{ $product->quantite_stock }}</td>
                            <td>{{ number_format($product->prix, 2) }} fcfa</td>
                            <td>
                                @if($product->quantite_stock > 2)
                                    <span class="badge bg-success">En stock</span>
                                @elseif($product->quantite_stock <=2)
                                    <span class="badge bg-warning stock-low">Rupture de stock</span>
                                @else
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">

                                    <a href="{{ route('produits.viewstock', $product->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('produits.editstock', $product->id) }}" style="color: #3e3e3a" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockModalLabel">Ajouter un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produits.storestock') }}" method="POST" enctype="multipart/form-data">
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


<div class="modal fade" id="viewStockModal" tabindex="-1" aria-labelledby="viewStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStockModalLabel">Détails du produit #PRD-2023-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>ID du produit:</strong></p>
                        <p>#PRD-2023-001</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Nom:</strong></p>
                        <p>Tomates</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Catégorie:</strong></p>
                        <p>Légumes</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Quantité:</strong></p>
                        <p>50</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Prix:</strong></p>
                        <p>€1.20</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Statut:</strong></p>
                        <p><span class="badge bg-success">En stock</span></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6>Historique</h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">01/01/2023</span>
                                    Ajouté au stock
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">15/01/2023</span>
                                    Mise à jour de la quantité
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">01/02/2023</span>
                                    Dernière vente
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Modifier</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
