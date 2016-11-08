<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Vehicule;


class VehiculeController extends Controller
{
    //

    public function index()
    {
        $vehicules = Vehicule::all();
        return view('pages.ListeVehicule', compact('vehicules'));
    }


    public function AjouterVehicule()
    {
        return view('pages.AjouterVehicule');
    }

    //
    public function insererVehicule(Request $request)
    {
        $validation =Validator::make($request->all(), ['matricule' => 'required|min:8|max:11', 'KMDebut' => 'required', 'capacite'  => 'required']);


        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $matricule = $request->input('matricule');
        $KMDebut=  $request->input('KMDebut');
        $capacite = $request->input('capacite');


        Vehicule::create( array('matricule' => $matricule , 'KMDebut' => $KMDebut , 'capaciteStockage' => $capacite));
        //dd($matricule);
        return redirect('vehicule');
    }

    public function ModifierVehicule($id)
    {
        $vehicule = Vehicule::find($id);

        return view('pages.ModifierVehicule', compact('vehicule'));
    }


    public function SauvegarderModification($id, Request $request)
    {

        $validation =Validator::make($request->all(), ['matricule' => 'required|min:11', 'KMDebut' => 'required', 'capacite'  => 'required']);


        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $matricule = $request->input('matricule');
        $KMDebut=  $request->input('KMDebut');
        $capacite = $request->input('capacite');

        Vehicule::find($id)
            ->update( array(
                'matricule' => $matricule ,
                'KMDebut' => $KMDebut ,
                'capaciteStockage' => $capacite
            ));

        return redirect('vehicule');

    }

    public function SupprimerVehicule($id)
    {
        Vehicule::where('id', '=', $id)->delete();
        return redirect('vehicule');
    }



}
