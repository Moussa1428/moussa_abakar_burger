@extends('layouts.client.master')
@section('main')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Créer un compte</h2>
                        <form id="registerForm" onsubmit="return handleRegister(event)">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="telephone" required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">Adresse de livraison</label>
                                <textarea class="form-control" id="adresse" rows="2" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmer le mot de passe</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmPassword" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirmPassword')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="conditions" required>
                                <label class="form-check-label" for="conditions">
                                    J'accepte les conditions d'utilisation
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                        </form>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">Déjà un compte ?</p>
                            <a href="{{ route('client.loginclient') }}" class="btn btn-outline-primary mt-2">Se connecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Client/js/register.js') }}"></script>
@endsection
