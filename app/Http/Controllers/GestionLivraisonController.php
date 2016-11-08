<?php

namespace App\Http\Controllers;

use App\Client;

use App\Commande;
use App\Etapetournee;
use App\Http\Requests;
use App\LigneCommande;
use App\Livraison;
use Illuminate\Support\Facades\DB;

class GestionLivraisonController extends Controller
{
    //

    // récuperer les donnée globale dont on a besoin
    public function getLivraisons(){
        $livraison_infos = DB::table('livraison')
            ->join('commandeclient', 'livraison.id', '=', 'commandeclient.idLivraison')
            ->join('client', 'commandeclient.idClient', '=', 'client.id')
            ->join('transporteur', 'livraison.idTransporteur' ,'=', 'transporteur.id')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->select('livraison.id as id', 'commandeclient.id as idcommande',
                'client.nom as nomClient', 'client.prenom as prenomClient', 'livraison.idTransporteur as idTansporteur',
                'users.nom as transporteurNom', 'users.prenom as transporteurPrenom', 'livraison.DateLivraisonPrev',
                'livraison.DateLivraisonReel', 'livraison.statut')
            ->get();

        $transporteurs = DB::table('users')
            ->join('transporteur', 'users.id', '=', 'transporteur.idEmployee')
            ->select('users.id', 'transporteur.idEmployee', 'users.nom', 'users.prenom')
            ->get();
        $clients = Client::all();

        return compact('livraison_infos', 'transporteurs', 'clients');
    }

    // fonction qui nous retourne l'element séléctionné
    public function edit($idCommande){
        $livraison_infos = DB::table('livraison')
            ->join('commandeclient', 'livraison.id', '=', 'commandeclient.idLivraison')
            ->join('client', 'commandeclient.idClient', '=', 'client.id')
            ->join('transporteur', 'livraison.idTransporteur' ,'=', 'transporteur.id')
            ->join('users', 'users.id', '=', 'transporteur.idEmployee')
            ->where('commandeclient.id', '=', $idCommande)
            ->select('livraison.id as id', 'commandeclient.id as idCommande',
                'client.id as idClient', 'transporteur.idEmployee as idTransporteur',
                'users.nom as transporteurNom', 'users.prenom as transporteurPrenom', 'livraison.DateLivraisonPrev',
                'livraison.DateLivraisonReel', 'livraison.statut', 'client.nom as clientNom', 'client.prenom as clientPrenom')
            ->get();

        $lignes_commandes = DB::table('commandeclient')
            ->join('lignecommande', 'commandeclient.id', '=', 'lignecommande.idCommande')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('commandeclient.id', '=', $idCommande)
            ->select('produit.reference', 'produit.Designation as designation',
                'lignecommande.QuantiteCmd as quantiteCmd', 'lignecommande.quantiteLivree'
                , 'lignecommande.quantite_livree_reel')
            ->get();

        return compact('livraison_infos', 'lignes_commandes');

    }

    public function livaisonsToEtapesTournes($idCommande){
        $commande = Commande::find($idCommande);
        $client = Client::find($commande->idClient);
        $livraison = Livraison::find($commande->idLivraison);

        $resulat = false;
        // verifier si la livraison existe deja
        $etape_tournee = DB::table('etapetournee')
            ->where('etapetournee.idLivraison', '=', $commande->idLivraison)
            ->get();
        if( sizeof($etape_tournee) == 0 ){
            $etape_tournee = [
                'idClient' => $commande->idClient,
                'idLivraison' => $commande->idLivraison,
                'adresse' => $client->adresse,
                'idCommande' => $idCommande,
                'statut' => $livraison->statut,
                'commentaire' => 'Rien pour l\'instant',
                'motifvisit' => 'Rien pour l\'instant'
            ];
            Etapetournee::create( $etape_tournee );
            $resulat = true;
        }
        return compact('resulat');
    }

    public function index(){
        return view('livraison.gestionLivraison');
    }

    public function prepareLivraison(){
        return view('livraison.preparerLivraison');
    }

    public function realiserLivraison(){
        return view('livraison.realiserLivraison');
    }


}
