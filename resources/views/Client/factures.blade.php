@extends('layouts.client.master')
@section('main')

    <div class="container py-5">
        <h2 class="mb-4">Mes Factures</h2>

        <!-- Filtres -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Période</label>
                        <select class="form-select" id="filterPeriode">
                            <option value="">Toutes les périodes</option>
                            <option value="mois_courant">Mois courant</option>
                            <option value="3_mois">3 derniers mois</option>
                            <option value="6_mois">6 derniers mois</option>
                            <option value="annee">Cette année</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Montant</label>
                        <select class="form-select" id="filterMontant">
                            <option value="">Tous les montants</option>
                            <option value="0_25">0 - 25 €</option>
                            <option value="25_50">25 - 50 €</option>
                            <option value="50_100">50 - 100 €</option>
                            <option value="100_plus">Plus de 100 €</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Trier par</label>
                        <select class="form-select" id="sortBy">
                            <option value="date_desc">Date (plus récent)</option>
                            <option value="date_asc">Date (plus ancien)</option>
                            <option value="montant_desc">Montant (décroissant)</option>
                            <option value="montant_asc">Montant (croissant)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des factures -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                <tr>
                    <th>N° Facture</th>
                    <th>Date</th>
                    <th>N° Commande</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="facturesList">
                <!-- Exemple de facture -->
                <tr>
                    <td>FACT-2024-001</td>
                    <td>18 mars 2024</td>
                    <td>CMD-12346</td>
                    <td>26.00 €</td>
                    <td><span class="badge bg-success">Payée</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1" onclick="voirFacture('FACT-2024-001')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary me-1" onclick="telechargerFacture('FACT-2024-001')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="envoyerParEmail('FACT-2024-001')">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </td>
                </tr>
                <!-- Exemple de facture en attente -->
                <tr>
                    <td>FACT-2024-002</td>
                    <td>19 mars 2024</td>
                    <td>CMD-12347</td>
                    <td>42.50 €</td>
                    <td><span class="badge bg-warning text-dark">En attente</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1" onclick="voirFacture('FACT-2024-002')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary me-1" onclick="telechargerFacture('FACT-2024-002')">
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="envoyerParEmail('FACT-2024-002')">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Navigation des factures" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Précédent</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal Détails Facture -->
    <div class="modal fade" id="factureModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Facture <span id="factureNumero"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="factureContent">
                    <!-- Le contenu de la facture sera chargé dynamiquement -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-info" onclick="envoyerParEmail(currentFacture)">
                        <i class="fas fa-envelope me-1"></i>Envoyer par email
                    </button>
                    <button type="button" class="btn btn-primary" onclick="telechargerFacture(currentFacture)">
                        <i class="fas fa-download me-1"></i>Télécharger
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Client/js/factures.js') }}"></script>
@endsection
