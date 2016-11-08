<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests;
use App\Transporteur;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class GestionCompteController extends Controller {

    //affichier les comptes
    public function getComptes(){


        $comptes = DB::table('users')
            ->select('users.id', 'users.nom', 'users.prenom', 'users.identifiant', 'users.email', 'users.adresse', 'users.telephone',
                'users.id_profil', 'users.dateNaissance')
            ->get();
        // decripter les mots de passes
        /*for($i=0 ; $i < count($comptes) ; $i++ ){
            $comptes[$i]->password = Hash::make( "000000" );
            Employee::find($comptes[$i]->id)->update([ 'password' => $comptes[$i]->password  ]);
        }
        */
        return $comptes;
    }


    // Affiche la vue correspondante
    public function index(){
        return view('administration.ListeCompte');
    }

    public function edit($id){
        $compte =  DB::table('users')
            ->where('users.id', '=', $id)
            ->select('users.id', 'users.nom', 'users.prenom', 'users.identifiant')
            ->get();
        //$compte->password = Crypt::decrypt( $compte->password );
        return $compte;
    }

    // modifier un compte
    public function update($id) {

        $input = [
            'identifiant' => Input::get('identifiant'),
            'nom' => Input::get('nom'),
            'prenom' => Input::get('prenom'),
        ];

        $employee = Employee::find($id);
        if (Input::get('password') != '' ){
            if ( $employee->id_profil == 3 ){
                $input['password'] = md5(Input::get('password') );
            }else{
                $input['password'] = bcrypt( Input::get('password') );
            }
        }
        Employee::find($id)->update($input);
        $data = ['success'=>true, 'msg'=>'MAJ avec Succés'];
        return Response::json($data);
    }

    // Supprimer un compte
    public function destroy($id) {
        Employee::find($id)->delete();
        Transporteur::where('id',$id)->delete();
        $data = ['sucess'=>true, 'msg'=>'Supprimer avec Succés'];

        return Response::json($data);
    }


    public function store(){
        return view('administration.ListeCompte');
    }



}
