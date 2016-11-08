@extends('layout.template')

@section('contenu')
    <div class="ajouer_commande_page">
        <h1 class="header-page">
            Visualiser Commande
        </h1>
        {!! Form::open(['url'=>'#']) !!}
        <div role="form" class="form-horizontal col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
            <div class="form-group col-lg-10 col-md-10 col-xs-12 col-sm-10">
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="Edit-numCommande">N° Commande</label>
                    {!! Form::text('numCommande', $commande->id, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'N° Commande', 'id'=>'Edit-numCommande' ,'disabled']) !!}
                </div>
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="nomClient">Nom Client</label>
                    <select name="client" class="form-control col-xs-12 col-lg-4 col-md-4" disabled="disabled">
                        <option value="" name="client0" disabled="true" selected> Selectionner un Client ... </option>
                        @foreach($clients as $client)
                            @if($commande->idClient == $client->id)
                                <option selected value={{$client->id}} > {{$client->Nom}} {{$client->Prenom}} </option>
                            @else
                                <option value={{$client->id}}> {{$client->Nom}} {{$client->Prenom}} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="date-creation">Date de Creation</label>
                    {!! Form::Date('date-creation', $commande->DateCreation, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Date Creation Commande', 'id' => 'date-cration' ,'disabled']) !!}
                </div>
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="statut">Status</label>
                    <select name="statut" class="form-control col-xs-12 col-lg-4 col-md-4" disabled="disabled">
                        <option value="" name="client0" disabled="true" selected> Selectionner un Statut ... </option>
                        @if($commande->statut == 'En Cours')
                            <option selected value='En Cours' > En Cours </option>
                        @else
                            <option value='En Cours' > En Cours </option>
                        @endif

                        @if($commande->statut == 'Livré')
                            <option selected value='Livré' > Livré </option>
                        @else
                            <option value='Livré' > Livré </option>
                        @endif

                        @if($commande->statut == 'Livré partiellement')
                            <option selected value='Livré partiellement' > Livré partiellement </option>
                        @else
                            <option value='Livré partiellement' > Livré partiellement </option>
                        @endif

                        @if($commande->statut == 'Annuler')
                            <option selected value='Annuler' > Annuler </option>
                        @else
                            <option value='Annuler' > Annuler </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-dark btn-lg col-xs-12 col-sm-4 col-md-4 col-lg-2">
            <i class="fa fa-chevron-circle-down" style="align-content: center; font-size: 0.8em"></i>
            Visualiser Facture
        </a>

        <div class="form-group">
            <table id="example" class="table table-striped responsive-utilities jambo_table" >
                <thead style="text-align: center">
                <tr class="headings">
                    <th>Réference</th>
                    <th>Désignation</th>
                    <th>Montant U.HT</th>
                    <th>Taux Remise</th>
                    <th>Montant U Remise HT</th>
                    <th>Quantité cmd</th>
                    <th>Quantité Livrée</th>
                    <th>Quantité Restant A Livrer</th>
                    <th>Montant T Remise HT</th>
                    <th>Montant T.HT</th>
                </tr>
                </thead>
                <tbody >
                @foreach($lignes as $ligne)
                    <tr>
                        <td id="reference">{{ DB::table('produit')->where('id','=',$ligne->idProduit)->first()->reference }}</td>
                        <td id="designation">{{ DB::table('produit')->where('id','=',$ligne->idProduit)->first()->Designation }}</td>
                        <td id="montant-u-ht">{{$ligne->prixHT}}</td>
                        <td id="taux-remise">{{$ligne->tauRemise}} %</td>
                        <td id="montant-u-remise-ht">{{$ligne->prixHT*$ligne->tauRemise*(-0.01)}}</td>
                        <td id="cmd-quantite">{{$ligne->quantiteCmd}}</td>
                        <td id="quantite-livree">{{$ligne->quantiteLivree*(-1)}}</td>
                        <td id="quantite-restant-livree">{{ $ligne->quantiteCmd- $ligne->quantiteLivree}}</td>
                        <td id="montant-t-remise-ht">{{$ligne->montantRemise*(-1)}}</td>
                        <td id="montant-t-ht">{{$ligne->totalPrixHT}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="form-inline form-group col-lg-10 col-lg-offset-1">
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="total-remise" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">Total Remise</label>
                <input type="text" class="form-control" id="total-remise" name="total-remise" disabled="disabled" value="{{DB::table('lignecommande')->where('idCommande','=',$commande->id)->sum('montantRemise')}}">
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="total-ht" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">Total HT</label>
                <input type="text" class="form-control" id="total-ht" name="tatal-ht" disabled="disabled" value="{{$commande->TotalPrixHT}}">
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="tva" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">TVA</label>
                <input type="text" class="form-control" id="tva" name="tva" disabled="disabled" value="{{$tva}}">
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="total-ttc" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">Total TTC</label>
                <input type="text" class="form-control" id="total-ttc" name="total-ttc" disabled="disabled" value="{{$commande->TotalPrixTTC}}">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group ">
            <div class="col-md-10 col-xs-12 col-lg-10 col-lg-offset-10">
                <a href="/commande" class="btn btn-success btn-lg col-xs-12 col-md-4 col-lg-2 btn-ajouter-produit"> Fermer</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}

    <script>

        $(".modifier").click(function () {
            var item = $(this).parent().parent(),
                    reference = item.find("#reference").text(),
                    designation = item.find("#designation").text(),
                    montant_u_ht = item.find("#montant-u-ht").text(),
                    taux_remise = item.find("#taux-remise").text(),
                    cmd_quantite = item.find("#cmd-quantite").text(),
                    montant_t_remise_ht = item.find("#montant-t-remise-ht").text(),
                    montant_t_ht = item.find("#montant-t-ht").text(),
                    montant_u_remise_ht = item.find("#montant-u-remise-ht").text(),

                    modal = $('#modifier_produit_modal').find('.modal-body');
            modal.find('#reference').val(reference);
            modal.find('#designation').val(designation);
            modal.find('#montant-u-ht').val(montant_u_ht);
            modal.find('#taux-remise').val(taux_remise);
            modal.find('#quantite-cmd').val(cmd_quantite);
            modal.find('#montant-t-ht').val(montant_t_ht);
            modal.find('#montant-u-remise-ht').val(montant_t_remise_ht);
            modal.find('#montant-t-remise-ht').val(montant_u_remise_ht);
        });

        //**********id client***********//
        $(document).ready(function()
        {
            $('#Edit-pseudo').keyup(function()
            {
                searchTable_withID($(this).val());
            });
        });

        function searchTable_withID(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#pseudo');
                if(allCells.length !== 0)
                {
                    var found = false;
                    allCells.each(function(index, td)
                    {
                        var regExp = new RegExp(inputVal, 'i');
                        if(regExp.test($(td).text()))
                        {
                            found = true;
                            return false;
                        }
                    });
                    if(found == true)$(row).show();else $(row).hide();
                }
            });
        }

        //**********Nom client***********//

        $(document).ready(function()
        {
            $('#Edit-nomAgent').keyup(function()
            {
                searchTable_withName($(this).val());
            });
        });

        function searchTable_withName(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#name');
                if(allCells.length !== 0)
                {
                    var found = false;
                    allCells.each(function(index, td)
                    {
                        var regExp = new RegExp(inputVal, 'i');
                        if(regExp.test($(td).text()))
                        {
                            found = true;
                            return false;
                        }
                    });
                    if(found == true)$(row).show();else $(row).hide();
                }
            });
        }
    </script>
@endsection