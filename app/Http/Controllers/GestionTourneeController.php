<?php

namespace App\Http\Controllers;

use App\Tournees;
use App\Vehicule;
use Illuminate\Http\Request;

use App\Http\Requests;

class GestionTourneeController extends Controller {

    // Recuperer les données necessaires pour notre Objet Tournée
    public function getTournees() {
        $transporteurs_affectes_tournes = Tournees::
        where('statut', '=', 'EN COURS')
            ->lists('idTransporteur');

        $vehicule_affectes_tournes = Tournees::
        where('statut', '=', 'EN COURS')
            ->lists('idvehicule');

        $transporteurs = DB::table('users')
            ->join('transporteur', 'users.id', '=', 'transporteur.idEmployee')
            ->whereNotIn('transporteur.id', $transporteurs_affectes_tournes)
            ->select('users.id','transporteur.id as idTransporteur', 'users.nom', 'users.prenom')
            ->get();

        $tournees = DB::table('tournee')
            ->join('transporteur', 'transporteur.id', '=', 'tournee.idTransporteur')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->select('tournee.*', 'users.nom', 'users.prenom')
            ->get();
        $vehicules = Vehicule::
        whereNotIn('id', $vehicule_affectes_tournes)
            ->get();

        return compact('tournees', 'transporteurs', 'vehicules', 'transporteurs_affectes_tournes');
    }

    public function SelectionTournee(){
        return view('tournee.tourner_a_generer');
    }

    public function planificationTournee(){
        return view('tournee.planification_tournee');
    }

    public function suiviDesTournee(){
        return view('tournee.suivi_des_tournee');
    }

    public function suiviTournee(){
        return view('tournee.suivi_tournee');
    }
}
