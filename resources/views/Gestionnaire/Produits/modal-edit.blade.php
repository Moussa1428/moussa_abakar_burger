@extends('layouts.gestionnaire.master')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h1 class="h2">Modifier le Produit</h1>
    </div>

    <div class="content mt-3">
        <!-- Modal de modification du produit -->
        <div class="modal fade show" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" style="display: block;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Modifier le Produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('produits.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="productName" class="form-label">Nom du produit</label>
                                <input type="text" class="form-control" id="productName" name="nom" value="{{ $product->nom }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Prix (€)</label>
                                <input type="number" class="form-control" id="productPrice" name="prix" value="{{ $product->prix }}" step="0.01" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="productDescription" name="description" rows="3">{{ $product->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="productImage" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="productImage">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail mt-2" alt="Image actuelle" style="height: 100px;">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="productStatus" class="form-label">Statut</label>
                                <select class="form-select" id="productStatus" name="disponible" required>
                                    <option value="1" {{ $product->disponible == 1 ? 'selected' : '' }}>Disponible</option>
                                    <option value="0" {{ $product->disponible == 0 ? 'selected' : '' }}>Indisponible</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="productStock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="productStock" name="quantite_stock" value="{{ $product->quantite_stock }}" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Catégorie</label>
                                <select class="form-select" id="productCategory" name="categorie_id" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->categorie_id ? 'selected' : '' }}>{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a type="button" href="{{ route('admin.produits') }}" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
