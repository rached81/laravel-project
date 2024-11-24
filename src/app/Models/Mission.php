<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $table = 'missions';



    protected $fillable = [
        'car_number', // matricule de voiture
        'permit_holder', // Titulaire du permis
        'license_number', // Numéro de la licence
        'cin', // Numéro de la CIN
        'car_number', // Numéro de la voiture
        'rank_or_position', // Rang ou position de l'utilisateur
        'internal_function', // Fonction interne
        'vehicle_usage_reason', // Raison de l'utilisation de la voiture
        'start_date', // Date de début de la mission
        'start_time', // Heure de début de la mission
        'return_date', // Date de retour de la mission
        'return_time', // Heure de retour de la mission
        'departure_location', // Lieu de départ
        'destination_location', // Destination prévue
        'companions', // Liste des compagnons
        'expenses' ,// Dépenses de la mission
        'user_id'
    ];

    /**
     * Les attributs qui doivent être convertis en dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date'];

  protected $casts = [
        'companions'=> 'array'
  ];
}
