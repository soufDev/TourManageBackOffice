<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model {

    //

    protected $table = 'wilaya';


    protected $fillable = [
        'id',
        'wilaya'];



    public function getKeyName(){
        return 'id';
    }

    public $timestamps = false;


}
