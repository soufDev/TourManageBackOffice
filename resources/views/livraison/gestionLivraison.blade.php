@extends('app')


@section('content')

    <h1 class="header-page">Gestion Livraison</h1>
    <div ng-app="myApp">
        <div ng-controller="livraisonController">

            <div role="form" class="form-horizontal col-lg-12 col-xs-12 col-xs-offset-0">

                {!! Form::open(['url' => '#']) !!}
                <div role="form" class="form-horizontal col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                    <div class="form-group col-lg-10 col-md-10 col-xs-12 col-sm-10">
                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="Edit-numCommande">N° Commande</label>
                            <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" id="Edit-transporteur" placeholder="N° Commande">
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="Edit-transporteur">Transporteur</label>
                            <select name="transporteur" id="Edit-numCommande" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="transporteur.nom" placeholder="Transporteur">
                                <option value="">Choisir Un Agent</option>
                                <option ng-repeat="transporteur in transporteurs" value="@{{ transporteur.id }}">@{{ transporteur.nom }} @{{  transporteur.prenom  }}</option>
                            </select>
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="Edit-numLivraison">Livraison</label>
                            <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" placeholder="N° Livraison" ng-model="livraison.numero" id="Edit-numLivraison">
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="status">Status</label>
                            <select name="statut" ng-model="livraison.statut" id="Edit-statut" class="form-control col-xs-12 col-lg-4 col-md-4">
                                <option value="">Choisir Un Statut</option>
                                <option value="1">En Cours</option>
                                <option value="2">Partielement Livrée</option>
                                <option value="3">Livrée</option>
                                <option value="4">Non Livrée</option>
                                <option value="5">Annulée</option>
                            </select>
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="nomClient">Client</label>
                            <select name="client" id="nomclient" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraison.client">
                                <option value="">Selectionner Un Client</option>
                                <option value="@{{ client.id }}" ng-repeat="client in clients">@{{ client.Prenom }} @{{ client.Nom  }}</option>
                            </select>
                        </div>
                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="date-liv-prev">Date de Livraison Prév</label>
                            <input type="date" class="form-control col-xs-12 col-lg-4 col-md-4" id="date-liv-prev">
                        </div>
                        <div class="col-md-5 col-xs-12 col-lg-5"></div>
                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="date-liv-reel">Date de Livraison Réel</label>
                            <input type="date" class="form-control col-xs-12 col-lg-4 col-md-4" id="date-liv-reel">
                        </div>

                    </div>
                </div>

                {!! Form::close() !!}
                <div class="table-responsive">
                    <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                        <thead >
                        <tr class="headings">
                            <th>N° Livraison</th>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Transporteur</th>
                            <th>Date Livraison Prévu</th>
                            <th>Date Livraison Réelle</th>
                            <th>Statut</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                            <th>Details</th>
                            <th>Réaliser une Livraison</th>
                            <th>Générer un BL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="livraison in livraison_infos">
                            <td id="num-livraison">@{{ livraison.id }}</td>
                            <td id="num-commande">@{{ livraison.idcommande }}</td>
                            <td id="client">@{{ livraison.nomClient }} @{{ livraison.prenomClient }}</td>
                            <td id="agent">@{{ livraison.transporteurNom }} @{{ livraison.transporteurPrenom }}</td>
                            <td id="date-liv-prev">@{{ livraison.DateLivraisonPrev }}</td>
                            <td id="date-liv-reel">@{{ livraison.DateLivraisonReel }}</td>
                            <td id="statut">@{{ livraison.statut }}</td>
                            <td id="" style="text-align: center">
                                <a href="" class="modifier" ng-click="goToPreparerLivraison( livraison.idcommande ) ">
                                    <i class="glyphicon glyphicon-edit" style="color:#26B99A ;font-size: 1.5em; align-content: center" ></i>
                                </a>
                            </td>
                            <td class="a-right a-right " id="supprimer" style="text-align: center">
                                <a href="" >
                                    <i class="glyphicon glyphicon-remove" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>
                                </a>
                            </td>
                            <td class=" last" id="" style="text-align: center">
                                <a href="#detail_myModal" class="show_details" id="openBtn"  data-toggle="modal" ng-click="edit( livraison.idcommande )">
                                    <i class="glyphicon glyphicon-info-sign" id="datail"
                                       style="font-size: 1.5em; color: #1A82C3" >
                                    </i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="" ng-click="goToRealiserLivraison( livraison.idcommande )">
                                    <i class="glyphicon glyphicon-new-window" style="color: #1ABB9C; font-size: 1.5em"  ></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="#" id="">
                                    <span class="glyphicon glyphicon-share" style="color: #00aeef; font-size: 1.5em"></span>
                                </a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>



            <!-- Detail Modal -->
            <div class="modal fade" id="detail_myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title">Details Livraison</h3>
                        </div>
                        <div class="modal-body">

                            <div  role="form" class="form-horizontal col-lg-offset-2 col-md-offset-1">

                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="Edit-numCommande" class="control-label">N° Commande</label>
                                    <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" placeholder="N° Commande" id="numCommande" ng-model="livraisons.idCommande" ng-disabled="true" >
                                 </div>

                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="Edit-transporteur" class="control-label">Transporteur</label>
                                    <select name="transporteur" id="transporteur" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.idTransporteur" ng-disabled="true" >
                                        <option ng-repeat="transporteur in transporteurs" value="@{{ transporteur.id }}" ng-selected="@{{ transporteur.id == livraisons.idTransporteur }}">@{{ transporteur.nom }} @{{ transporteur.prenom }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="Edit-numLivraison" class="control-label">N° Livraison</label>
                                    <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" id="numLivraison" name="numLivraison" placeholder="N° Livraison" ng-model="livraisons.id" ng-disabled="true">
                                </div>

                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="status" class="control-label">Statuts</label>
                                    <select name="statut" id="statut" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.statut" ng-disabled="true">
                                        <option value="">Choisir Le Statut</option>
                                        <option value="1">EN COURS</option>
                                        <option value="2">LIVREES</option>
                                        <option value="3">PARTIELLEMENT LIVREE</option>
                                        <option value="4">ANNULEE</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="nomClient" class="control-label">Nom Client</label>
                                    <select name="client" id="client" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.idClient" ng-disabled="true" >
                                        <option value="@{{ client.id }}" ng-repeat="client in clients" ng-selected="@{{ client.id == livraisons.idClient }}">@{{ client.Nom }} @{{ client.Prenom }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="date-liv-prev" class="control-label">Date de Livraison Prév</label>
                                    <input type="date" name="date-liv-prev" id="date-liv-prev" ng-model="livraisons.DateLivraisonPrev" class="form-control col-xs-12 col-lg-4 col-md-4" ng-disabled="true">
                                </div>
                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="date-liv-reel" class="control-label">Date de Livraison Réel</label>
                                    <input type="date" name="date-liv-reel" id="date-liv-reel" ng-model="livraisons.DateLivraisonReel" class="form-control col-xs-12 col-lg-4 col-md-4" ng-disabled="true">
                                </div>
                                <div class="form-group col-md-5 col-xs-12 col-lg-5">
                                    <label for="motif-livraison" class="control-label">Motif Livraison</label>
                                    <select name="motif-liv" id="motiv-liv" ng-model="livraisons.motif" class="form-control col-xs-12 col-lg-4 col-md-4" ng-disabled="true">
                                        <option value="">Choisir Le Motif</option>
                                        <option value="1">Payement</option>
                                        <option value="2">Livraison Commande</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                                        <thead id="headings">
                                        <tr>
                                            <th>Référence</th>
                                            <th>Désignation</th>
                                            <th>Quantité Cmd</th>
                                            <th>Quantité Déjà livée</th>
                                            <th>Quantité à Livrer Prevu</th>
                                            <th>Quantité livrée Réelle</th>
                                            <th>Commantaire</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="ligne_commande in lignes_commandes">
                                            <td id="reference">@{{ ligne_commande.reference }}</td>
                                            <td id="designation">@{{ ligne_commande.designation }}</td>
                                            <td id="quantite-cmd">@{{ ligne_commande.quantiteCmd }}</td>
                                            <td id="quantite-deja-liv">@{{ ligne_commande.quantiteLivree }}</td>
                                            <td id="quantite-prev-a-liv">@{{ ligne_commande.quantiteCmd * ligne_commande.quantiteLivree }}</td>
                                            <td id="quantite-reel-liv">@{{ ligne_commande.quantite_livree_reel }}</td>
                                            <td id="commentaire">commentaire</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <a href="{{ url('/commande/ajouter') }}" class="btn btn-primary btn-lg">Ajouter Commande</a>
                                <a class="btn btn-success btn-lg" data-dismiss="modal">valider</a>
                            </div>
                        </div>
                    </div>


                </div>



            </div>

            <!-- Modal Pour Affecter Un Tranporteur -->
            <div class="modal fade" id="affecterAgentModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">x</button>
                            <h3 class="modal-title">Affectez Un Agent</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="container" role="form">
                                <div class="col-lg-10 col-md-10 col-xs-10">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">

                                        <div class="form-group">
                                            <label for="reference">Reférence</label>
                                            <select class="form-control" ng-model="livraisons.tranporteur">
                                                <option value="" ng-selected="true">Choisir Un Transporteur</option>
                                                <option value="@{{ transporteur.idTranporteur }}" ng-repeat="transporteur in transporteurs">
                                                    @{{ transporteur.nom }}
                                                    @{{ transporteur.prenom }}
                                                </option>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Annuler</button>
                                <button  type="button" class="btn btn-lg btn-primary" ng-click="update(ligneCommande)">Affecter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}
    @endsection