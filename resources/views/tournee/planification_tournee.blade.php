@extends('app')

@section('content')
    <div ng-app="myApp">
        <div ng-controller="planifierTourneeController">
            <h1 class="header-page">Tournée</h1>
            {!! Form::open(['url'=>'#']) !!}
            <div class="form-horizontal col-lg-8 col-md-12 col-sm-12 col-xs-12 col-md-offset-0 col-lg-offset-4">
                <div class="form-group col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <label for="date-tournee">Date</label>
                    <input type="date" class="form-control" id="date-tournee" name="date-tournee" ng-model="tournee.dateTournee" ng-change="getData(tournee)">
                </div>

                <div class="form-group col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <label for="transporteur">Transporteur</label>
                    <select ng-model="tournee.transporteur" class="form-control" ng-required="true" ng-change="getData(tournee)">
                        <option value="" selected>Choisir Transporteur</option>
                        <option value="@{{ transporteur.id }}" ng-repeat="transporteur in transporteurs" >
                            @{{ transporteur.nom }}
                            @{{ transporteur.prenom }}
                        </option>
                    </select>
                </div>
                <br>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="panel-group" id="">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a href="#etapes" data-toggle="collapse" data-parent="">
                                <h3 class="panel-title" style="color: #FFFFFF;">
                                    Etapes
                                </h3>
                            </a>
                        </div>
                        <div class="panel-collapse collapse in" id="etapes">
                            <div class="panel-body table-responsive">
                                <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                                    <thead id="headings">
                                    <tr>
                                        <th>N° Client</th>
                                        <th>Nom Client</th>
                                        <th>Adresse</th>
                                        <th>Motif de visite</th>
                                        <th>N° Etape</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr ng-repeat="etape in etapes">
                                        <td id="num-client">@{{ etape.id }}</td>
                                        <td id="nom-client">@{{ etape.Nom }} @{{ etape.Prenom }}</td>
                                        <td id="adresse">@{{ etape.adresse }}</td>
                                        <td class="motif-liv">@{{ etape.motifvisit }}</td>
                                        <td id="etape">@{{ etape.numEtape }}</td>
                                        <td id="modifier">
                                            <a href="#" class="modifier">
                                                <span class="glyphicon glyphicon-edit" style="color:#26B99A ;font-size: 1.2em; align-content: center"></span>
                                            </a>
                                        </td>
                                        <td id="supprimer">
                                            <a href="#" class="supprimer">
                                                <span class="glyphicon glyphicon-remove" style="color:#ff2918 ;font-size: 1.2em; align-content: center"></span>
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a href="#liste-liv-plan" data-toggle="collapse" data-parent="">
                                <h3 class="panel-title" style="color: #FFFFFF;">
                                    Listes Des Livraison Planifiées
                                </h3>
                            </a>
                        </div>
                        <div class="panel-collapse collapse " id="liste-liv-plan">
                            <div class="panel-body table-responsive">
                                <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                                    <thead id="headings">
                                    <tr>
                                        <th>N° Livraison</th>
                                        <th>N° Commande</th>
                                        <th>Client</th >
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="livraison in livraisons">
                                        <td id="num-livraison">@{{ livraison.idLivraison }}</td>
                                        <td id="num-commande">@{{ livraison.idCommande }}</td>
                                        <td id="nom-client">@{{ livraison.nomClient }} @{{ livraison.prenomClient }}</td>
                                        <td id="details">
                                            <a href="#" class="details">
                                                <span class="glyphicon glyphicon-info-sign" style="color:#1A82C3 ;font-size: 1.2em; align-content: center"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a href="#stock-a-charger" data-toggle="collapse" data-parent="">
                                <h3 class="panel-title" style="color: #FFFFFF;">
                                    Stock à Charger
                                </h3>
                            </a>
                        </div>
                        <div class="panel-collapse collapse " id="stock-a-charger">
                            <div class="panel-body table-responsive">
                                <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                                    <thead id="headings">
                                    <tr>
                                        <th>Réference</th>
                                        <th>Désignation</th>
                                        <th>Quantité à Charger</th >
                                        <th>Modifier</th>
                                        <th>Supprier</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="stock in stockTournees">
                                        <td id="reference">@{{ stock.reference }}</td>
                                        <td id="designation">@{{ stock.Designation }}</td>
                                        <td id="quantite">@{{ stock.stockinitialReel }}</td>
                                        <td id="modifer">
                                            <a href="#editStock" class="modifier" data-toggle="modal" id="openBtn" ng-click="edit(stock.id)">
                                                <span class="glyphicon glyphicon-edit" style="color:#26B99A ;font-size: 1.2em; align-content: center"></span>
                                            </a>
                                        </td>
                                        <td id="supprimer">
                                            <a href="#" class="supprimer">
                                                <span class="glyphicon glyphicon-remove" style="color:#ff2918 ;font-size: 1.2em; align-content: center"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group col-xs-12 col-lg-12 col-lg-offset-2 col-xs-offset-0 col-md-offset-1">
                <button type="button" class="btn btn-lg btn-dark col-lg-2 col-xs-12 col-md-2" >Annuler</button>
                <button type="button" class="btn btn-lg btn-dark col-lg-4 col-xs-12 col-md-6">Enregistrer Sans Publication</button>
                <button type="button" class="btn btn-lg btn-dark col-lg-2 col-xs-12 col-md-2">Publier</button>
            </div>
        {!! Form::close() !!}

        <!-- Modal Pour Affecter Un Vehicule a une Tounrées -->
            <div class="modal fade" id="editStock" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">x</button>
                            <h3 class="modal-title">Modifier Quantité à Charger</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="container" role="form">
                                <div class="col-lg-10 col-md-10 col-xs-10">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">

                                        <div class="form-group">
                                            <label for="reference">Reference</label>
                                            <input type="text" class="form-control" ng-model="stockTournee.reference" ng-readOnly="true">
                                        </div>

                                        <div class="form-group">
                                            <label for="reference">Designation</label>
                                            <input type="text" class="form-control" ng-model="stockTournee.Designation" ng-readonly="true">
                                        </div>

                                        <div class="form-group">
                                            <label for="reference">Quantite à Charger</label>
                                            <input type="text" class="form-control" ng-model="stockTournee.stockinitialReel">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Annuler</button>
                                <button  type="button" class="btn btn-lg btn-primary" ng-click="editstock(stockTournee, tournee, stockTournee.stockinitialReel)">Affecter</button>
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('table.display').DataTable();
        } );
    </script>
@endsection