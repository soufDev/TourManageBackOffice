<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prix extends Model
{
    public $timestamps = false;

    public $table = 'prix';
    protected $primarykey = 'id';
    protected $fillable = [
        'id', 'idProduit', 'PrixTTC', 'segmentClient', 'marge', 'margeValeur', 'PrixHT', 'PromotionHT', 'DateDebutPromo', 'dateFinPromo' ,'Etat'


    ];

    public function getKeyName()
    {

        return "id";
    }

    public function produit()
    {
        return $this->belongsTo('App\Produit','idProduit','id');
    }

}
