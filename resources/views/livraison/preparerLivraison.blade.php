@extends("app")

@section("content")
    <h1 class="header-page">Preparer une Livraion </h1>
    {!! Form::open(['url' => '#']) !!}
    <div ng-app="myApp">
        <div ng-controller="preparerLivraisonController">
            <div role="form" class="form-horizontal col-lg-12 col-xs-12">
                <div role="form" class="form-horizontal col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-0" name="preparerLivraisonForm">
                    <div class="form-group col-lg-10 col-md-10 col-xs-12 col-sm-10">
                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="Edit-numLivraison">N° Livraison</label>
                            <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.id" ng-readonly="true">
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="Edit-numCommande">N° Commande</label>
                            <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.idCommande" ng-readonly="true">
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="nomClient">Client</label>
                            <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" value="@{{ livraisons.clientNom }} @{{ livraisons.clientPrenom }}" ng-readonly="true">
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="date-liv-prev">Date de Livraison Prév</label>
                            <input type="date" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.DateLivraisonPrev" ng-readonly="true">
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="Edit-transporteur">Transporteur</label>
                            <select ng-model="livraisons.transporteur" class="form-control col-xs-12 col-lg-4 col-md-4" ng-required="true">
                                <option value="@{{ transporteur.id }}" ng-repeat="transporteur in transporteurs" ng-selected="transporteur.id == livraisons.idTransporteur">
                                    @{{ transporteur.nom }}  @{{ transporteur.prenom }}
                                </option>
                            </select>
                        </div>

                        <div class="col-md-5 col-xs-12 col-lg-5">
                            <label for="status">Status</label>
                            <select ng-model="livraisons.statut" class="form-control col-xs-12 col-lg-4 col-md-4" ng-required="true">
                                <option value="@{{ statut.id }}" ng-repeat="statut in statuts" ng-selected="statut.value == livraisons.statut">@{{ statut.value }}</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="table-responsive col-lg-12">
                <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                    <thead id="headings">
                    <tr>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Désignation</th>
                        <th>Quantité Cmd</th>
                        <th>Quantité Déjà livée</th>
                        <th>Quantité à Livrer Prevu</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="ligne_commande in lignes_commandes">
                        <td>@{{ ligne_commande.id }}</td>
                        <td id="reference">@{{ ligne_commande.reference }}</td>
                        <td id="designation">@{{ ligne_commande.designation }}</td>
                        <td id="quantite-cmd">@{{ ligne_commande.quantiteCmd }}</td>
                        <td id="quantite-deja-liv">@{{ ligne_commande.quantiteLivree }}</td>
                        <td id="quantite-prev-a-liv">@{{ ligne_commande.quantite_livree_reel }}</td>
                        <td id="" style="text-align: center">
                            <a href="#myModal" class="modifier" id="openBtn" data-toggle="modal" ng-click="edit(ligne_commande.id)">
                                <i class="glyphicon glyphicon-edit" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td class="a-right a-right " id="supprimer" style="text-align: center">
                            <a href="#" class="supprimer" id="openBtn" data-toggle="modal" ng-click="delete(ligne_commande.id)">
                                <i class="glyphicon glyphicon-remove" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <div class="form-group col-lg-offset-9 col-md-offset-7 col-sm-offset-7 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a href="{{ url('/livraisons') }}" class="btn btn-dark btn-lg col-sm-4 col-md-4 col-lg-4 col-xs-12">Annuler</a>
                <a ng-click="valider()" class="btn btn-success btn-lg col-sm-4 col-md-4 col-lg-4 col-xs-12">valider</a>
            </div>



            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">x</button>
                            <h3 class="modal-title">Modifier Quantité a Livrée</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="container" role="form">
                                <div class="col-lg-10 col-md-10 col-xs-10">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">
                                        <div class="form-group">
                                            <label for="reference">Reférence</label>
                                            <input type="text" class="form-control" id="reference" name="reference" ng-model="ligneCommande.reference">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantite-cmd">Quantité Cmd</label>
                                            <input type="text" class="form-control" id="quantite-cmd" name="quantite-cmd" ng-model="ligneCommande.QuantiteCmd">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantite-liv">Quantité Livrée</label>
                                            <input type="text" class="form-control" id="quantite-liv" name="quantite-liv" ng-model="ligneCommande.quantiteLivree">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantite-a-liv">Quantité à Livrer</label>
                                            <input type="text" class="form-control" id="quantite-a-liv" name="quantite-a-liv" ng-model="ligneCommande.quantite_livree_reel">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Annuler</button>
                                <button  type="button" class="btn btn-lg btn-primary" ng-click="update(ligneCommande)">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}

    @endsection