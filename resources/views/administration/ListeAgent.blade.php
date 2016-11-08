@extends('app')

@section('content')
        <h1 class="header-page">
            Gestion Des Agents
        </h1>
        <div ng-app="myApp">
            <div  ng-controller="employeesController">

                <!-- Table-to-load-the-data Part -->
                <div class="table-responsive">
                    <table datatable="ng" class="row-border hover table table-striped responsive-utilities jambo_table">
                        <thead>
                        <tr class="headings">
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Secteur</th>
                            <th>Date d'Embauche</th>
                            <th>
                                <button type="button" href="#add-modal" id="openBtn" class="btn btn-primary btn-xs" data-toggle="modal">Ajouter un Nouvel Agent</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="employe in employes">
                            <td>@{{ employe.identifiant }}</td>
                            <td>@{{ employe.nom }}</td>
                            <td>@{{ employe.prenom }}</td>
                            <td>@{{ employe.nomSecteur }}</td>
                            <td>@{{ employe.dateNaissance }}</td>
                            <td>
                                <button href="#edit-modal" class="btn btn-default btn-xs btn-detail" data-toggle="modal" ng-click="edit(employe.id)">Modifier</button>
                                <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(employe.id)">Supprimer</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- End of Table-to-load-the-data Part -->

                <!-- update Modal -->
                <div class="modal fade" id="edit-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Modifier Employé</h4>
                            </div>

                            <div class="modal-body">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" ng-model="employe.nom" value="@{{ employe.nom }}">

                                <label for="nom">Prénom</label>
                                <input type="text" class="form-control" ng-model="employe.prenom" value="@{{ employe.prenom }}">

                                <label for="nom">Identifiant</label>
                                <input type="text" class="form-control" ng-model="employe.identifiant" value="@{{ employe.identifiant }}">

                                <label for="nom">Email</label>
                                <input type="text" class="form-control" ng-model="employe.email" value="@{{ employe.email }}">

                                <label for="nom">Mot De Passe</label>
                                <input type="password" class="form-control" ng-model="employe.password" value="@{{ employe.passorwd }}">

                                <label for="nom">Téléphone</label>
                                <input type="text" class="form-control" ng-model="employe.telephone" value="@{{ employe.telephone }}">

                                <label for="nom">Adresse</label>
                                <input type="text" class="form-control" ng-model="employe.adresse" value="@{{ employe.adresse }}">

                                <label for="created_at">Date d'Embauche</label>
                                <input type="date" class="form-control" ng-model="employe.dateNaissance">



                                <label for="typeEmploye">Profil</label>
                                <select name="profil" class="form-control" ng-model="employe.id_profil">
                                    <option  ng-repeat="profil in profils" value="@{{ profil.id }}" ng-selected="@{{ profil.id == employe.id_profil }}">@{{ profil.nom }}</option>
                                </select>

                                <label for="secteurs">Secteur</label>
                                <select name="secteurs" id="secteurs" class="form-control" ng-model="employe.id_secteur">
                                    <option ng-selected="@{{ secteur.id == employe.id_secteur}}" ng-repeat="secteur in secteurs" value="@{{ secteur.id }}" >@{{ secteur.nomsecteur }}</option>
                                </select>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" ng-click="update(employe)">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add Modal -->
                <div class="modal fade" id="add-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Ajouter Employé</h4>
                            </div>

                            <div class="modal-body" >
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" ng-model="Employe.nom" name="nom" id="nom" placeholder="Nom" >

                                <label for="nom">Prérom</label>
                                <input type="text" class="form-control" ng-model="Employe.prenom" name="prenom" id="prenom" placeholder="Prenom">

                                <label for="nom">Identifiant</label>
                                <input type="text" class="form-control" ng-model="Employe.identifiant" name="identifiant" id="identifiant" placeholder="Identifiant">

                                <label for="nom">Email</label>
                                <input type="text" class="form-control" ng-model="Employe.email" name="email" id="email" placeholder="Email">

                                <label for="nom">Mot De Passe</label>
                                <input type="password" class="form-control" ng-model="Employe.password" name="password" id="password" placeholder="Mot De Passe">

                                <label for="nom">Téléphone</label>
                                <input type="text" class="form-control" ng-model="Employe.telephone" name="telephone" id="telephone" placeholder="Telephone">

                                <label for="nom">Adresse</label>
                                <input type="text" class="form-control" ng-model="Employe.adresse" name="adresse" id="adresse" placeholder="Adresse">

                                <label for="created_at">Date d'Embauche</label>
                                <input type="date" class="form-control" ng-model="Employe.dateNaissance" name="dateNaissance" id="dateNaissance" placeholder="Date d'Embauche">

                                <label for="typeEmploye">Profil</label>
                                <select name="profil" class="form-control" ng-model="Employe.id_profil">
                                    <option value="">Selectionnez Un Profil</option>
                                    <option  ng-repeat="profil in profils" value="@{{ profil.id }}" >@{{ profil.nom }}</option>
                                </select>

                                <label for="secteur">Secteur</label>
                                <option value="">Séléctionnez Un Secteur</option>
                                <select id="secteur" name="secteur" class="form-control" ng-model="Employe.id_secteur">
                                    <option ng-repeat="secteur in secteurs" value="@{{ secteur.id }}">@{{ secteur.nomsecteur }}</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" ng-click="create(Employe)">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <!-- AngularJS Application Scripts -->

        {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
        {!! Html::script('assets/js/icheck/icheck.min.js') !!}
@endsection
