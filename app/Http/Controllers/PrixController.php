<?php

namespace App\Http\Controllers;

use App\Taxe;
use Illuminate\Http\Request;
use App\Prix;
use App\Produit;
use App\Http\Requests\PrixRequest;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class PrixController extends Controller
{
    public function index(){
        return view('pages.prix');
    }

    public function create($id){
       //$produits= Produit::lists('Designation','id','idProduit','tauxTVA','PrixAchatAppliquee','tauxTVA');

        $produits = Produit::findOrFail($id);
       $taxes = Taxe::findOrFail($produits->tauxTVA);
        $taux = Taxe::findOrFail($taxes->id);





        //$produits = Produit::with('taxe')->get();
        //dd($produits);



        return view('pages.prix',compact('produits','taxes','taux'));

    }
    public function store(PrixRequest  $requestP){


        $prix = Prix::create($requestP->all());

        $prix->produit()->associate($requestP->idProduit);

        $prix = Prix::with('produit')->get();

        //return view('pages.ListeProduit',compact('prix'));
        return redirect('produit');





    }
}
