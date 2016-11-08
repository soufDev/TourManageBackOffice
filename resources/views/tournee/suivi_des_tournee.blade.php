@extends('app')

@section('content')
    <div ng-app="myApp">
        <div ng-controller="suiviTourneeController">
            <h1 class="header-page">Suivi des Tournée</h1>
            <div class="form-horizontal col-lg-9 col-md-12 col-sm-12 col-xs-12 col-md-offset-0 col-lg-offset-3" ng-model="tournee.dateTournee" >
                <div class="form-group col-lg-4 col-md-6 col-xs-12 col-sm-6">
                    <label for="date-tournee">Date de la Tournée *</label>
                    <input type="date" class="form-control" id="date-tournee" name="date-tournee" ng-change="getData(tournee)" ng-model="tournee.dateTournee">
                </div>

                <div class="form-group col-lg-4 col-md-6 col-xs-12 col-sm-6">
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
                <!--
                {!! Form::submit('Rechercher',['class'=>'btn btn-dark btn-lg col-lg-2 col-md-6 col-xs-12 col-sm-6', 'id'=>'chercher']) !!}
                -->
            </div>

            <div class="col-lg-12 table-responsive">
                <table  datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                    <thead id="headings">
                    <tr>
                        <th>N° Tournée</th>
                        <th>Date de la Tournée</th>
                        <th>Transporteur</th>
                        <th>Visualiser</th>
                        <th>Status</th>
                        <th>Etapes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="tournee in tournees">
                        <td id="num-tournee">@{{ tournee.id }}</td>
                        <td id="date-tournee">@{{ tournee.DateDebut }}</td>
                        <td id="transporteur">@{{ tournee.nom }} @{{ tournee.prenom }}</td>
                        <td id="details">
                            <a href="#" class="details">
                                <span class="glyphicon glyphicon-info-sign" style="color:#1A82C3 ;font-size: 1.2em; align-content: center"></span>
                            </a>
                        </td>
                        <td id="status">@{{ tournee.statut }}</td>
                        <td id="etapes"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}
    @endsection