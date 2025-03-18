@extends('layouts.client.master')
@section('main')
    <div class="container py-5">
        <div class="row">
            <!-- Menu latéral -->
            <div class="col-md-3">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="images/avatar-default.png" alt="Photo de profil" class="rounded-circle" width="100">
                            <h5 class="mt-3" id="userName">Nom d'utilisateur</h5>
                            <p class="text-muted" id="userEmail">email@example.com</p>
                        </div>
                        <div class="list-group">
                            <a href="#informations" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                                <i class="fas fa-user me-2"></i>Informations personnelles
                            </a>
                            <a href="#securite" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="fas fa-lock me-2"></i>Sécurité
                            </a>
                            <a href="#adresses" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="fas fa-map-marker-alt me-2"></i>Adresses
                            </a>
                            <a href="#preferences" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="fas fa-cog me-2"></i>Préférences
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-9">
                <div class="tab-content">
                    <!-- Informations personnelles -->
                    <div class="tab-pane fade show active" id="informations">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="mb-0">Informations personnelles</h5>
                            </div>
                            <div class="card-body">
                                <form id="profileForm" onsubmit="return updateProfile(event)">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="prenom" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" value="">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" id="telephone" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Sécurité -->
                    <div class="tab-pane fade" id="securite">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="mb-0">Sécurité</h5>
                            </div>
                            <div class="card-body">
                                <form id="passwordForm" onsubmit="return updatePassword(event)">
                                    <div class="mb-3">
                                        <label class="form-label">Mot de passe actuel</label>
                                        <input type="password" class="form-control" id="currentPassword" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="newPassword" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirmer le nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="confirmNewPassword" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Adresses -->
                    <div class="tab-pane fade" id="adresses">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Mes adresses</h5>
                                <button class="btn btn-primary btn-sm" onclick="showAddAddressModal()">
                                    <i class="fas fa-plus me-1"></i>Ajouter une adresse
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="addressList">
                                    <!-- Les adresses seront ajoutées dynamiquement ici -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Préférences -->
                    <div class="tab-pane fade" id="preferences">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="mb-0">Préférences</h5>
                            </div>
                            <div class="card-body">
                                <form id="preferencesForm" onsubmit="return updatePreferences(event)">
                                    <div class="mb-3">
                                        <label class="form-label">Langue</label>
                                        <select class="form-select" id="langue">
                                            <option value="fr">Français</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="notifications">
                                        <label class="form-check-label">Recevoir des notifications</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="newsletter">
                                        <label class="form-check-label">S'abonner à la newsletter</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enregistrer les préférences</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Client/js/profile.js') }}"></script>
@endsection
