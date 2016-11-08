<?php

namespace App\Http\Controllers;

use App\LigneCommande;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class realiserLivraisonController extends Controller {

    public function getRealiserLivraisonLigneCommande($idCommande){
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
                , 'lignecommande.quantite_livree_reel', 'lignecommande.commentaire')
            ->get();

        $transporteurs = DB::table('users')
            ->join('transporteur', 'users.id', '=', 'transporteur.idEmployee')
            ->select('users.id', 'users.nom', 'users.prenom')
            ->get();

        return compact('livraison_infos', 'lignes_commandes', 'transporteurs');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('livraison.realiserLivraison');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $ligne = DB::table('lignecommande')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('lignecommande.id', '=', $id)
            ->select('lignecommande.id', 'produit.reference', 'lignecommande.QuantiteCmd as quantiteCmd', 'lignecommande.quantiteLivree',
                'lignecommande.quantite_livree_reel', 'lignecommande.commentaire')
            ->get();
        return $ligne;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {

        $ligneCommande = LigneCommande::find($id);
        $ligneCommande->quantiteLivree = Input::get('quantiteLivree');
        $ligneCommande->commentaire = Input::get('commentaire');
        $ligneCommande->statut = "commentaire";
        $ligneCommande->quantite_livree_reel = Input::get('quantite_livree_reel');

        $ligneCommande->save();

        $data = ['success'=>true, 'msg'=>'MAJ avec Succée'];
        return Response::json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
