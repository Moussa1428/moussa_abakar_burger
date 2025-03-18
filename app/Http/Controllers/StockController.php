<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index($categoryId)
    {
       $categorie = Categorie::findOrFail($categoryId);

       $categories = Categorie::all();



       $produits = Produit::where('categorie_id', $categorie->id)->get();

//       $produitspagenates = $produits->paginate(4);



        return view('Gestionnaire.Stocks.dynamic', compact('produits', 'categories'));
    }
}
