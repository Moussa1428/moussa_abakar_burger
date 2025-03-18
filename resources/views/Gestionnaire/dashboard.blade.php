@extends('layouts.gestionnaire.master')
@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-1 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
    </div>
    <!-- Charts -->
    <div class="content">
        <!-- Statistiques -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                            </div>
                            <div class="col-9 text-end">
                                <h3>156</h3>
                                <p class="mb-0">Commandes aujourd'hui</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="orders.html" class="text-primary">
                            <span class="float-start">Voir détails</span>
                            <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-money-bill-wave fa-3x text-success"></i>
                            </div>
                            <div class="col-9 text-end">
                                <h3>8,540 €</h3>
                                <p class="mb-0">Revenus aujourd'hui</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="payments.html" class="text-success">
                            <span class="float-start">Voir détails</span>
                            <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-utensils fa-3x text-warning"></i>
                            </div>
                            <div class="col-9 text-end">
                                <h3>45</h3>
                                <p class="mb-0">Produits populaires</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="products.html" class="text-warning">
                            <span class="float-start">Voir détails</span>
                            <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-dashboard danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                            </div>
                            <div class="col-9 text-end">
                                <h3>12</h3>
                                <p class="mb-0">Produits en rupture</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="inventory.html" class="text-danger">
                            <span class="float-start">Voir détails</span>
                            <span class="float-end"><i class="fas fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Graphiques -->
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-1"></i>
                        Ventes des 7 derniers jours
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Répartition des ventes par catégorie
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commandes récentes -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Commandes récentes
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>#ORD-2023-001</td>
                            <td>Jean Dupont</td>
                            <td>15/05/2023 14:30</td>
                            <td>45.90 €</td>
                            <td><span class="badge bg-success">Livré</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-2023-002</td>
                            <td>Marie Martin</td>
                            <td>15/05/2023 15:45</td>
                            <td>78.50 €</td>
                            <td><span class="badge bg-warning text-dark">En préparation</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-2023-003</td>
                            <td>Pierre Durand</td>
                            <td>15/05/2023 16:20</td>
                            <td>32.75 €</td>
                            <td><span class="badge bg-info">En livraison</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-2023-004</td>
                            <td>Sophie Petit</td>
                            <td>15/05/2023 17:10</td>
                            <td>56.20 €</td>
                            <td><span class="badge bg-danger">Annulé</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-2023-005</td>
                            <td>Lucas Bernard</td>
                            <td>15/05/2023 18:05</td>
                            <td>92.30 €</td>
                            <td><span class="badge bg-primary">Nouveau</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
                datasets: [{
                    label: 'Ventes (€)',
                    data: [5200, 6100, 5800, 8200, 7800, 9500, 8540],
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique en camembert
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Entrées', 'Plats principaux', 'Desserts', 'Boissons'],
                datasets: [{
                    data: [15, 40, 20, 25],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

@include('layouts.gestionnaire.script')
@endsection
