@extends('layouts.gestionnaire.master')
@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Paramètres</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </div>
    </div>

    <!-- Paramètres généraux -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Paramètres généraux</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="restaurantName" class="form-label">Nom du restaurant</label>
                    <input type="text" class="form-control" id="restaurantName" value="Mon Restaurant" required>
                </div>
                <div class="mb-3">
                    <label for="restaurantEmail" class="form-label">Email de contact</label>
                    <input type="email" class="form-control" id="restaurantEmail" value="contact@monrestaurant.com" required>
                </div>
                <div class="mb-3">
                    <label for="restaurantPhone" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="restaurantPhone" value="+33 1 23 45 67 89" required>
                </div>
            </form>
        </div>
    </div>

    <!-- Paramètres de sécurité -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Paramètres de sécurité</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="passwordPolicy" class="form-label">Politique de mot de passe</label>
                    <select class="form-select" id="passwordPolicy" required>
                        <option value="strong">Fort</option>
                        <option value="medium">Moyen</option>
                        <option value="weak">Faible</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="twoFactorAuth" class="form-label">Authentification à deux facteurs</label>
                    <select class="form-select" id="twoFactorAuth" required>
                        <option value="enabled">Activée</option>
                        <option value="disabled">Désactivée</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Paramètres de notification -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Paramètres de notification</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="emailNotifications" checked>
                    <label class="form-check-label" for="emailNotifications">
                        Notifications par email
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="smsNotifications">
                    <label class="form-check-label" for="smsNotifications">
                        Notifications par SMS
                    </label>
                </div>
            </form>
        </div>
    </div>

@endsection
