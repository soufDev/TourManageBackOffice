<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommandeClient extends Model {
    protected $table= 'commandeclient';
    public $timestamps = true;
    public $fillable= ['id', 'idLivraison', 'DateCreation', 'TotalPrixHT', 'totalPrixTTC', 'idClient', 'statut'];
}
