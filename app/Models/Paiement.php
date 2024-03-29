<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'personnel_id',
        'date_paiement',
        'montant'
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
