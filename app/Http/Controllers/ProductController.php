<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'disponible' => 'required',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Traitement de l'image si elle existe
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

//        dd($request);
        // Créer un nouveau produit
        Produit::create([
            'nom' => $validated['nom'],
            'prix' => $validated['prix'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'disponible' => $validated['disponible'],
            'quantite_stock' => $validated['stock'],
            'categorie_id' => $validated['category_id'],
        ]);

        return redirect()->route('admin.produits')->with('success', 'Produit ajouté avec succès.');
    }

    public function storestock(Request $request){
            $validated = $request->validate([
                    'nom' => 'required|string|max:255',
                    'prix' => 'required|numeric|min:0',
                    'description' => 'nullable|string',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'disponible' => 'required',
                    'stock' => 'required|integer|min:0',
                    'category_id' => 'required|exists:categories,id',
            ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        Produit::create([
            'nom' => $validated['nom'],
            'prix' => $validated['prix'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'disponible' => $validated['disponible'],
            'quantite_stock' => $validated['stock'],
            'categorie_id' => $validated['category_id'],
        ]);
        return redirect()->route('admin.stocks')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Produit::findOrFail($id);
        $categories = Categorie::all(); // Si vous voulez lister toutes les catégories dans le formulaire

        // Retourner la vue avec le produit et les catégories
        return view('Gestionnaire.Produits.modal-edit', compact('product', 'categories'));
    }

    public function editstock(string $id)
    {
        $product = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('Gestionnaire.Stocks.modal-edit-produitstock', compact('product', 'categories'));
    }

    public function viewstock(string $id)
    {
        $product = Produit::findOrFail($id);
        return view('Gestionnaire.Stocks.details-view', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Produit::findOrFail($id);

        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'disponible' => 'required|boolean',
            'quantite_stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Mise à jour des données
        $product->nom = $request->input('nom');
        $product->prix = $request->input('prix');
        $product->description = $request->input('description');
        $product->disponible = $request->input('disponible');
        $product->quantite_stock = $request->input('quantite_stock');
        $product->categorie_id = $request->input('categorie_id');

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image si elle existe
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }
        $product->save();

        return redirect()->route('admin.produits')->with('success', 'Produit mis à jour avec succès!');
    }

    public function updatestock(Request $request, $id){
        $product = Produit::findOrFail($id);
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'disponible' => 'required|boolean',
            'quantite_stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        $product->nom = $request->input('nom');
        $product->prix = $request->input('prix');
        $product->description = $request->input('description');
        $product->disponible = $request->input('disponible');
        $product->quantite_stock = $request->input('quantite_stock');
        $product->categorie_id = $request->input('categorie_id');

        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image si elle existe
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }
        $product->save();
        return redirect()->route('admin.stocks')->with('success', 'Produit mis à jour avec succès!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Produit::findOrFail($id);
        // Supprimer le produit
        $product->delete();

        return redirect()->route('admin.produits')->with('success', 'Produit supprimé avec succès.');
    }

    public function filtered(Request $request)
    {
        $query = Produit::query();


        if ($request->has('categorie_id') && $request->categorie_id != '') {
            $query->where('categorie_id', $request->categorie_id);
        }

        // Filtre par statut
        if ($request->has('disponible') && $request->disponible != '') {
            $status = $request->disponible == 'available' ? 1 : 0;
            $query->where('disponible', $status);
        }

        // Recherche par nom
        if ($request->has('search') && $request->search != '') {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        $produits = $query->paginate(10); // Pagination
        $categories = Categorie::all();  // Récupérer toutes les catégories

        return view('Gestionnaire.Produits.filtered', compact('produits', 'categories'));
    }

}
