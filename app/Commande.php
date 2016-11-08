<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model {

    //

    protected $table = 'commandeclient';


    protected $fillable = [
        'id',
        'idLivraison',
        'DateCreation',
        'TotalPrixHT',
        'totalPrixTTC',
        'idClient',
        'statut'];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;


}
