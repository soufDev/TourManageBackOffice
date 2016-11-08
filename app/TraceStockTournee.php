<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraceStockTournee extends Model {

    protected $table = 'tracestocktournee';
    public $timestamps = false;
    public $fillable = [
        'id',
        'idProduit',
        'idTournee',
        'stockinitialestime',
        'stockinitialReel',
        'stockFinalEstime',
        'stockEncours',
        'stockFinalReel'
    ];
}
