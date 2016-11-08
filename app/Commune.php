<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model {

    //

    protected $table = 'commune';


    protected $fillable = [
        'id',
        'nomcommune	',
        'idwilaya',
        'idSecteur'];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;


}
