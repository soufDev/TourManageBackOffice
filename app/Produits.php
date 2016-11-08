<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model {

    //

    protected $table = 'produit';


    protected $fillable = [
        'id',
        'reference',
        'PrixAchatAppliquee',
        'tauxTVA',
        ];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;

}
