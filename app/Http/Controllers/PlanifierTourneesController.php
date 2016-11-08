<?php

namespace App\Http\Controllers;

use App\Tournees;
use App\TraceStockTournee;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PlanifierTourneesController extends Controller {

    public function getPlanificationTournesData() {
        $transporteurs = $this->getTransporteurs();
        return compact('transporteurs');
    }

    // Recuperer les données selon le transporteur
    public function getDataWithIdTransporteur() {
        $idTransporteur = Input::get('transporteur');
        $etapes = $this->getEtapeByIdTransporteur($idTransporteur);
        $stockTournees = $this->getStockByTransporteur($idTransporteur);
        $livraisons = $this->getLivaisonPlanifierByTransporteur($idTransporteur);
        return compact('etapes', 'stockTournees', 'livraisons');
    }

    // recuperer les données selon la date
    public function getDataWithDate(){
        $date = Input::get('dateTournee');
        $etapes = $this->getEtapeByDate($date);
        $stockTournees = $this->getStockByDate($date);
        $livraisons = $this->getLivaisonPlanifierByDate($date);
        return compact('etapes', 'stockTournees', 'livraisons');
    }

    // recuperer les données selon la date et le transporteur
    public function getData(){
        $idTransporteur = Input::get('transporteur');
        $date = Input::get('dateTournee');
        $etapes = $this->getEtapeByIdTransporteurAndDate($idTransporteur, $date);
        $stockTournees = $this->getStock($idTransporteur, $date);
        $livraisons = $this->getLivaisonPlanifier($idTransporteur, $date);
        return compact('etapes', 'stockTournees', 'livraisons');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('tournee/planification_tournee');
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
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $stockTournee = TraceStockTournee::find($id);
        $stockTournee->stockinitialReel = Input::get('stockinitialReel');
        $stockTournee->stockEncours = Input::get('stockinitialReel');
        $stockTournee->save();

        return "Mofication Réussie";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

    }


    // recuperer toutes les etapes
    public function getEtapeByIdTransporteur($idTransporteur) {
        return DB::table('etapetournee')
            ->join('livraison', 'livraison.id', '=', 'etapetournee.idLivraison')
            ->join('tournee', 'tournee.id', '=', 'livraison.idTournee')
            ->join('client', 'client.id', '=', 'etapetournee.idClient')
            ->where('tournee.idTransporteur', '=', $idTransporteur)
            ->select('client.id', 'etapetournee.idClient as idClient', 'client.Nom', 'client.Prenom', 'client.adresse', 'etapetournee.motifvisit', 'etapetournee.numEtape', 'etapetournee.statut')
            ->get();
    }

    public function getEtapeByDate($date) {
        return DB::table('etapetournee')
            ->join('livraison', 'livraison.id', '=', 'etapetournee.idLivraison')
            ->join('tournee', 'tournee.id', '=', 'livraison.idTournee')
            ->join('client', 'client.id', '=', 'etapetournee.idClient')
            ->where('tournee.DateDebut', '=', $date)
            ->select('client.id', 'etapetournee.idClient as idClient', 'client.Nom', 'client.Prenom', 'client.adresse', 'etapetournee.motifvisit', 'etapetournee.numEtape', 'etapetournee.statut')
            ->get();
    }

    public function getEtapeByIdTransporteurAndDate($idTransporteur, $date) {
        return DB::table('etapetournee')
            ->join('livraison', 'livraison.id', '=', 'etapetournee.idLivraison')
            ->join('tournee', 'tournee.id', '=', 'livraison.idTournee')
            ->join('client', 'client.id', '=', 'etapetournee.idClient')
            ->where('tournee.idTransporteur', '=', $idTransporteur)
            ->where('tournee.DateDebut', '=', $date)
            ->select('client.id', 'etapetournee.idClient as idClient', 'client.Nom', 'client.Prenom', 'client.adresse', 'etapetournee.motifvisit', 'etapetournee.numEtape', 'etapetournee.statut')
            ->get();
    }



    // recuperer tout les transporeur affecter aux tounrnees en cours
    public function getTransporteurs() {
        return DB::table('users')
            ->join('transporteur', 'transporteur.idEmployee', '=', 'users.id')
            ->whereIn('transporteur.id', $this->AgentAlreadyAffected() )
            ->select('users.id as idUsers', 'transporteur.id', 'users.nom', 'users.prenom')
            ->get();
    }

    // recuperer les toutes l'id des transporteur deja affecter aux tournees en cours
    public function AgentAlreadyAffected() {
        return Tournees::
        where('statut', '=', 'EN COURS')
            ->lists('idTransporteur');
    }

    // recuperer le stock a chargé
    public function getStock($idTransporteur, $date) {
        return DB::table('tracestocktournee')
            ->join('produit', 'produit.id', '=', 'tracestocktournee.idProduit')
            ->whereIn('tracestocktournee.idTournee', $this->getTourneeID($idTransporteur, $date) )
            ->select('tracestocktournee.id', 'produit.reference', 'produit.Designation', 'tracestocktournee.stockinitialReel',
                'tracestocktournee.stockinitialestime' , 'tracestocktournee.stockFinalReel', 'tracestocktournee.stockFinalEstime', 'tracestocktournee.stockEncours')
            ->get();
        /*
        return DB::table('tournee')
            //->join('tournee', 'tournee.id', '=', 'tracestocktournee.idTournee')
            ->join('livraison', 'livraison.idTournee', '=', 'tournee.id')
            ->join('commandeclient', 'commandeclient.idLivraison', '=', 'livraison.id')
            ->join('lignecommande', 'lignecommande.idCommande', '=', 'commandeclient.id')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('tournee.idTransporteur', '=', $idTransporteur)
            ->where('tournee.DateDebut', '=', $date)
            ->select('livraison.id as idLivraison', 'commandeclient.id as idCommande', 'produit.id as idProduit',
                'produit.Designation', 'produit.reference', DB::raw('SUM(lignecommande.QuantiteCmd - lignecommande.quantiteLivree) as quantiteCmd') )
            ->groupBy('idProduit')
            ->orderBy('idProduit')
            ->get();
        */
    }

    public function getStockByTransporteur($idTransporteur) {
        return DB::table('tracestocktournee')
            ->join('produit', 'produit.id', '=', 'tracestocktournee.idProduit')
            ->whereIn('tracestocktournee.idTournee', $this->getTourneeIDByTransporteur($idTransporteur) )
            ->select('tracestocktournee.id', 'produit.reference', 'produit.Designation', 'tracestocktournee.stockinitialReel',
                'tracestocktournee.stockinitialestime' , 'tracestocktournee.stockFinalReel', 'tracestocktournee.stockFinalEstime', 'tracestocktournee.stockEncours')
            ->get();
        /*
        return DB::table('tournee')
            //->join('tournee', 'tournee.id', '=', 'tracestocktournee.idTournee')
            ->join('livraison', 'livraison.idTournee', '=', 'tournee.id')
            ->join('commandeclient', 'commandeclient.idLivraison', '=', 'livraison.id')
            ->join('lignecommande', 'lignecommande.idCommande', '=', 'commandeclient.id')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('tournee.idTransporteur', '=', $idTransporteur)
            ->select('livraison.id as idLivraison', 'commandeclient.id as idCommande', 'produit.id as idProduit',
                'produit.Designation', 'produit.reference', DB::raw('SUM(lignecommande.QuantiteCmd - lignecommande.quantiteLivree) as quantiteCmd') )
            ->groupBy('idProduit')
            ->orderBy('idProduit')
            ->get();
        */
    }

    public function getStockByDate($date) {
        return DB::table('tracestocktournee')
            ->join('produit', 'produit.id', '=','tracestocktournee.idProduit')
            ->whereIn('tracestocktournee.idTournee', $this->getTourneeIDByDate($date) )
            ->select('tracestocktournee.id', 'produit.reference', 'produit.Designation', 'tracestocktournee.stockinitialReel',
                'tracestocktournee.stockinitialestime' , 'tracestocktournee.stockFinalReel', 'tracestocktournee.stockFinalEstime', 'tracestocktournee.stockEncours')
            ->get();
        /*
        return DB::table('tournee')
            //->join('tournee', 'tournee.id', '=', 'tracestocktournee.idTournee')
            ->join('livraison', 'livraison.idTournee', '=', 'tournee.id')
            ->join('commandeclient', 'commandeclient.idLivraison', '=', 'livraison.id')
            ->join('lignecommande', 'lignecommande.idCommande', '=', 'commandeclient.id')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('tournee.DateDebut', '=', $date)
            ->select('livraison.id as idLivraison', 'commandeclient.id as idCommande', 'produit.id as idProduit',
                'produit.Designation', 'produit.reference', DB::raw('SUM(lignecommande.QuantiteCmd - lignecommande.quantiteLivree) as quantiteCmd') )
            ->groupBy('idProduit')
            ->orderBy('idProduit')
            ->get();*/
    }

    // Retourner les livraisons planifiees
    public function getLivaisonPlanifierByTransporteur($idTransporteur){
        return DB::table('commandeclient')
            ->join('client', 'client.id', '=', 'commandeclient.idClient')
            ->join('livraison', 'livraison.id', '=', 'commandeclient.idLivraison')
            ->where('livraison.idTransporteur', '=', $idTransporteur)
            ->whereIn('commandeclient.idLivraison', $this->getLivraisonsTournees() )
            ->select('commandeclient.idLivraison as idLivraison', 'commandeclient.id as idCommande', 'client.Nom as nomClient', 'client.Prenom as prenomClient', 'livraison.statut', 'livraison.motifnonlivraison')
            ->get();
    }

    public function getLivaisonPlanifierByDate($date){
        return DB::table('commandeclient')
            ->join('client', 'client.id', '=', 'commandeclient.idClient')
            ->join('livraison', 'livraison.id', '=', 'commandeclient.idLivraison')
            ->join('tournee', 'tournee.id', '=', 'livraison.idTournee')
            ->where('tournee.DateDebut', '=', $date)
            ->whereIn('commandeclient.idLivraison', $this->getLivraisonsTournees() )
            ->select('commandeclient.idLivraison as idLivraison', 'commandeclient.id as idCommande', 'client.Nom as nomClient', 'client.Prenom as prenomClient', 'livraison.statut', 'livraison.motifnonlivraison')
            ->get();
    }

    public function getLivaisonPlanifier($idTransporteur, $date){
        return DB::table('commandeclient')
            ->join('client', 'client.id', '=', 'commandeclient.idClient')
            ->join('livraison', 'livraison.id', '=', 'commandeclient.idLivraison')
            ->join('tournee', 'tournee.id', '=', 'livraison.idTournee')
            ->where('livraison.idTransporteur', '=', $idTransporteur)
            ->where('tournee.DateDebut', '=', $date)
            ->whereIn('commandeclient.idLivraison', $this->getLivraisonsTournees() )
            ->select('commandeclient.idLivraison as idLivraison', 'commandeclient.id as idCommande', 'client.Nom as nomClient', 'client.Prenom as prenomClient', 'livraison.statut', 'livraison.motifnonlivraison')
            ->get();
    }

    // Les ID des livraisons qui sont affectée a des tournees
    public function getLivraisonsTournees() {
        return DB::table('livraison')
            ->join('tournee', 'tournee.id', '=', 'livraison.idTournee')
            ->where('tournee.statut', '=', 'EN COURS')
            ->lists('livraison.id');
    }

    // retourner les ids des Trounee selon la date ou le transporteur
    public function getTourneeIDByDate($date){
        return Tournees::where('DateDebut', '=', $date)->lists('id');
    }

    public function getTourneeIDByTransporteur($idTransporteur){
        return Tournees::where('idTransporteur', '=', $idTransporteur)->lists('id');
    }

    public function getTourneeID($idTransporteur, $date){
        return Tournees::where('DateDebut', '=', $date)
            ->where('idTransporteur', '=', $idTransporteur)
            ->lists('id');
    }



}
