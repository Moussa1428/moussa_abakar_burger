<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'montant',
        'mode_paiement',
        'date_paiement',
        'utilisateur_id',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}
