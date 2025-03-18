@extends('layouts.client.master')
@section('main')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Connexion</h2>
                        <form id="loginForm" onsubmit="return handleLogin(event)">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="#" class="text-muted">Mot de passe oublié ?</a>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">Pas encore de compte ?</p>
                            <a href="{{ route('client.registerclient') }}" class="btn btn-outline-primary mt-2">Créer un compte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Client/js/login.js') }}"></script>
@endsection
