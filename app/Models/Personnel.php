<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'carte_identite',
        'horaires_travail',
        'email',
        'qr_code',
        'cjm'
    ];

    public function pointage()
    {
        return $this->hasMany(Pointage::class);
    }

    public function paiement()
    {
        return $this->hasMany(Paiement::class);
    }
    public function administrateur()
    {
        return $this->hasMany(Administrateur::class);
    }

    public function datesPointages()
    {
        // Récupérer tous les pointages de ce personnel
        $pointages = $this->pointage;

        // Initialiser un tableau pour stocker les dates de pointage
        $datesPointages = [];

        // Parcourir les pointages et extraire les dates
        foreach ($pointages as $pointage) {
            $datesPointages[] = $pointage->date;
        }

        // Retourner les dates de pointage
        return $datesPointages;
    }

}
