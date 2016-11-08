<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transporteur extends Model {

    protected $table='transporteur';

    public $fillable = ['id','idEmployee', 'id_secteur', 'Designation', 'Contrat'];

    public $timestamps = false;

    public static function TransporteurInfos() {
        return DB::table('transporteur')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->select('transporteur.id', 'users.nom', 'users.prenom')
            ->get();
    }
    public static function TransporteurNotAffectedToLivraison(){
        return DB::table('transporteur')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->whereNotIn('transporteur.id', self::TransporteurAlreadyAffectedToLivraison() )
            ->select('transporteur.id', 'users.nom', 'users.prenom', 'users.id')
            ->get();
    }

    public static function TransporteurAlreadyAffectedToLivraison(){
        return Livraison::where('statut', '=', 'EN COURS')
            ->lists('idTransporteur');
    }

}
