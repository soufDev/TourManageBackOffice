@extends('app')

@section('content')
    <div ng-app="myApp">
        <div ng-controller="tournesController">
            <h1 class="header-page">
                Generer Les Tournées
            </h1>

            <h3 class="header-page">Sélectionner les tournées à génerer</h3>
            <br>
            {!! Form::open(['url'=>'#']) !!}
            <div class="form-horizontal col-lg-8 col-md-12 col-sm-12 col-xs-12 col-md-offset-0 col-lg-offset-3">
                <div class="form-group col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <label for="date-tournee">Date de la Tournée</label>
                    <input ng-model="tournee.dateDebut" type="date" class="form-control" id="date-tournee" name="date-tournee" ng-required="true">
                </div>

                <div class="form-group col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <label for="transporteur">Transporteur</label>
                    <select ng-model="tournee.transporteur" class="form-control" ng-required="true">
                        <option value="" ng-selected="true">Choisir Un Transporteur</option>
                        <option value="@{{ transporteur.idTransporteur }}" ng-repeat="transporteur in transporteurs">
                            @{{ transporteur.nom }}
                            @{{ transporteur.prenom }}
                        </option>
                    </select>
                </div>
                <br>
                <button type="button" href="#attribuerVehicule" class="btn btn-dark btn-lg" id="openBtn"  data-toggle="modal" >
                    Générer Les Tournées
                </button>
             </div>
            {!! Form::close() !!}

            <div class="table-responsive">
                <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                    <thead id="headings">
                    <tr>
                        <th>N° Tournrée</th>
                        <th>Date de la tournée</th>
                        <th>Transporteur</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        <th>status</th>
                        <th>Etapes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="tournee in tournees">
                        <td id="num-tournee">@{{ tournee.id }}</td>
                        <td id="date-tournee">@{{ tournee.DateDebut }}</td>
                        <td id="transporteur">@{{ tournee.nom }} @{{ tournee.prenom }}</td>
                        <td id="modifier">
                            <a href="#" class="modifier" data-toggle="modal" id="openBtn">
                                <span class="glyphicon glyphicon-edit" style="color:#26B99A ;font-size: 1.2em; align-content: center"></span>
                            </a>
                        </td>
                        <td id="supprimer">
                            <a href="#" class="supprimer" >
                                <span class="glyphicon glyphicon-remove" style="color:#ff2918 ;font-size: 1.2em; align-content: center"></span>
                            </a>
                        </td>
                        <td id="status">@{{ tournee.statut }}</td>
                        <td id="etape">

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <!-- Moddal Attribuer Vehilcule -->
            <div class="modal fade" id="attribuerVehicule" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">x</button>
                            <h3 class="modal-title">Attribuer Un Vehicule</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="container" role="form">
                                <div class="col-lg-10 col-md-10 col-xs-10">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">

                                        <div class="form-group">
                                            <label for="reference">Réference</label>
                                            <select class="form-control" ng-model="tournee.vehicule">
                                                <option value="" ng-selected="true">Choisir Un Vehicule</option>
                                                <option value="@{{ vehicule.id }}" ng-repeat="vehicule in vehicules">
                                                    @{{ vehicule.matricule }}
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
                                <button  type="button" class="btn btn-lg btn-primary" ng-click="affecter(tournee)">Affecter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Modal -->
            <!-- Modifier Date Tournée-->
            <div class="modal fade" id="modifierDate" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">x</button>
                            <h3 class="modal-title">Modifier Tournée</h3>
                        </div>
                        <div class="modal-body ">
                            <div class="container" role="form">
                                <div class="col-lg-10 col-md-10 col-xs-10">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">
                                        <div class="form-group">
                                            <label for="date-tournee">Date de la Tournée</label>
                                            <input type="date" ng-model="tournee.date" class="form-control" value="@{{ tournee.dateDebut }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="date-tournee">Transporteur</label>
                                            <select ng-model="tournee.transporteur" class="form-control">
                                                <option value="@{{ transporteur.id }}"
                                                        ng-selected="@{{ transporteur.id == tournee.idTransporteur }}"
                                                        ng-repeat="transporteur in transporteurs">
                                                    @{{ transporteur.nom }}
                                                    @{{ transporteur.prenom }}
                                                </option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="statut">Statut</label>
                                            <select ng-model="tournee.statut" class="form-control">
                                                <option value="@{{ statut.value }}" ng-repeat="statut in statuts"
                                                        ng-selected="@{{ statut.value == tournee.statut }}">
                                                    @{{ statut.value }}
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
                                <button  type="button" class="btn btn-lg btn-primary" ng-click="modifier(tournee)">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Modal -->
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('table.display').DataTable();
        } );
    </script>

    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}
    @endsection