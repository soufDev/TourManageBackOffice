<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\LigneCommande;
use App\Client;
use DB;
use App\Produits;
use App\Transporteur;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
USE App;
use Mockery\CountValidator\Exception;

class GestionCommandeController extends Controller {

    public function genLivraison(){
        $date = Input::get('dateLivraison');
        $id_commandes = Input::get('id_commandes');
        $transporteur = Input::get('transporteur');
        try{
            App\Livraison::GenLivraison($date, $transporteur, $id_commandes);
            $msg = 'Livraison Generée Avec Succée';

            return $msg;
        }catch (Exception $e){
            return 'il y a un problem'. $e->getMessage();
        }

    }
    //
    public function index(){

        LigneCommande::where('statut','=','new_temp_s')->delete();
        LigneCommande::where('statut','=','new_temp')->delete();
        LigneCommande::where('statut','=','old_temp_s')->update(array('statut'=>'valider'));

        $transporteurs = Transporteur::TransporteurInfos();
        $commandes=Commande::where('statut', 'not like' ,'temp')->where('statut', 'not like' ,'Annuler')->get();
        //$commandes=Commande::where('statut', 'not like' ,'temp')->get();


        return view('pages.ListeCommande',compact('commandes', 'transporteurs'));
    }



    public function Ajouter(){

        $today = getdate();
        $tva=0;
        $ttc=0;

        if($today['mon']<10)
        {
            $month="0".$today['mon'];
        }
        else
        {
            $month=$today['mon'];
        }

        $date=$today['year'].'-'.$month.'-'.$today['mday'];

        $newCommande=Commande::all() -> last();

        $clients=Client::all();


        if($newCommande==null)
        {
            $newCommande=Commande::create(array('DateCreation'=>$date,'statut'=>'temp'));
            $lignes=DB::table('lignecommande')->where('idCommande', '=', $newCommande->id)->get();
            return view('pages.ajouterCommande',compact('newCommande', 'clients','lignes', 'tva' , 'ttc'));
        }
        else if($newCommande->statut != 'temp')
        {
            $newCommande=Commande::create(array('DateCreation'=>$date,'statut'=>'temp'));
            $lignes=DB::table('lignecommande')->where('idCommande', '=', $newCommande->id)->get();
            return view('pages.ajouterCommande',compact('newCommande', 'clients','lignes' , 'tva','ttc'));
        }
        else
        {
            $newCommande->update(array('DateCreation'=>$date));
            $lignes=DB::table('lignecommande')->where('idCommande', '=', $newCommande->id)->get();

            foreach($lignes as $ligne)
            {
                $idTVA= DB::table('produit')->where('id','=', $ligne->idProduit)->first()->tauxTVA;
                $tauxTVA=DB::table('tva')->where('id','=',$idTVA)->first()->taux*0.01;
                $tva=$tva+$ligne->totalPrixHT*$tauxTVA;
            }
            $ttc=DB::table('lignecommande')->where('idCommande','=',$newCommande->id)->sum('totalPrixTTC');
            return view('pages.ajouterCommande',compact('newCommande', 'clients', 'lignes' , 'tva','ttc'));
        }

    }


    public function AjouterLigneCommande($id, Request $request)
    {
        $idProduit=Produits::where('reference','=',$request->input('reference'))->first()->id;
        $idCommande=$id;
        $quantiteCmd=$request->input('quantite-cmd');
        $qunatiteLvr=0;
        $prixHT=$request->input('prix-u-ht');
        $prixTTC=$request->input('prix-u-ttc');
        $totalHT=$quantiteCmd*$prixHT;
        $totalTTC=$request->input('prix-t-ttc');
        $tauxRemise=$request->input('taux-remise');
        $montantRemise=$request->input('montant-t-remise');

        LigneCommande::create(array('idProduit' => $idProduit ,
                                        'idCommande' => $idCommande,
                                        'quantiteCmd' => $quantiteCmd ,
                                        'quantiteLivree' => $qunatiteLvr ,
                                        'prixHT' => $prixHT ,
                                        'prixTTC' => $prixTTC,
                                        'totalPrixHT' => $totalHT,
                                        'totalPrixTTC' =>$totalTTC,
                                        'tauRemise' =>$tauxRemise,
                                        'montantRemise'=>$montantRemise,
                                        'statut'=>'new_temp'));

        return redirect('commande/ajouter');
    }

    public function AjouterLigneCommandeModifier($id, Request $request)
    {
        $idProduit=Produits::where('reference','=',$request->input('reference'))->first()->id;
        $idCommande=$id;
        $quantiteCmd=$request->input('quantite-cmd');
        $qunatiteLvr=0;
        $prixHT=$request->input('prix-u-ht');
        $prixTTC=$request->input('prix-u-ttc');
        $totalHT=$quantiteCmd*$prixHT;
        $totalTTC=$request->input('prix-t-ttc');
        $tauxRemise=$request->input('taux-remise');
        $montantRemise=$request->input('montant-t-remise');

        LigneCommande::create(array('idProduit' => $idProduit ,
            'idCommande' => $idCommande,
            'quantiteCmd' => $quantiteCmd ,
            'quantiteLivree' => $qunatiteLvr ,
            'prixHT' => $prixHT ,
            'prixTTC' => $prixTTC,
            'totalPrixHT' => $totalHT,
            'totalPrixTTC' =>$totalTTC,
            'tauRemise' =>$tauxRemise,
            'montantRemise'=>$montantRemise,
            'statut'=>'new_temp'));

        return redirect('commande/modifier/'.$id);
    }


    public function getmodifier($id)
    {
        $tva=0;
        $ttc=0;
        $ht=0;
        $commande=Commande::where('id','=',$id)->first();
        $clients=Client::all();
        $lignes=DB::table('lignecommande')->where('idCommande', '=', $id)->where('statut','not like','new_temp_s')->where('statut','not like', 'old_temp_s')->get();

        foreach($lignes as $ligne)
        {
            $idTVA= DB::table('produit')->where('id','=', $ligne->idProduit)->first()->tauxTVA;
            $tauxTVA=DB::table('tva')->where('id','=',$idTVA)->first()->taux*0.01;
            $tva=$tva+$ligne->totalPrixHT*$tauxTVA;
            $ttc=$ttc+$ligne->totalPrixTTC;
            $ht=$ht+$ligne->totalPrixHT;
        }

        return view('pages.ModifierCommande' ,compact('commande', 'clients','lignes', 'tva' , 'ttc', 'ht'));


    }

    public function postModifier($id, Request $request)
    {
        $validation =Validator::make($request->all(), ['client' => 'required', 'dateAjout'  => 'required', 'statut'  => 'required']);

        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $client=$request->input('client');
        $date_creation=$request->input('dateAjout');
        $statut=$request->input('statut');
        $total_HT=$request->input('tatal-ht');
        $total_TTC=$request->input('total-ttc');
        $commande=Commande::where('id', '=', $id);
        $commande->update(array(
            'DateCreation' => $date_creation,
            'TotalPrixHT'=> $total_HT,
            'TotalPrixTTC'=> $total_TTC,
            'idClient'=> $client,
            'statut'=>$statut
        ));

        LigneCommande::where('idCommande','=',$id)->where('statut','=','new_temp_s')->delete();
        LigneCommande::where('idCommande','=',$id)->where('statut','=','old_temp_s')->delete();
        LigneCommande::where('idCommande','=',$id)->update(array('statut'=>'valider'));

        return redirect('commande')->with('messageModification', 'Commande Modifiée');
    }

    public function insertion($id, Request $request)
    {
        $validation =Validator::make($request->all(), ['client' => 'required', 'dateAjout'  => 'required', 'statut'  => 'required']);


        if($validation->fails())
        {
            return back()->withInput()->withErrors($validation);
        }

        $client=$request->input('client');
        $date_creation=$request->input('dateAjout');
        $statut=$request->input('statut');
        $total_HT=$request->input('total-ht');
        $total_TTC=$request->input('total-ttc');
        $commande=Commande::where('id', '=', $id);
        $commande->update(array(
            'DateCreation' => $date_creation,
            'TotalPrixHT'=> $total_HT,
            'TotalPrixTTC'=> $total_TTC,
            'idClient'=> $client,
            'statut'=>$statut
        ));
        LigneCommande::where('idCommande','=',$id)->update(array('statut'=>'valider'));

        return redirect('commande')->with('message', 'Commande Ajoutée Avec Succès');
    }

    public function voirFactureCommande(){
        return view('pages.visualiserCommande');
    }


    public function annulerCommande($id)
    {
        LigneCommande::where('idCommande','=',$id)->where('statut','=','new_temp')->delete();
        LigneCommande::where('idCommande','=',$id)->where('statut','=','new_temp_s')->delete();
        LigneCommande::where('idCommande','=',$id)->where('statut','=','old_temp_s')->update(array('statut'=>'valider'));

        return redirect('commande');
    }


    public function supprimerCommande($id)
    {
        Commande::where('id', '=', $id)->update(array('statut'=>'Annuler', 'idLivraison'=>NULL));

        return redirect('commande')->with("messageSuppression", "Commande Supprimée");
    }


    public function supprimerProduitModifier($id)
    {

        $ligne=LigneCommande::where('id','=',$id)->first();
        if($ligne->statut=='new_temp')
        {
            $ligne->update(array('statut' => 'new_temp_s'));
        }
        else
        {
            $ligne->update(array('statut' => 'old_temp_s'));
        }

        return redirect('commande/modifier/'.$ligne->idCommande);
    }

    public function autocomplete(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('produit')
            ->where('reference', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->first_name.' '.$query->last_name ];
        }
        return Response::json($results);
    }




    public function VisualiserCommande($id)
    {
        $tva=0;
        $commande=Commande::where('id','=',$id)->first();

        $clients=Client::all();
        $lignes=DB::table('lignecommande')->where('idCommande', '=', $id)->get();

        foreach($lignes as $ligne)
        {
            $idTVA= DB::table('produit')->where('id','=', $ligne->idProduit)->first()->tauxTVA;
            $tauxTVA=DB::table('tva')->where('id','=',$idTVA)->first()->taux*0.01;
            $tva=$tva+$ligne->totalPrixHT*$tauxTVA;
        }

        return view('pages.visualiserCommande',compact('commande', 'clients','lignes', 'tva'));
    }

    public function pdf()
    {

    }

}
