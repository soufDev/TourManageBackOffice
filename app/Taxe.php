<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxe extends Model
{
    public $timestamps = false;

    public $table='taxe';
    protected  $primarykey = 'id';
    protected $fillable = [
        'id','taux','libelle'





    ];
    public function getKeyName(){
        return "id";
    }
    public function produits()
    {
        return $this->belongsTo('App\Produit','tauxTVA','id');
    }
}
