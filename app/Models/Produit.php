<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prix',
        'description',
        'image',
        'quantite_stock',
        'disponible',
        'categorie_id',
    ];

    /**
     * Relation avec la catégorie
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    /**
     * Relation avec les détails de commande
     */
    public function details()
    {
        return $this->hasMany(DetailsCommande::class, 'produit_id');
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'details_commandes', 'produit_id', 'commande_id')
            ->withPivot('quantite', 'prix_unitaire');
    }

}
