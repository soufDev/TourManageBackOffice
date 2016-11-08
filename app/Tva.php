<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TVA extends Model
{

    //

    protected $table = 'TVA';


    protected $fillable = [
        'id',
        'taux',
        'libelle'];


    public function getKeyName()
    {
        return 'id';
    }

    public $timestamps = false;

}
