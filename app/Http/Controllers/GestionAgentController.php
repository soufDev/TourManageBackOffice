<?php

namespace App\Http\Controllers;

use App\employee;
use App\Http\Requests;
use App\Profil;
use App\Secteur;
use App\Transporteur;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Mockery\CountValidator\Exception;

class GestionAgentController extends Controller {

    // Afficher Tout les employés
    public function getEmployes() {

        $employes = DB::table('users')
            ->join('profil','users.id_profil','=','profil.id')
            ->join('transporteur','users.id', '=', 'transporteur.idEmployee')
            ->join('secteur','transporteur.id_secteur', '=', 'secteur.id')
            ->select('users.*', 'secteur.id as id_secteur', 'secteur.nomsecteur as nomSecteur')
            ->get();
        /*
                        ->join('profil','users.id_profil','profil.id')
                        ->join('transporteur','users.id','transporteur.idEmploye')
                        ->select('users.*', 'transporteur.id_secteur' )
                        ->get();

*/

        $secteurs = Secteur::all();
        $profils = Profil::all();
        return compact('employes', 'secteurs', 'profils');

    }

    // Afficher La vue listeAgent
    public function index() {
        return view('administration.ListeAgent');
    }

    //
    public function create(){

    }

    // fonction pour Ajouter un nouvel Employe
    public function store(){
        $input_employe = [
            'identifiant'=>Input::get('identifiant'),
            'nom'=>Input::get('nom'),
            'prenom'=>Input::get('prenom'),
            'email'=>Input::get('email'),
            'password'=> bcrypt( Input::get('password') ),
            'telephone'=>Input::get('telephone'),
            'adresse'=>Input::get('adresse'),
            'dateNaissance'=> Input::get('dateNaissance'),
            'id_profil' => Input::get('id_profil'),
        ];

        try{
            if ( $input_employe['id_profil'] == 3){
                $input_employe['password'] = md5(Input::get('password') );
            }
            User::create( $input_employe );
        }catch(Exception $e){
            $msg = $e->getMessage();
            return $msg;
        }
        // recuperer l'id de l'employe inseré precedement

        $id_employe= DB::table('users')->where('identifiant', '=', Input::get('identifiant') )->value('id') ;
        $profil = DB::table('profil')->where('id', '=', Input::get('id_profil') )->value('nom');
        $id_secteur = Input::get('id_secteur');


        // si le profil est un transporteur alors l'inserer dan la table transporteut
        if( strtolower( $profil ) == 'transporteur' ){

            $tranporteur_input = [
                'idEmployee'=> $id_employe,
                'id_secteur'=> $id_secteur,
                'Designation' => 'Designation',
                'Contrat' => 'Contrat',
            ];

            Transporteur::create( $tranporteur_input );

        }


        $data = ['success'=>true, 'msg'=>'Ajouter Avec Succes'];
        return Response::json($data, 200);
    }

    //
    public function show() {

    }

    // fonction qui nous retourne l'element selectionné
    public function edit($id){

        $agent = DB::table('users')
            ->join('profil','users.id_profil','=','profil.id')
            ->join('transporteur','users.id', '=', 'transporteur.idEmployee')
            ->join('secteur','transporteur.id_secteur', '=', 'secteur.id')
            ->where('users.id','=',$id)
            ->select('users.id', 'users.nom', 'users.prenom', 'users.identifiant', 'users.email', 'users.adresse', 'users.telephone',
                'users.id_profil', 'users.dateNaissance', 'secteur.id as id_secteur', 'secteur.nomsecteur as nomSecteur')
            ->get();

        //$agent->password = Crypt::decrypt( $agent->password );
        return $agent;
    }

    // fonction pour mette a jour les donnée dun employé
    public function update($id){

        //$date = substr( $date, 0, sizeof($date)-6 )."Z";
        $input = [
            'identifiant'=>Input::get('identifiant'),
            'nom'=>Input::get('nom'),
            'prenom'=>Input::get('prenom'),
            'email'=>Input::get('email'),
            'telephone'=>Input::get('telephone'),
            'adresse'=>Input::get('adresse'),
            'id_profil' => Input::get('id_profil'),
            'dateNaissance' => Input::get('dateNaissance')  ,
        ];
        if (Input::get('password') != '' ){
            if ( $input['id_profil'] == 3){
                $input['password'] = md5(Input::get('password') );
            }else{
                $input['password'] = bcrypt( Input::get('password') );
            }
        }
        
        Employee::find($id)->update( $input );

        // recuperer le profil
        $profil = DB::table('profil')->where('id', '=', Input::get('id_profil') )->value('nom');
        if( strtolower( $profil ) == "transporteur" ){

            // mettre a jour aussi la table transporteur
            $input_transporteur = [
                'id_secteur'=>Input::get('id_secteur'),
                'Designation'=>'Designation',
                'Contrat'=>'contrat',
            ];
            $transporteur = Transporteur::where('idEmployee', '=', $id)->update($input_transporteur);

        }else {
            Transporteur::where('idEmployee', '=', $id)->delete();
        }
        $data = ['success'=>true, 'msg' => 'MAJ Avec Succés'];
        return Response::json($data, 200);
    }

    // fonction pour supprimer
    public function destroy($id){
        $employe = Employee::find($id)->delete();
        $data = ['success'=>true, 'msg'=>'Supprimer Avec Succés'];
        return Response::json($data, 200);

    }


}
