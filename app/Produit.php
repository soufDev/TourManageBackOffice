<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $timestamps = false;

    public $table='produit';
    protected  $primarykey = 'id';
    protected $fillable = [
        'id','Designation','idCategorie','CodeIdentification','PrixAchatAppliquee','CUMP','reference','codeMesure','tauxTVA'



    ];
    public function getKeyName() {
        return "id";
    }


    public function category() {
        return $this->belongsTo('App\Category','idCategorie','id');
    }

    public function taxe() {
        return $this->hasOne('App\Taxe','id','tauxTVA');
    }

    public function prix() {
        return $this->hasMany('App\Prix','idProduit','id');
    }
}
