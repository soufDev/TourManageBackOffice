@extends('app')

@section('content')
    <div class="liste_client_page">
        <h1 class="header-page">
            Gestion des Comptes
        </h1>
        <div ng-app="myApp">
            <div ng-controller="compteController">
                <div role="form" class="form-horizontal col-lg-offset-2">

                    {!! Form::open(['url' => '#']) !!}
                    <div class="form-group">
                        <div class="col-md-4 col-xs-12 col-lg-4">
                            {!! Form::text('pseudo', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Identifiant', 'id'=>'Edit-pseudo']) !!}
                        </div>
                        <div class="col-md-4 col-xs-12 col-lg-4">
                            {!! Form::text('name', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Nom', 'id' => 'Edit-name']) !!}
                        </div>
                        <div class="">
                            {!! Form::submit('Rechercher', ['class' => 'btn btn-primary col-md-1 col-lg-1 col-xs-12']) !!}
                        </div>

                    </div>

                    {!! Form::close() !!}
                </div>

                <div class="table-responsive">
                    <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                        <thead >
                        <tr class="headings">
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Identifiant</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="compte in comptes">
                            <td>@{{ compte.nom }}</td>
                            <td>@{{ compte.prenom }}</td>
                            <td>@{{ compte.identifiant }}</td>
                            <td>
                                <button class="btn btn-default btn-xs btn-detail" ng-click="edit(compte.id)" href="#edit-modal" data-toggle="modal">Modifier</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(compte.id)">Supprimer</button>
                            </td>

                        </tbody>
                    </table>
                </div>
                <!-- update Modal -->
                <div class="modal fade" id="edit-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Modifier Compte</h4>
                            </div>

                            <div class="modal-body">

                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" ng-model="compte.nom" value="@{{ compte.nom }}">

                                <label for="prenom">Preom</label>
                                <input type="text" class="form-control" ng-model="compte.prenom" value="@{{ compte.prenom }}">

                                <label for="identifiant">Identifiant</label>
                                <input type="text" class="form-control" ng-model="compte.identifiant" value="@{{ compte.identifiant }}">

                                <label for="password">Mot De Passe</label>
                                <input type="password" class="form-control" ng-model="compte.password" value="@{{  compte.passorwd  }}">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" ng-click="update(compte)">Modifier</button>
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