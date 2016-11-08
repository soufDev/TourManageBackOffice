<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Input;
use App\Produits;
use App\TVA;
use App\Prix;




// login
//Route::post('auth', 'LoginController@checkAuth');
//Route::resource('/','LoginController');

/*
Route::get('/','HomeController@index');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
/*Route::get('/', function (){
        return view('welcome');
} );*/
Route::group(['middleware' => 'auth'], function() {

        // Acceil
        Route::get('/accueil', function (){
                return view('pages.home');
        });
        //PDF
        Route::get('/pdf', 'GestionCommandeController@pdf');

        Route::get('getdata', function()
        {
                $term =Input::get('term');

                $return_array = array();

                $data = DB::table('produit')->distinct()->select('reference')->where('reference', 'LIKE', $term.'%')->groupBy('reference')->take(10)->get();
                foreach ($data as $v) {
                        $return_array[] = array('value' => $v->reference);
                }
                return Response::json($return_array);
        });


        Route::get('autocomplete', function()
        {
                return View::make('autocomplete');
        });


    
        Route::get('client','ListeClientController@index');

        Route::get('client/modifier/{id}', 'ListeClientController@getmodifierClient');

        Route::PATCH('client/modifier/{id}', 'ListeClientController@postmodifierClient');

        Route::get('client/ajouter' , 'ListeClientController@getajouterClient');

        Route::post('client/ajouter' , 'ListeClientController@postajouterClient');

        Route::post('client/{id}'  , 'ListeClientController@postsupprimerClient');




// vehicule
        Route::get('vehicule' , 'VehiculeController@index');

        Route::get('vehicule/ajouter' , 'VehiculeController@AjouterVehicule');

        Route::post('vehicule/ajouter','VehiculeController@insererVehicule');

        Route::get('vehicule/modifier/{id}' , 'VehiculeController@ModifierVehicule');

        Route::PATCH('vehicule/modifier/{id}', 'VehiculeController@SauvegarderModification');

        Route::post('vehicule/{id}', 'VehiculeController@SupprimerVehicule');




// secteur
        Route::get('secteur', 'SecteurController@index');

        Route::post('secteur/ajouter', 'SecteurController@insererSecteur');

        Route::post('secteur/{id}','SecteurController@supprimerSecteur');

        Route::get('secteur/ajouter', 'SecteurController@ajouterSecteur');

        Route::get('secteur/modifier/{id}' , 'SecteurController@ModifierSecteur');

        Route::PATCH('secteur/modifier/{id}', 'SecteurController@SauvegarderModification');


// produit

        Route::get('/produit','GestionProduitController@index');
        Route::get('/produit/create','GestionProduitController@create');
        Route::post('/produit', 'GestionProduitController@store');
        Route::get('/prix/create/{id}','PrixController@create');
        Route::post('/prix','PrixController@store');



//commande
        Route::get('commande','GestionCommandeController@index');

        Route::get('commande/modifier/{id}', 'GestionCommandeController@getmodifier');

        Route::patch('commande/modifier/{id}' ,'GestionCommandeController@postModifier');

        Route::post('commande/modifier/{id}','GestionCommandeController@AjouterLigneCommandeModifier');

        Route::post('commande/{id}','GestionCommandeController@supprimerCommande');

        Route::post('commande/ajouter/{id}', 'GestionCommandeController@AjouterLigneCommande');

        Route::patch('commande/ajouter/{id}', 'GestionCommandeController@insertion');

        Route::get('commande/ajouter','GestionCommandeController@Ajouter');

        Route::get('visualiserCommande','GestionCommandeController@voirFactureCommande');

        Route::get('commande/annuler/{id}' , 'GestionCommandeController@annulerCommande');

        Route::post('commande/modifier/supprimer/{id}','GestionCommandeController@supprimerProduitModifier');

        Route::post('commande/ajouter/supprimer/{id}','GestionCommandeController@supprimerProduitModifier');

        Route::get('commande/visualiser/{id}', 'GestionCommandeController@VisualiserCommande');

        Route::get('search/autocomplete', 'GestionCommandeController@autocomplete');


        Route::get('produitInfo',
            function(){
                    $ref = Input::get('ID');
                    $match=$ref;

                    $produit=Produits::where('reference','=',$match)->get();

                    return response()->json($produit);});

        Route::get('tvaInfo',
            function(){
                    $ref = Input::get('ID');
                    $match=$ref;

                    $tva=TVA::where('id','=',$match)->get();

                    return response()->json($tva);});


        Route::get('prixInfo',
            function(){
                    $ref = Input::get('ID');
                    $match=$ref;

                    $prix=Prix::where('idProduit','=',$match)->get();

                    return response()->json($prix);});

        Route::post('genererLivraison', 'GestionCommandeController@genLivraison');
        //Route::post('/genererLivraison', function() {
                //$idcommandes = Input::get('commandes');
                //return $idcommandes;
                //$idTransporteur = 0;//Input::get('transporteur');
                //return $idTransporteur;
                //$dateLivraison = Input::get('dateLiv');
                //DD($idcommandes);
        //});


        Route::get('commande/autocomplite' , 'GestionCommandeController@autocomplite');


// employés

        Route::resource('/employes','GestionAgentController');
        Route::get('/listeAgent','GestionAgentController@getEmployes');


// compte
        Route::get('/listeCompte','GestionCompteController@getComptes');
        Route::resource('/comptes','GestionCompteController');


// livraison
        Route::get('listeLivraison','GestionLivraisonController@getLivraisons');
        Route::get('livraisonsToEtapesTournes/{idCommande}', 'GestionLivraisonController@livaisonsToEtapesTournes');
        Route::resource('/livraisons', 'GestionLivraisonController');

// preparer Livraison
        Route::get('ligneCommandeLivraison/{idCommande}', 'preparerLivraisonController@getLigneCommandeLivraison');
        Route::resource('preparerLivraison', 'preparerLivraisonController');

// realiser une Livraison
        Route::get('realiserLivraisonLigneCommande/{idCommande}', 'realiserLivraisonController@getRealiserLivraisonLigneCommande');
        Route::resource('realiserLivraison', 'realiserLivraisonController');

// tournee

        Route::get('listeTournees', 'GenererTournesController@getTournees');
        // generer les tounrées
        Route::resource('tournes', 'GenererTournesController');

        // Planifier les tournees
        Route::get('tourneesData', 'PlanifierTourneesController@getPlanificationTournesData');
        Route::post('tourneesDataTransporteur', 'PlanifierTourneesController@getDataWithIdTransporteur');
        Route::post('tourneesDataDate', 'PlanifierTourneesController@getDataWithDate');
        Route::post('donneesTournees', 'PlanifierTourneesController@getData');

        Route::resource('planifierTournees', 'PlanifierTourneesController');

        //Suivi Tournées
        Route::get('visualiserTournee','GestionTourneeController@SelectionTournee');

        Route::get('beginData', 'suiviTourneeController@getData');
        Route::post('tourneesTranspoteur', 'suiviTourneeController@getTourneesTransporteur');
        Route::post('tourneesDate', 'suiviTourneeController@getTourneesDate');
        Route::post('tourneesData', 'suiviTourneeController@getTournee');
        Route::resource('suiviTournees', 'suiviTourneeController');

        //Route::get('suiviDesTournee', 'GestionTourneeController@suiviDesTournee');

        Route::get('suiviTournee', 'GestionTourneeController@suiviTournee');

        //Route::get('planifierTournee','GestionTourneeController@planificationTournee');




});


// Authentication Routes...
Route::get('/', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');
//Route::get('/', 'HomeController@index');
