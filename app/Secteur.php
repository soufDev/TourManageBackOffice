<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model {

    //

    protected $table = 'secteur';


    protected $fillable = [
        'id',
        'nomsecteur',
        'idwilaya'];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;

}
