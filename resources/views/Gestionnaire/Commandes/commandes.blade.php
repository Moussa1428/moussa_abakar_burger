@extends('layouts.gestionnaire.master')
@section('main')
<style>
    .btn-no-style {
        background: none;
        border: none;
        color: inherit; /* Prend la couleur de texte par défaut */
        text-decoration: none; /* Enlève le soulignement */
    }

    .btn-en-attente {
        color: rgba(23, 9, 58, 0.94); /* Couleur pour "En Attente" */
    }

    .btn-en-preparation {
        color: rgba(23, 9, 58, 0.94); /* Couleur pour "En Préparation" */
    }

    .btn-prete,
    .btn-payee {
        color: #023184; /* Couleur pour "Prête" et "Payée" */
    }

    .btn-no-style:hover {
        text-decoration: none; /* Assurez-vous qu'il n'y ait pas de soulignement au survol */
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  border-bottom">
            <h1 class="h2">Gestion des Commandes</h1>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-success">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="content mt-3">

            <div class="order-filter">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Rechercher une commande...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="statusFilter">
                            <option value="">Tous les statuts</option>
                            <option value="new">Nouveau</option>
                            <option value="preparing">En préparation</option>
                            <option value="delivery">En livraison</option>
                            <option value="completed">Livré</option>
                            <option value="cancelled">Annulé</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="dateFilter">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Filtrer</button>
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-between align-items-center w-100 mt-3">
                <div class="d-flex">
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addcommandeModal">
                            <i class="fas fa-plus"></i>  Nouvelle Commande
                        </button>
                        <button class="btn btn-secondary me-3">
                            <i class="fas fa-file-export"></i> Exporter
                        </button>
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-print"></i> Imprimer
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#" onclick="imprimerTable()"><i class="fas fa-print"></i> Imprimer la table</a></li>
                            <li><a class="dropdown-item" href="#" onclick="exporterPDF()"><i class="fas fa-file-pdf"></i> Exporter en PDF</a></li>
                            <li><a class="dropdown-item" href="#" onclick="exporterExcel()"><i class="fas fa-file-excel"></i> Exporter en Excel</a></li>
                        </ul>
                    </div>
                </div>
                <div class="">
                    <select id="clientSelect" class="form-select">
                        <option value="">-- Choisir un client --</option>
                        @foreach($utilisateurs as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Informations Commandes de chaque Client
                </div>
                <div class="card-body">

                    <!-- Tableau des commandes -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="commandeTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Commande</th>
                                <th>Montant Total</th>
                                <th>Statut</th>
                                <th>Produits Commandés</th>
                            </tr>
                            </thead>
                            <tbody id="commandeBody">
                            <tr>
                                <td colspan="5" class="text-center">Sélectionnez un client pour voir ses commandes.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<div class="card mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Liste des Commandes
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="commandeTable">
            <thead>
            <tr>
                <th>#COMID</th>
                <th>Client</th>
                <th>Date Commande</th>
                <th>Montant Total</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="commandeBody">
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->utilisateur->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($commande->montant_total, 2) }} fcfa</td>
                    <td class="statut-{{ $commande->id }}">{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="statut" value="en_attente">
                                <button type="submit" class="btn btn-no-style btn-en-attente btn-spacing" title="Mettre en Attente">En Attente</button>
                            </form>

                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="statut" value="en_preparation">
                                <button type="submit" class="btn btn-no-style btn-en-preparation btn-spacing" title="Mettre en Préparation">En Préparation</button>
                            </form>

                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="statut" value="prete">
                                <button type="submit" class="btn btn-no-style btn-prete btn-spacing" title="Marquer comme Prête">Prête</button>
                            </form>
                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="statut" value="payee">
                                <button type="submit" class="btn btn-no-style btn-payee btn-spacing" title="Marquer comme Payée">Payée</button>
                            </form>

                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="statut" value="annuler">
                                <button type="submit" disabled class="btn btn-no-style btn-payee btn-spacing" title="Marquer comme Payée">Annuler</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card mt-5">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Details Commandes
    </div>
    <table class="table table-bordered">
    <thead>
    <tr>
        <th>ID Commande</th>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix Unitaire</th>
        <th>Montant</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commandsdetails as $commande)

        <tr>
            <td colspan="5"><strong>Commande #CMID{{ $commande->id }} ({{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }})</strong>
                Client :{{$commande->utilisateur->name}}
            </td>

        </tr>

        @foreach($commande->details as $detail)
            <tr>
                <td></td>
                <td>{{ $detail->produit->nom }}</td>
                <td>{{ $detail->quantite }}</td>
                <td>{{ number_format($detail->prix_unitaire, 2) }} fcfa</td>
                <td> {{ number_format($detail->quantite * $detail->prix_unitaire, 2) }}  fcfa</td>
                <td>{{ $commande->statut }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5"><hr></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>


@endsection
<!-- Modal Voir Commande -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderModalLabel">Détails de la Commande #ORD-2023-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Informations Client</h6>
                        <p><strong>Nom:</strong> Jean Dupont</p>
                        <p><strong>Email:</strong> jean.dupont@example.com</p>
                        <p><strong>Téléphone:</strong> 06 12 34 56 78</p>
                        <p><strong>Adresse:</strong> 123 Rue de Paris, 75001 Paris</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Informations Commande</h6>
                        <p><strong>Date:</strong> 15/05/2023 14:30</p>
                        <p><strong>Statut:</strong> <span class="badge bg-success">Livré</span></p>
                        <p><strong>Paiement:</strong> Carte bancaire</p>
                        <p><strong>Total:</strong> 45.90 €</p>
                    </div>
                </div>
                <h6>Articles commandés</h6>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Burger Classique</td>
                        <td>2</td>
                        <td>12.50 €</td>
                        <td>25.00 €</td>
                    </tr>
                    <tr>
                        <td>Frites Maison</td>
                        <td>2</td>
                        <td>4.50 €</td>
                        <td>9.00 €</td>
                    </tr>
                    <tr>
                        <td>Coca-Cola</td>
                        <td>3</td>
                        <td>3.30 €</td>
                        <td>9.90 €</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Sous-total:</strong></td>
                        <td>43.90 €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Frais de livraison:</strong></td>
                        <td>2.00 €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td><strong>45.90 €</strong></td>
                    </tr>
                    </tfoot>
                </table>
                <h6>Historique de la commande</h6>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge bg-primary me-2">15/05/2023 14:30</span>
                        Commande reçue
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-warning text-dark me-2">15/05/2023 14:35</span>
                        En préparation
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-info me-2">15/05/2023 14:50</span>
                        En livraison
                    </li>
                    <li class="list-group-item">
                        <span class="badge bg-success me-2">15/05/2023 15:15</span>
                        Livrée
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Imprimer</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Modifier Commande -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel">Modifier la Commande #ORD-2023-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informations Client</h6>
                            <div class="mb-3">
                                <label for="clientName" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="clientName" value="Jean Dupont">
                            </div>
                            <div class="mb-3">
                                <label for="clientEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="clientEmail" value="jean.dupont@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="clientPhone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="clientPhone" value="06 12 34 56 78">
                            </div>
                            <div class="mb-3">
                                <label for="clientAddress" class="form-label">Adresse</label>
                                <textarea class="form-control" id="clientAddress" rows="2">123 Rue de Paris, 75001 Paris</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Informations Commande</h6>
                            <div class="mb-3">
                                <label for="orderDate" class="form-label">Date</label>
                                <input type="datetime-local" class="form-control" id="orderDate" value="2023-05-15T14:30">
                            </div>
                            <div class="mb-3">
                                <label for="orderStatus" class="form-label">Statut</label>
                                <select class="form-select" id="orderStatus">
                                    <option value="new">Nouveau</option>
                                    <option value="preparing">En préparation</option>
                                    <option value="delivery">En livraison</option>
                                    <option value="completed" selected>Livré</option>
                                    <option value="cancelled">Annulé</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Méthode de paiement</label>
                                <select class="form-select" id="paymentMethod">
                                    <option value="card" selected>Carte bancaire</option>
                                    <option value="cash">Espèces</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h6>Articles commandés</h6>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-select">
                                    <option selected>Burger Classique</option>
                                    <option>Burger Cheese</option>
                                    <option>Burger Végétarien</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" value="2" min="1">
                            </td>
                            <td>12.50 €</td>
                            <td>25.00 €</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select">
                                    <option>Burger Classique</option>
                                    <option>Burger Cheese</option>
                                    <option>Burger Végétarien</option>
                                    <option selected>Frites Maison</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" value="2" min="1">
                            </td>
                            <td>4.50 €</td>
                            <td>9.00 €</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-select">
                                    <option>Burger Classique</option>
                                    <option>Burger Cheese</option>
                                    <option>Burger Végétarien</option>
                                    <option>Frites Maison</option>
                                    <option selected>Coca-Cola</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" value="3" min="1">
                            </td>
                            <td>3.30 €</td>
                            <td>9.90 €</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <button type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Ajouter un article</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Sous-total:</strong></td>
                            <td>43.90 €</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Frais de livraison:</strong></td>
                            <td>
                                <input type="number" class="form-control" value="2.00" step="0.10">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>45.90 €</strong></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/ms6-status-update.js') }}"></script>
<!-- Bouton pour ouvrir le modal -->
<div class="modal fade" id="addcommandeModal" tabindex="-1" aria-labelledby="commandeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
{{--        --}}
        <form action="{{ route('commandes.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commandeModalLabel">Créer une commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="utilisateur_id" class="form-label">Client</label>
                        <select name="utilisateur_id" class="form-select" required>
                            @foreach($utilisateurs as $utilisateur)
                                <option value="{{ $utilisateur->id }}">{{ $utilisateur->name }} - {{ $utilisateur->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <table class="table table-bordered" id="produitsTable">
                        <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <select name="produits[0][produit_id]" class="form-select" required>
                                    @foreach($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }} - {{ $produit->prix }} fcfa</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="produits[0][quantite]" class="form-control" min="1" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">X</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary" id="addRow">+ Ajouter un produit</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Valider la commande</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--loaderclientablecomand--}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const clientSelect = document.getElementById('clientSelect');
        const commandeBody = document.getElementById('commandeBody');

        clientSelect.addEventListener('change', function () {
            const clientId = this.value;

            // Message par défaut
            if (!clientId) {
                commandeBody.innerHTML = `
                <tr><td colspan="5" class="text-center">Sélectionnez un client pour voir ses commandes.</td></tr>`;
                return;
            }

            // Appel AJAX pour charger les commandes
            fetch(`/commandes/client/${clientId}`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur réseau");
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Debug

                    commandeBody.innerHTML = '';

                    if (data.length === 0) {
                        commandeBody.innerHTML = `
                        <tr><td colspan="5" class="text-center">Aucune commande trouvée pour ce client.</td></tr>`;
                        return;
                    }

                    data.forEach(commande => {
                        // Création d'une ligne pour chaque commande
                        const ligne = `
                        <tr>
                            <td>${commande.id}</td>
                            <td>${new Date(commande.date_commande).toLocaleString()}</td>
                            <td>${parseFloat(commande.montant_total).toFixed(2)} €</td>
                            <td><span class="badge bg-${getBadgeClass(commande.statut)}">${getStatutLabel(commande.statut)}</span></td>
                            <td>${commande.produits.map(p => `${p.nom} x${p.pivot.quantite}`).join('<br>')}</td>
                        </tr>
                    `;
                        commandeBody.innerHTML += ligne;
                    });
                })
                .catch(error => {
                    console.error("Erreur lors du chargement des commandes :", error);
                    commandeBody.innerHTML = `
                    <tr><td colspan="5" class="text-danger text-center">Erreur lors du chargement des commandes.</td></tr>`;
                });
        });

        // Fonction pour styliser les statuts
        function getBadgeClass(statut) {
            switch (statut) {
                case 'en_attente': return 'secondary';
                case 'en_preparation': return 'warning text-dark';
                case 'prete': return 'info';
                case 'payee': return 'success';
                default: return 'light';
            }
        }

        // Pour afficher des libellés plus clairs si besoin
        function getStatutLabel(statut) {
            switch (statut) {
                case 'en_attente': return 'En attente';
                case 'en_preparation': return 'En préparation';
                case 'prete': return 'Prête';
                case 'payee': return 'Payée';
                default: return statut;
            }
        }
    });
</script>
{{--impression--}}
<script>
    // Fonction pour imprimer la table
    function imprimerTable() {
        window.print(); // Imprimer la page actuelle
    }

    function exporterPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.autoTable({ html: '#commandeTable' });

        doc.save('commande.pdf');
    }

    function exporterExcel() {
        const table = document.getElementById("commandeTable"); // Récupérer la table
        const wb = XLSX.utils.table_to_book(table, { sheet: "Commandes" }); // Convertir la table en un fichier Excel
        XLSX.writeFile(wb, 'commande.xlsx'); // Sauvegarder le fichier Excel
    }
</script>


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

{{--finimprimscript--}}

{{--commande--}}
<script>
    let rowIndex = 1;
    document.getElementById('addRow').addEventListener('click', function () {
        const tableBody = document.querySelector('#produitsTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
              <select name="produits[${rowIndex}][produit_id]" class="form-select" required>
                @foreach($produits as $produit)
                <option value="{{ $produit->id }}">{{ $produit->nom }} - {{ $produit->prix }} fcfa</option>
                @endforeach
        </select>
      </td>
      <td>
        <input type="number" name="produits[${rowIndex}][quantite]" class="form-control" min="1" required>
            </td>
            <td>
              <button type="button" class="btn btn-danger remove-row">X</button>
            </td>
        `;
        tableBody.appendChild(row);
        rowIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

