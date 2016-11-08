<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public $table='categorie';
    protected  $primarykey = 'id';
    protected $fillable = [
        'id','nom','observation'





    ];
    public function getKeyName(){
        return "id";
    }
    public function produits()
    {
        return $this->hasMany('App\Produit');
    }
}
