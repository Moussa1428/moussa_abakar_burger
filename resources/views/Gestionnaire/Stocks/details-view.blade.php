@extends('layouts.gestionnaire.master')
@section('main')
    <div class="content mt-3">
        <div class="modal fade show" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" style="display: block;" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStockModalLabel">Détails du produit #PRD-{{ $product->created_at  }}-{{ $product->id }}</h5>
                    <a href="{{route('admin.stocks')}}"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>ID du produit:</strong></p>
                                <p>#PRD-MS-{{ $product->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Nom:</strong></p>
                                <p>{{ $product->nom }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Catégorie:</strong></p>
                                <p>{{$product->Categorie->nom}}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Quantité:</strong></p>
                                <p>{{ $product->quantite_stock }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Prix:</strong></p>
                                <p>{{ $product->prix }} fcfa</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Statut:</strong></p>
                                <p><span class="badge bg-success">
                                        @if($product->disponible ==1)
                                            Disponible
                                        @else
                                            Non disponible
                                        @endif
                                </span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h6>Historique</h6>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-primary me-2">{{ $product->created_at }}</span>
                                            Ajouté au stock
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-primary me-2">{{ $product->updated_at }}</span>
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
                    <a href="{{route('admin.stocks')}}" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</a>
                </div>
            </div>
        </div>
    </div>
@endsection
