@extends('layouts.gestionnaire.master')
@section('main')
    <style>
        .user-card {
            transition: transform 0.3s;
        }
        .user-card:hover {
            transform: translateY(-5px);
        }
    </style>
    <!-- Top Navigation -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des Utilisateurs</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Ajouter un utilisateur
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
                <input type="text" class="form-control" placeholder="Rechercher un utilisateur...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="btn-group">
                <a  href="{{route('admin.utilisateurs')}}" class="btn btn-outline-secondary {{ Request::is('utilisateurs') ? 'active' : '' }}">Clients</a>
                <a  class="btn btn-outline-secondary disabled">Administrateurs</a>
                <a href="{{ route('admin.gestionnaires')  }}"  class="btn btn-outline-secondary {{ Request::is('utilisateurs/employees') ? 'active' : '' }} " >Employés</a>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Utilisateurs récents</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Contcat</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gestionnaires as $client)
                        <tr>
                            <td>#USR-{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->telephone }}</td>
                            <td>{{ ucfirst($client->role) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" disabled class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editUserModal">
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
                    <!-- Pagination pour les gestionnaires -->
                    @if ($gestionnaires->hasPages())
                        <li class="page-item {{ $gestionnaires->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $gestionnaires->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Précédent</a>
                        </li>
                        @foreach ($gestionnaires->getUrlRange(1, $gestionnaires->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $gestionnaires->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ $gestionnaires->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $gestionnaires->nextPageUrl() }}">Suivant</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    show
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">Détails de l'utilisateur #USR-2023-001</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>ID de l'utilisateur:</strong></p>
                            <p>#USR-2023-001</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nom:</strong></p>
                            <p>Jean Dupont</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p>jean.dupont@example.com</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Rôle:</strong></p>
                            <p>Administrateur</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Statut:</strong></p>
                            <p><span class="badge bg-success">Actif</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Date d'inscription:</strong></p>
                            <p>01/01/2023</p>
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
                                        Inscription
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-primary me-2">15/01/2023</span>
                                        Promotion à administrateur
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-primary me-2">01/02/2023</span>
                                        Dernière connexion
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
    ajout
    <!-- Modal Ajouter Utilisateur -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('adminstore.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="userName" class="form-label">Nom complet</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Contact</label>
                            <input type="number" class="form-control" id="userEmail" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Rôle</label>
                            <select class="form-select" id="userRole" name="role" required>
                                <option value="" selected disabled>Sélectionner un rôle</option>
                                <option value="utilisateur">Client</option>
                                <option value="gestionnaire">Gestionnaire</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
