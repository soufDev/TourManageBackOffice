<?php

namespace App\Http\Controllers;

use App\Client;
use App\CommandeClient;
use App\Etapetournee;
use App\Livraison;
use App\Tournees;
use App\TraceStockTournee;
use App\Vehicule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class GenererTournesController extends Controller {

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('tournee.tourner_a_generer');
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
    public function store(Request $request) {

        $idTransporteur = Input::get('transporteur');
        $dateDebut = Input::get('dateDebut');
        $idVehicule = Input::get('vehicule');

        // recuperer l'id de livraison qui correspond a note Transporteur et a la date de debut de tournée
        $livraison = $this->getLivraisons($idTransporteur, $dateDebut);

        // faire un teste et voir si on a recuperer existe

        if(  $livraison != null ){
            
            // recuperes les ids des Commande qui compose la livraison
            $commandes = $this->getCommande($livraison[0]->id);

            // generer les etapes tounrées
            for($i=0 ; $i< count($commandes) ; $i++) {
                // recuperer le client qui correspond a la livraison
                $client = Client::find($commandes[$i]->idClient);
                // remplir les champ de etape tournées
                $etape_tournee = [
                    'idClient' => $commandes[$i]->idClient,
                    'idLivraison' => $commandes[$i]->idLivraison,
                    'adresse' => $client->adresse,
                    'idCommande' => $commandes[$i]->id,
                    'statut' => $livraison[0]->statut,
                    'commentaire' => 'Rien pour l\'instant',
                    'motifvisit' => 'LIVRAISON CLIENT',
                    'numEtape' => $i+1
                ];
                // inserer les données recuperé
                Etapetournee::create($etape_tournee);
            }

            $input = [
                'DateDebut' => $dateDebut,
                'idTransporteur' => $idTransporteur,
                'idvehicule' => $idVehicule
            ];
            // creer la tournée
            Tournees::create($input);

            // update Livraison
            Livraison::find($livraison[0]->id)->update(['idTransporteur' => $idTransporteur]);
            //recuperer l'id de la derniere tournee inseré

            // mettre a jour l'id de la tounée dans la table livraison
            $this->setIdTournee($livraison[0]->id);

            //return  $this->getLastIdTournee( $livraison[0]->id) ;/*
            //affecter les ligne
            $stockTournee = $this->getStock( $this->getLastIdTournee() );


            for($i=0 ; $i<count($stockTournee) ; $i++) {
                /*$traceTournee = new TraceStockTournee;
                $traceTournee->idProduit = $stockTournee[$i]->idProduit;
                $traceTournee->idTournee = $this->getLastIdTournee();
                $traceTournee->stockinitialestime = $stockTournee[$i]->quantiteCmd;
                $traceTournee->save();*/
                $input = [
                    'idProduit' => $stockTournee[$i]->idProduit,
                    'idTournee' => $this->getLastIdTournee(),
                    'stockinitialestime' => $stockTournee[$i]->quantiteCmd,
                    'stockinitialReel' => $stockTournee[$i]->quantiteCmd,
                    'stockFinalEstime' => $stockTournee[$i]->quantiteCmd,
                    'stockFinalReel' => $stockTournee[$i]->quantiteCmd,
                    'stockEncours' => $stockTournee[$i]->quantiteCmd,
                ];
                TraceStockTournee::create($input);

            }

        }

        $data = ['success'=>true, 'msg'=>'Tournée Générée Avec Succés'];
        return Response::json($data, 200);
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
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


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

    public function getLivraisons($idTransporteur, $dateDebut){
        return  DB::table('livraison')
            ->where('idTransporteur', '=', $idTransporteur)
            ->where('DateLivraisonPrev', '<=', $dateDebut)
            ->where('statut', '=', 'EN COURS')
            ->get();
    }

    public function getLastIdTournee() {
        return Tournees::orderBy('id', 'DESC')->first()->id;
    }

    public function setIdTournee($idlivraison){
        $livraison_byID = Livraison::find($idlivraison);
        $livraison_byID->idTournee = $this->getLastIdTournee();
        return $livraison_byID->save();
    }

    public function getCommande($idLivraison){
        return CommandeClient::
            where('idLivraison', '=', $idLivraison)
            ->get();
    }

    public function getStock($idTournee) {
        return DB::table('livraison')
            //->join('tournee', 'tournee.id', '=', 'tracestocktournee.idTournee')
            //->join('livraison', 'livraison.idTournee', '=', 'tournee.id')
            ->join('commandeclient', 'commandeclient.idLivraison', '=', 'livraison.id')
            ->join('lignecommande', 'lignecommande.idCommande', '=', 'commandeclient.id')
            ->join('produit', 'produit.id', '=', 'lignecommande.idProduit')
            ->where('livraison.idTournee', '=', $idTournee)
            ->select('livraison.id as idLivraison', 'commandeclient.id as idCommande', 'produit.id as idProduit',
                'produit.Designation', 'produit.reference', DB::raw('SUM(lignecommande.QuantiteCmd - lignecommande.quantiteLivree) as quantiteCmd') )
            ->groupBy('idProduit')
            ->orderBy('idProduit')
            ->get();
    }

}
