<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $table = 'livraison';

    public $fillable = ['id','idTournee', 'DateLivraisonPrev', 'DateLivraisonReel', 'idTransporteur', 'statut'];
    
    public $timestamps = false;

    // retournée la livraison si ell existe
    public static function getLivraisonByDate($date, $idTransporteur){
        return self::where('DateLivraisonPrev', '=', $date)
            ->where('idTransporteur' , '=', $idTransporteur)
            ->get();
    }

    // generer une Livraison
    public static function GenLivraison($date, $idTransporteur, $idCommandes){
        $livraison = self::getLivraisonByDate($date, $idTransporteur) ;
        if( count( $livraison ) != 0 ){
            $idLivraison = $livraison->id;
            for( $i=0 ; $i<count($idCommandes) ; $i++ ) {
                Commande::where('id', '=', $idCommandes[$i])
                    ->update(['idLivraison'=>$idLivraison]);
            }

        }else {
            $input=[
                'DateLivraisonPrev'=> $date,
                'DateLivraisonReel'=> $date,
                'idTransporteur'=> $idTransporteur,
                'statut' => 'EN COURS'
            ];
            Livraison::create($input);
            $idLivraison = Livraison::orderBy('id', 'DESC')->first()->id;
            for( $i=0 ; $i<count($idCommandes) ; $i++ ){
                Commande::find($idCommandes[$i])->update(['idLivraison' => $idLivraison]);
            }

        }
    }
}
