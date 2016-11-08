@extends('app')

@section('content')
    <div ng-app="myApp">
        <div ng-controller="realiserLivraisonController">
            <h1 class="header-page">Réaliser une Livraison</h1>
            {!! Form::open(['url'=>'#']) !!}
            <div class="form-group col-lg-7 col-lg-offset-3">
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="Edit-numLivraison">Livraison</label>
                    <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.id" ng-readonly="true">
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="Edit-numCommande">N° Commande</label>
                    <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4"
                           ng-model ="livraisons.idCommande" ng-readonly="true">
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="nomClient">Nom Client</label>
                    <input type="text" class="form-control col-xs-12 col-lg-4 col-md-4" ng-readonly="true"
                           value="@{{ livraisons.clientNom }} @{{ livraisons.clientPrenom }}">
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="date-liv-prev">Date de Livraison Prév</label>
                    <input type="date" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.DateLivraisonPrev">
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="Edit-transporteur">Transporteur</label>
                    <select name="" id="" ng-model="livraisons.idTransporteur" class="form-control col-xs-12 col-lg-4 col-md-4">
                        <option ng-repeat="transporteur in transporteurs" value="@{{ transporteur.id }}"
                                ng-selected="@{{ transporteur.id == livraisons.idTransporteur }}">
                            @{{ transporteur.nom }} @{{ transporteur.prenom }}
                        </option>
                    </select>
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="date-liv-reel">Date de Livraison Réel</label>
                    <input type="date" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.DateLivraisonReel">
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="status">Status</label>
                    <select name="" id="" class="form-control col-xs-12 col-lg-4 col-md-4" ng-model="livraisons.statut">
                        <option se>Choisir Le Statut</option>
                        <option ng-repeat="statut in statuts" value="statut.id"
                                ng-selected="@{{ statut.value == livraisons.statut }}">
                            @{{ statut.value }}
                        </option>
                    </select>
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="motif-livraison">Motif Non Livraison</label>
                    <select class="form-control col-xs-12 col-lg-4 col-md-4"
                            ng-model="livraisons.motifNomLivraison">
                        <option value="@{{ motifNomLivraison.id }}" ng-repeat="motifNomLivraison in motifNomLivraisons"
                                ng-selected="@{{ motifNomLivraison.value == livraisons.motifNomLivraison }}">
                            @{{ motifNomLivraison.value }}
                        </option>
                    </select>
                 </div>

            </div>
            <div class="table-responsive col-lg-12">
                <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                    <thead id="headings">
                    <tr>
                        <th>Référence</th>
                        <th>Désignation</th>
                        <th>Quantité à Livrer Prev</th>
                        <th>Quantité livrée Réelle</th>
                        <th>Commentaire</th>
                        <th>Modifier</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="ligne_commande in lignes_commandes">
                        <td id="reference">@{{ ligne_commande.reference }}</td>
                        <td id="designation">@{{ ligne_commande.designation }}</td>
                        <td id="quantite-prev-a-liv">@{{ ligne_commande.quantiteCmd }}</td>
                        <td id="quantite-reel-liv">@{{ ligne_commande.quantiteLivree }}</td>
                        <td id="commentaire">@{{ ligne_commande.commentaire }}</td>
                        <td>
                            <a href="#myModal" class="modifier" id="openBtn" data-toggle="modal" ng-click="edit( ligne_commande.id )">
                            <span class="glyphicon glyphicon-edit" style="color:#26B99A ;font-size: 1.5em; align-content:center">
                            </span>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group clearfix"></div>
            <div class="form-group col-lg-offset-9 col-md-offset-7 col-sm-offset-7 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a href="#" class="btn btn-dark btn-lg col-sm-4 col-md-4 col-lg-4 col-xs-12">Annuler</a>
                <button type="submit" class="btn btn-success btn-lg col-sm-4 col-md-4 col-lg-4 col-xs-12">valider</button>
            </div>
            {!! Form::close() !!}

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">x</button>
                            <h3 class="modal-title">Quantité Livrée</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="container" role="form">
                                <div class="col-lg-10 col-xs-10 col-md-10">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">
                                        <div class="form-group">
                                            <label for="reference">Reférence</label>
                                            <input type="text" class="form-control" ng-model="ligneCommande.reference">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantite-prev-a-liv">Quantité Prevu à Livrer</label>
                                            <input type="text" class="form-control" ng-model="ligneCommande.quantiteCmd">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantite-liv">Quantité Livrée</label>
                                            <input type="text" class="form-control" ng-model="ligneCommande.quantiteLivree">
                                        </div>


                                        <div class="form-group">
                                            <label for="commentaire">Commentaire</label>
                                            <textarea class="form-control" rows="3" ng-model="ligneCommande.commentaire">
                                            </textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group pull-right">
                                <a class="btn btn-lg btn-default" data-dismiss="modal">Annuler</a>
                                <button type="button" class="btn btn-lg btn-primary" ng-click="update( ligneCommande )">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}
    @endsection