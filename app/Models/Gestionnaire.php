<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestionnaire extends Model
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

        static::creating(function ($gestionnaire) {
            $gestionnaire->role = 'gestionnaire';
        });
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}
