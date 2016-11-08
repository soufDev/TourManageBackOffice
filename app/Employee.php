<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'id', 'nom', 'prenom', 'identifiant', 'email',
        'password','adresse','telephone','id_profil', 'dateNaissance'
    ];
}
