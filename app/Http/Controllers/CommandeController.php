<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\DetailsCommande;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Produit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $commande = Commande::create([
                'utilisateur_id' => $request->utilisateur_id,
                'date_commande' => now(),
                'statut' => "en_attente",
                'montant_total' => 0, // temporaire
            ]);

            $montantTotal = 0;

            foreach ($request->produits as $produit) {
                $produitModel = Produit::find($produit['produit_id']);
                $prixUnitaire = $produitModel->prix;
                $quantite = $produit['quantite'];

                if ($produitModel->quantite_stock < $quantite) {
                    throw new \Exception("Stock insuffisant pour le produit: {$produitModel->nom}");
                }

                DetailsCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produitModel->id,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prixUnitaire
                ]);

                // Mise à jour du stock
                $produitModel->decrement('quantite_stock', $quantite);

                $montantTotal += $prixUnitaire * $quantite;
            }

            $commande->update(['montant_total' => $montantTotal]);

            // ------------------------------
            // Génération automatique de la facture
            // ------------------------------
//            $numeroFacture = 'FAC-' . strtoupper(Str::random(6)) . '-' . now()->format('Ymd');
//            $pdf = Pdf::loadView('factures.facture_pdf', ['commande' => $commande]);
//
//            $cheminPdf = 'recus/' . $numeroFacture . '.pdf';
//
//            $pdf->save(public_path($cheminPdf));
//
//            Facture::create([
//                'commande_id' => $commande->id,
//                'numero_facture' => $numeroFacture,
//                'chemin_pdf' => $cheminPdf,
//                'date_emission' => now(),
//            ]);
//
//            if ($commande->statut == 'payee') {
//                Paiement::create([
//                    'commande_id' => $commande->id,
//                    'montant' => $commande->montant_total,
//                    'mode_paiement' => 'especes',
//                    'date_paiement' => now(),
//                    'utilisateur_id' => $commande->utilisateur_id,
//                ]);
//            }

            DB::commit();

            return redirect()->route('admin.commandes', $commande->id)->with('success', 'Commande effectuée avec success et stock mis à jour !');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function getByClient($id)
    {
        try {
            $commandes = Commande::with('produits') // ou 'produitCommandes.produit' selon ta structure
            ->where('utilisateur_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($commandes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDetails($id)
    {
        try {
            $commande = Commande::with('produits')
            ->findOrFail($id);

            return response()->json($commande);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getCommandesByClient($id)
    {
        $commandes = Commande::with('produits') // si tu as une relation produits
        ->where('client_id', $id)
            ->get();

        return response()->json($commandes);
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|string|in:en_attente,en_preparation,prete,payee',
        ]);
        $ancienStatut = $commande->statut;
        $commande->statut = $request->input('statut');
        $commande->save();
        // Génération automatique de la facture lorsque le statut change à "prête"
        if ($ancienStatut !== 'prete' && $commande->statut === 'prete') {
            // Génération automatique de la facture lorsque le statut change à "prête"
            if (!$commande->facture) {
                // Générer la facture
                $numeroFacture = 'FAC-' . strtoupper(Str::random(6)) . '-' . now()->format('Ymd');
                $pdf = Pdf::loadView('factures.ffacture_pdf', ['commande' => $commande]);

                $cheminPdf = 'facturesfichier/' . $numeroFacture . '.pdf';
                $pdf->save(public_path($cheminPdf));

                Facture::create([
                    'commande_id' => $commande->id,
                    'numero_facture' => $numeroFacture,
                    'chemin_pdf' => $cheminPdf,
                    'date_emission' => now(),
                ]);
            }

            return redirect()->route('admin.commandes')->with('success', 'Commande prête et facture générée.');
        }
        if ($commande->statut === 'payee') {
            Paiement::create([
                'commande_id' => $commande->id,
                'montant' => $commande->montant_total,
                'mode_paiement' => 'especes',
                'date_paiement' => now(),
                'utilisateur_id' => $commande->utilisateur->id,//auth()->user()->id,
            ]);
            return redirect()->route('admin.commandes')->with('success', 'Statut mis à jour avec succès paiement effectuee.');
        }


        return redirect()->route('admin.commandes')->with('success', 'Statut mis à jour avec succès.');
    }
    public function destroy(string $id)
    {
        //
    }
}
