<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function storecategorie(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categorie::create   ([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.produits')->with('success', 'Catégorie créée avec succès.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroycategorie($id)
    {
        $category = Categorie::findOrFail($id);
        if (!$category) {
            return redirect()->route('admin.produits')->with('error', 'Catégorie non trouvée.');
        }

        if ($category->produits()->count() > 0) {
            return redirect()->route('admin.produits')->with('error', 'Impossible de supprimer une catégorie contenant des produits.');
        }

        $category->delete();

        return redirect()->route('admin.produits')->with('success', 'Catégorie supprimée avec succès.');
    }
}
