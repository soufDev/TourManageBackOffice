<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournees extends Model {

    protected $table = "tournee";

    public $timestamps = false ;

    public $fillable = ['id',
    'idTransporteur',
    'DateDebut',
    'Datefin',
    'KMDebut',
    'KMFin',
    'fondInitialrecu',
    'statut',
    'idvehicule',
    'MotifEcartCaisse',
    'MotifEcartStock',
    'AutreMotifEcartCaisse',
    'AutreMotifEcartStock'
    ];

}
