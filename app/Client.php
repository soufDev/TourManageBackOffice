<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    //

    protected $table = 'client';


    protected $fillable = [
        'id',
        'DateCreation',
        'SegmentClient',
        'Email',
        'telephone',
        'Nom',
        'Prenom',
        'NomSociete',
        'adresse'
    ];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;


    public static $rules = array(
        'nomClient' => 'required||string|min:4',
        'prenomClient' => 'required|string|min:4',
        'dateAdd'  => 'required',
        'segement'  => 'required',
        'email'  => 'required',
        'telephone' => 'required',
        'societe' => 'required' );

    public function etapeTournees() {
        return $this->hasMany('App\Etapetournee');
    }
    
}
