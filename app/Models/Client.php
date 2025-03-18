<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'password',
        'role'
    ];



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            $client->role = 'utilisateur';
        });
    }
    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class);
    }
}
