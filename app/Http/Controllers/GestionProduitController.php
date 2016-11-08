<?php

namespace App\Http\Controllers;

use App\Prix;
use App\Produit;
use App\Category;
use App\Taxe;
use Illuminate\Http\Request;
use App\Http\Requests\ProduitRequest;
use DB;

use Illuminate\Foundation\Bus\DispatchesJobs;


use App\Http\Requests;


class GestionProduitController extends Controller
{
    //

    public function index(){

        $produits = Produit::with('category','taxe')->get();
        $prix = Prix::with('produit')->get();





        return view('pages.ListeProduit',compact('produits','prix'));

    }


    public  function create(){
        $categories= Category::lists('nom','id');
        $taxes = Taxe::lists('taux','id','libelle');
        return view('pages.AjouterProduit',compact('categories','taxes'));
    }


    public function store(Requests\ProduitRequest $request){






        $produits = Produit::create($request->all());


        $produits->category()->associate($request->idCategorie);

        $produits = Produit::with('category','taxe')->get();




        return redirect('produit');





    }
}
