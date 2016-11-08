<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapetournee extends Model {

    protected $table = 'etapetournee';

    public $fillable = ['id',
        'idClient',
        'idLivraison',
        'adresse',
        'idCommande',
        'statut',
        'commentaire',
        'motifvisit',
        'longitude',
        'latitude',
        'idEncaissement',
        'numEtape'];

    public $timestamps = false;

    public function client() {
        return $this->belongsTo('App\Client');
    }

}
