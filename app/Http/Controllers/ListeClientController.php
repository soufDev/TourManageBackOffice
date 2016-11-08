<?php

namespace App\Http\Controllers;
use App\Client;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;





class ListeClientController extends Controller
{

    public function index(){

        $clients = Client::all();
        return view('pages.ListeClient',compact('clients'));
    }


    public function getAjouterClient()
    {
        return view('pages.AjouterClient');
    }


    public  function postajouterClient(Request $request)
    {


        $validation =Validator::make($request->all(), ['nomClient' => 'required|min:4', 'prenomClient' => 'required|min:4', 'segement'  => 'required', 'email'  => 'required|Email', 'telephone' => 'required', 'societe' => 'required']);


        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $nom = $request->input('nomClient');
        $prenom=  $request->input('prenomClient');
        $segement = $request->input('segement');
        $email = $request->input('email');
        $telephone= $request->input('telephone');
        $date= date('Y-m-d') ;
        $societe=$request->input('societe');


        Client::create( array('Nom' => $nom , 'Prenom' => $prenom , 'SegmentClient' => $segement , 'DateCreation' => $date , 'Email' => $email , 'telephone' => $telephone , 'NomSociete' => $societe));

        return redirect('client')->with('message','Client Ajouté Avec Succès');
    }


    public function getmodifierClient($id)
    {
        $client= Client::find($id);

        return view('pages.ModifierClient',compact('client'));
    }


    public function postmodifierClient($id, Request $request)
    {


        $validation =Validator::make($request->all(), ['nomClient' => 'required|min:4|Alpha', 'prenomClient' => 'required|min:4|Alpha', 'dateAjout'  => 'required', 'segement'  => 'required', 'email'  => 'required|Email', 'telephone' => 'required', 'societe' => 'required']);


        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $nom = $request->input('nomClient');
        $prenom=  $request->input('prenomClient');
        $segement = $request->input('segement');
        $email = $request->input('email');
        $telephone= $request->input('telephone');
        $date= $request->input('dateAjout');
        $societe=$request->input('societe');

        $client=Client::find($id);
        $client->update( array('Nom' => $nom , 'Prenom' => $prenom , 'SegmentClient' => $segement , 'DateCreation' => $date , 'Email' => $email , 'telephone' => $telephone , 'NomSociete' => $societe));

        return redirect('client');
    }


    public function postsupprimerClient($id)
    {
        Client::where('id', '=', $id)->delete();
        return redirect('client');
    }

}

