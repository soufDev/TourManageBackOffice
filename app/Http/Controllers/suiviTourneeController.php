<?php

namespace App\Http\Controllers;

use App\Tournees;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class suiviTourneeController extends Controller {

    // retournee les donnée dont nous avons besoin
    public function getData(){
        $transporteurs = $this->getTransporteurs();
        return compact('transporteurs');
    }

    // retourner els tournees
    public function getTourneesTransporteur(){
        $idTransporteur = Input::get('transporteur');
        return $this->tourneeTransporteur($idTransporteur);
    }

    public function getTourneesDate(){
        $date = Input::get('dateTournee');
        return $this->tourneeDate($date);
    }

    public function getTournee(){

        $idTransporteur = Input::get('transporteur');
        $date = Input::get('dateTournee');
        return $this->tournee($idTransporteur, $date);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('tournee.suivi_des_tournee');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    // recuperer les toutes l'id des transporteur deja affecter aux tournees en cours
    public function AgentAlreadyAffected() {
        return Tournees::
        where('statut', '=', 'EN COURS')
            ->lists('idTransporteur');
    }

    // recuperer tout les transporeur affecter aux tounrnees en cours
    public function getTransporteurs() {
        return DB::table('users')
            ->join('transporteur', 'transporteur.idEmployee', '=', 'users.id')
            ->whereIn('transporteur.id', $this->AgentAlreadyAffected() )
            ->select('users.id as idUsers', 'transporteur.id', 'users.nom', 'users.prenom')
            ->get();
    }

    // retournner les tournnees
    public function tourneeTransporteur($idTransporteur){
        return DB::table('tournee')
            ->join('transporteur', 'transporteur.id', '=', 'idTransporteur')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->where('idTransporteur', '=', $idTransporteur)
            ->select('tournee.id', 'tournee.statut', 'tournee.DateDebut', 'users.nom', 'users.prenom')
            ->get();
    }

    public function tourneeDate($date){
        return DB::table('tournee')
            ->join('transporteur', 'transporteur.id', '=', 'tournee.idTransporteur')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->where('DateDebut', '=', $date)
            ->select('tournee.id', 'tournee.statut', 'tournee.DateDebut', 'users.nom', 'users.prenom')
            ->get();
    }

    public function tournee($idTransporteur, $date){
        return DB::table('tournee')
            ->join('transporteur', 'transporteur.id', '=', 'idTransporteur')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->where('idTransporteur', '=', $idTransporteur)
            ->where('DateDebut', '=', $date)
            ->select('tournee.id', 'tournee.statut', 'tournee.DateDebut', 'users.nom', 'users.prenom')
            ->get();
    }


}
