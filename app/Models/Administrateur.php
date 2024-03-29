<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrateur extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

}
