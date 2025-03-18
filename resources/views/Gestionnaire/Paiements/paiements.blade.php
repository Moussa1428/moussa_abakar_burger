@extends('layouts.gestionnaire.master')
@section('main')
    <style>
        .payment-card {
            transition: transform 0.3s;
        }
        .payment-card:hover {
            transform: translateY(-5px);
        }
        .status-pending {
            color: #fd7e14;
        }
        .status-completed {
            color: #198754;
        }
        .status-failed {
            color: #dc3545;
        }
        .status-refunded {
            color: #6c757d;
        }
    </style>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Gestion des Paiements</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                            <i class="fas fa-plus"></i> Ajouter un paiement
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Exporter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filtres et recherche -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher un paiement...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary active">Tous</button>
                        <button type="button" class="btn btn-outline-secondary">En attente</button>
                        <button type="button" class="btn btn-outline-secondary">Complétés</button>
                        <button type="button" class="btn btn-outline-secondary">Échoués</button>
                        <button type="button" class="btn btn-outline-secondary">Remboursés</button>
                    </div>
                </div>
            </div>

            <!-- Statistiques des paiements -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-credit-card"></i> Montant Payee</h5>
                            <p class="card-text display-8">{{ number_format($totalPayees, 2) }} fcfa</p>
                            <p class="card-text"><small></small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-credit-card"></i> Complétés</h5>
                            <p class="card-text display-8">{{ number_format($totalMontants, 2) }} fcfa</p>
                            <p class="card-text"><small></small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-credit-card"></i>En attente</h5>
                            <p class="card-text display-8">{{number_format($totalattente, 2)}} fcfa</p>
                            <p class="card-text"><small></small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-credit-card"></i> En Preparation</h5>
                            <p class="card-text display-8">{{number_format($totalpreparation, 2)}} fcfa</p>
                            <p class="card-text"><small></small></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des paiements -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Transactions récentes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Commande</th>
                                <th>Méthode</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paiements as $paiement )
                                <tr>
                                    <td>#PIID{{ $paiement->id }}</td>
                                    <td>{{ $paiement->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $paiement->utilisateur->name.' '.$paiement->utilisateur->email }}</td>
                                    <td>#CMID{{ $paiement->commande->id }}</td>
                                    <td>{{ $paiement->mode_paiement }}</td>
                                    <td>{{ number_format($paiement->montant, 2) }} fcfa</td>
                                    <td class="status-{{ $paiement->commande->statut }}"></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewPaymentModal">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
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
                <div class="card-footer">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0">
                            <!-- Précédent -->
                            @if ($paiements->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paiements->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Précédent</a>
                                </li>
                            @endif

                            <!-- Pages -->
                            @foreach ($paiements->getUrlRange(1, $paiements->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $paiements->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Suivant -->
                            @if ($paiements->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paiements->nextPageUrl() }}">Suivant</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Graphique des paiements -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tendance des paiements</h5>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-secondary active">Jour</button>
                        <button type="button" class="btn btn-outline-secondary">Semaine</button>
                        <button type="button" class="btn btn-outline-secondary">Mois</button>
                        <button type="button" class="btn btn-outline-secondary">Année</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height:300px;">
                        <!-- Ici, vous intégreriez une bibliothèque de graphiques comme Chart.js -->
                        <div class="text-center py-5">
                            <p class="text-muted">Graphique des paiements par période</p>
                            <p class="text-muted small">Ce graphique afficherait normalement les tendances des paiements au fil du temps.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Méthodes de paiement -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Méthodes de paiement</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container" style="position: relative; height:250px;">
                                <!-- Ici, vous intégreriez un graphique circulaire -->
                                <div class="text-center py-5">
                                    <p class="text-muted">Répartition des méthodes de paiement</p>
                                    <p class="text-muted small">Ce graphique afficherait normalement la répartition des différentes méthodes de paiement utilisées.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Méthode</th>
                                        <th>Transactions</th>
                                        <th>Montant</th>
                                        <th>%</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td><i class="fas fa-money-bill-wave me-1"></i> Espèces</td>
                                        <td>78</td>
                                        <td>€2,340</td>
                                        <td>18.8%</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- Modal Ajouter Paiement -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Ajouter un paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="paymentOrderId" class="form-label">Commande associée</label>
                        <select class="form-select" id="paymentOrderId" required>
                            <option value="" selected disabled>Sélectionner une commande</option>
                            <option value="ORD-2023-047">#ORD-2023-047 - Emma Leroy</option>
                            <option value="ORD-2023-048">#ORD-2023-048 - Thomas Dubois</option>
                            <option value="ORD-2023-049">#ORD-2023-049 - Julie Moreau</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Montant (€)</label>
                        <input type="number" class="form-control" id="paymentAmount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Méthode de paiement</label>
                        <select class="form-select" id="paymentMethod" required>
                            <option value="" selected disabled>Sélectionner une méthode</option>
                            <option value="card">Carte bancaire</option>
                            <option value="cash">Espèces</option>
                            <option value="paypal">PayPal</option>
                            <option value="mobile">Paiement mobile</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentStatus" class="form-label">Statut</label>
                        <select class="form-select" id="paymentStatus" required>
                            <option value="completed">Complété</option>
                            <option value="pending">En attente</option>
                            <option value="failed">Échoué</option>
                            <option value="refunded">Remboursé</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paymentNotes" class="form-label">Notes</label>
                        <textarea class="form-control" id="paymentNotes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Voir Paiement -->
<div class="modal fade" id="viewPaymentModal" tabindex="-1" aria-labelledby="viewPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPaymentModalLabel">Détails du paiement #PAY-2023-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>ID du paiement:</strong></p>
                        <p>#PAY-2023-001</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Date:</strong></p>
                        <p>15/05/2023 12:30</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Client:</strong></p>
                        <p>Jean Dupont</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Commande:</strong></p>
                        <p><a href="#">#ORD-2023-042</a></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Méthode:</strong></p>
                        <p><i class="fas fa-credit-card me-1"></i> Carte bancaire</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Montant:</strong></p>
                        <p>€45.90</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Statut:</strong></p>
                        <p><span class="badge bg-success">Complété</span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>ID de transaction:</strong></p>
                        <p>TXN123456789</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <p class="mb-1"><strong>Notes:</strong></p>
                        <p>Paiement effectué en une seule fois.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6>Historique</h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">15/05/2023 12:28</span>
                                    Paiement initié
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">15/05/2023 12:29</span>
                                    Autorisation bancaire
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">15/05/2023 12:30</span>
                                    Paiement complété
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Imprimer reçu</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
