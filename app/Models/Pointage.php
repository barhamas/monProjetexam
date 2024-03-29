<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    use HasFactory;

    protected $fillable = [
        'personnel_id',
        'date',
        'heure_arr',
        'heure_dep'
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }

}
