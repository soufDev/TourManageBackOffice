<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model {

    //

    protected $table = 'vehicule';


    protected $fillable = [
        'id',
        'matricule',
        'KMDebut',
        'capaciteStockage'];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;


}
