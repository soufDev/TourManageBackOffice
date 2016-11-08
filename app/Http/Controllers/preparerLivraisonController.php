<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\LigneCommande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class preparerLivraisonController extends Controller {

    public function getLigneCommandeLivraison($idCommande){
        $livraison_infos = DB::table('livraison')
            ->join('commandeclient', 'livraison.id', '=', 'commandeclient.idLivraison')
            ->join('client', 'commandeclient.idClient', '=', 'client.id')
            ->join('transporteur', 'livraison.idTransporteur' ,'=', 'transporteur.id')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->where('commandeclient.id', '=', $idCommande)
            ->select('livraison.id as id', 'commandeclient.id as idCommande',
                'client.id as idClient', 'transporteur.idEmployee as idTransporteur',
                'users.nom as transporteurNom', 'users.prenom as transporteurPrenom', 'livraison.DateLivraisonPrev',
                'livraison.DateLivraisonReel', 'livraison.statut', 'client.nom as clientNom', 'client.prenom as clientPrenom')
            ->get();

        $lignes_commandes = DB::table('commandeclient')
            ->join('lignecommande', 'commandeclient.id', '=', 'lignecommande.idCommande')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('commandeclient.id', '=', $idCommande)
            ->select('lignecommande.id', 'produit.reference', 'produit.Designation as designation',
                'lignecommande.QuantiteCmd as quantiteCmd', 'lignecommande.quantiteLivree'
                , 'lignecommande.quantite_livree_reel')
            ->get();

        $transporteurs = DB::table('users')
            ->join('transporteur', 'users.id', '=', 'transporteur.idEmployee')
            ->select('users.id', 'users.nom', 'users.prenom', 'transporteur.id as idTransporteur')
            ->get();

        return compact('livraison_infos', 'lignes_commandes', 'transporteurs');
    }

    public function index(){
        return view('livraison.preparerLivraison');
    }
    
    public function edit($idLigneCommande){
        //$ligne = LigneCommande::find($idLigneCommande)->get();
        $ligne = DB::table('lignecommande')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('lignecommande.id', '=', $idLigneCommande)
            ->select('lignecommande.id', 'produit.reference', 'lignecommande.QuantiteCmd', 'lignecommande.quantiteLivree', 'lignecommande.quantite_livree_reel')
            ->get();
        return $ligne;
    }



    public function update($idLigneCommande){
        $input = [
            'QuantiteCmd' => Input::get('QuantiteCmd'),
            'quantiteLivree' => Input::get('quantiteLivree'),
            'quantite_livree_reel' => Input::get('quantite_livree_reel')
        ];
        LigneCommande::find($idLigneCommande)->update($input);

        $data = ['success'=>true, 'msg'=>'MAJ Avec Succés'];
        return Response::json($data, 200);
    }

    public function destroy($idLigneCommande){
        LigneCommande::find( $idLigneCommande )->delete();
        $data = ['success'=>true, 'msg'=>'Suprimmée Avec Succés'];
        return Response::json($data, 200);
    }

    public function valider($idLivraison){
        
    }


}
