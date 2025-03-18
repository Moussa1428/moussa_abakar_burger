<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'statut',
        'montant_total',
        'date_commande',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');  // 'utilisateur_id' est la clé étrangère
    }

    /**
     * Relation avec les détails de commande
     */
    public function details()
    {
        return $this->hasMany(DetailsCommande::class, 'commande_id');
    }


    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'commande_id');
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'details_commandes', 'commande_id', 'produit_id')
            ->withPivot('quantite', 'prix_unitaire');
    }
    public function facture()
    {
        return $this->hasOne(Facture::class, 'commande_id');
    }
}
