<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admincontroller extends Controller
{
    public function index()
    {
        return view('Gestionnaire.dashboard');
    }
    public function profile(){
        return view('Gestionnaire.profile');
    }
    public function parametres(){
        return view('Gestionnaire.parametres');
    }
    public function utilisateurs(){
        $clients = User::where('role', 'utilisateur')->paginate(4);
        return view('Gestionnaire.Utilisateurs.utilisateurs',compact('clients'));
    }
    public function employees(){
        $gestionnaires = User::where('role', 'gestionnaire')->paginate(4);
        return view('Gestionnaire.Utilisateurs.employee',compact('gestionnaires'));
    }

    public function paiements(){
        $paiements = Paiement::with('commande', 'utilisateur')->paginate(4);

        $totalPayees = Commande::where('statut', 'payee')->sum('montant_total');

        $totalMontants = Commande::sum('montant_total');

        $totalattente = Commande::where('statut', 'en_attente')->sum('montant_total');

        $totalpreparation = Commande::where('statut', 'en_preparation')->sum('montant_total');


        return view('Gestionnaire.Paiements.paiements', compact('paiements', 'totalPayees','totalattente','totalMontants','totalpreparation'));
    }
    public function commandes(){
        $utilisateurs = Client::all();
        $produits = Produit::all();
        $commandes = Commande::all();
        $commandsdetails = Commande::with('details.produit')->get();
        return view('Gestionnaire.Commandes.commandes',compact('produits','utilisateurs','commandes','commandsdetails'));
    }
    public function produits(){
        $categories = Categorie::all();
        $produits = Produit::paginate(4);
        $lowStockProducts = $produits->where('quantite_stock', 2);
        return view('Gestionnaire.Produits.produits',compact('categories', 'produits', 'lowStockProducts'));
    }
    public function stocks(){
        $categories = Categorie::all();
        $produits = Produit::paginate(4);
        return view('Gestionnaire.Stocks.stocks',compact('categories', 'produits'));
    }



}
