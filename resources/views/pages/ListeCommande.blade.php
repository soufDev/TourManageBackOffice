@extends('app')

@section('content')
    <div class="liste_client_page">
        <h1 class="header-page">
            Gestion des Commandes
        </h1>

        <!--message de validation !-->
        <div class="container">
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    <p class="text-capitalize">{{ Session::get('message') }}</p>
                </div>
            @elseif(Session::has('messageMofification'))
                <div class="alert alert-warning" role="alert">
                    <p class="text-capitalize">{{ Session::get('messageModification') }}</p>
                </div>
            @elseif(Session::has('messageSuppression'))
                <div class="alert alert-danger" role="alert">
                    <p class="text-capitalize">{{ Session::get('messageSuppression') }}</p>
                </div>
            @endif
        </div>

        <div role="form" class="form-horizontal col-lg-offset-2">

            {!! Form::open(['url' => '#']) !!}
            <div class="form-group">
                <div class="col-md-4 col-xs-12 col-lg-4">
                    {!! Form::text('Edit-numCommande', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4 ', 'placeholder' => 'N° Commande', 'id'=>'Edit-numCommande']) !!}
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                    {!! Form::Date('Edit-dataCommande', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Date de Commande', 'id' => 'Edit-DateCommande']) !!}
                </div>

                <div class="">
                    <a href="{{ url('/commande/ajouter') }}" class="btn btn-success col-md-1 col-lg-1 col-xs-12 ajout_produit" id="openBtn" data-toggle="modal">
                        Ajouter
                    </a>
                </div>
                <!--
                <div class="">
                    {!! Form::submit('Rechercher', ['class' => 'btn btn-primary col-md-1 col-lg-1 col-xs-12']) !!}
                </div>
                -->
            </div>

            {!! Form::close() !!}
        </div>
        {!! Form::open(['url'=>'genererFacture', 'class'=>'']) !!}
        <div class="table-responsive">
            <table id="example" class="table table-striped responsive-utilities jambo_table">
                <thead>
                <tr class="headings">
                    <th>N° Commande </th>
                    <th>Date Commande </th>
                    <th>Client </th>
                    <th>État Commande </th>
                    <th>Modifier </th>
                    <th>Annuler </th>
                    <th>Détails </th>
                    <th>Générer facture</th>
                    <th>Générer livraison</th>
                </tr>
                </thead>

                <tbody>

                <?php $i=1; ?>
                @foreach($commandes as $commande)
                    <tr class="even pointer" data-toggle="modal" data-id="{!! $i !!}" data-target="#orderModal">

                        <td id="idCommande" >{{$commande->id}}</td>
                        <td id="dateCommande">{{$commande->DateCreation}}</td>
                        <td id="client">{{DB::table('client')->where('id','=', $commande->idClient)->first()->Nom}} {{DB::table('client')->where('id','=', $commande->idClient)->first()->Prenom}}</td>
                        <td id="etatCommande">{{$commande->statut}}</td>

                        <td id="modifier" style="text-align: center">
                            <a class="use-address" href="{{ url('/commande/modifier/'.$commande->id) }}">
                                <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td id="supprimer" style="text-align: center">
                            <a href="#DeleteModal" data-toggle="modal" class="use-address delete" >
                                <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td class=" last" id="show_details" style="text-align: center">
                            <a href="{{ url('/commande/visualiser/') }}/{{$commande->id }}" class="use-address" id="openBtn" data-toggle="modal">
                                <i class="fa fa-info-circle" id="datail" style="font-size: 1.5em; color: #1A82C3"></i>
                            </a>
                        </td>
                        <td class="a-center ">
                            <input type="checkbox" class="tableflat">
                        </td>
                        <td class="a-center ">
                            <input type="checkbox" class="tableflat id_commande" value="{{ $commande->id }}">
                        </td>
                    </tr>

                <?php $i=$i+1;?>
                @endforeach
            </table>
        </div>
        <br>
        <br>
        <br>
        <div class="form-group">
            <div class="col-lg-7 col-md-9 col-xs-10 col-lg-offset-8 col-md-offset-7 col-xs-offset-5">

                <button type="button" class="btn btn-success col-xs-4 col-md-3 col-lg-3"  >Générer Facture</button>
                <button type="button" href="#genLiv" class="btn btn-success col-xs-4 col-md-3 col-lg-3 btn-livraison" id="openBtn" data-toggle="modal" >Générer Livraison</button>
            </div>
        </div>
        <div class="">
        </div>
    {!! Form::close() !!}



    <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Confirmation</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="name">Voulez-vous vraiment supprimer cette commande ? </b></div>
                    </div>
                    <div class="modal-footer" id="modal-footer-delete">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <!-- Edit Modal -->
        <div class="modal fade" id="Edit_myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Modifier Commande</h3>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'AjouterProduit', 'class'=>'form-horizontal form-label-left']) !!}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">N° Commande
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('numCommande',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'numCommande', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Client <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('client',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'client', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Etat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('etat',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'etat', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Modifier</button>
                                <button type="submit" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

        <!-- Detail Modal -->
        <div class="modal fade" id="detail_myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Details Commande</h3>
                    </div>
                    <div class="modal-body">

                    </div>

                </div>


            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

        <!-- Debut Modal Generation Livraison-->
        <div class="modal fade" id="genLiv" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">x</button>
                        <h3 class="modal-title">Générer Livraison</h3>
                    </div>
                    <div class="modal-body ">
                        <div class="container" role="form">
                            <div class="col-lg-10 col-md-10 col-xs-10">
                                <div class="col-lg-offset-2 col-md-offset-2 col-xs-offset-2">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="reference">Transporteur</label>
                                        <select class="form-control" id="id-transporteur">
                                            <option value="" selected>Choisir Un Transporteur</option>
                                            @foreach($transporteurs as $transporteur)
                                                <option value="{{ $transporteur->id }}">
                                                    {{ $transporteur->nom }} {{ $transporteur->prenom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="date-livraison">Date Livraison</label>
                                        <input type="date" id="date-livraison" class="form-control date-livraison" name="date-livraison">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Annuler</button>
                            <button  type="button" class="btn btn-lg btn-primary" id="gen-livraison">Générer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal Generation Livraison-->

    </div><!-- /.modal -->





    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#show_details").click(function () {
            var item = $(this).parent().parent(),
                    numCommande = item.find("#num-commande").text(),
                    client = item.find("#client").text(),
                    etatCommande = item.find("#etat-commande").text(),

                    modal = $('#detail_myModal').find('.modal-body');
            modal.html('<div><b id="numCommande">N° Commande : </b>'+numCommande+'</div>'+
                    '<div><b id="client">Client : </b>'+client+'</div>'+
                    '<div><b id="etatcommande">Etat Commande : </b>'+etatCommande+'</div>');
        });

        $("#modifier").click(function () {
            var item = $(this).parent().parent(),
                    nom = item.find("#num-commande").text(),
                    prenom = item.find("#client").text(),
                    identifiant = item.find("#etat-commande").text(),

                    modal = $('#Edit_myModal').find('.modal-body');
            modal.find('#numCommande').val(nom);
            modal.find('#client').val(prenom);
            modal.find('#etat').val(identifiant);
        });


        $(".delete").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#idCommande").text();
            document.getElementById("modal-footer-delete").innerHTML =
                    '<form method="POST" action="commande/'+id+'">'+
                    '<input name="_token" type="hidden" value="{{ csrf_token() }}"'+
                    '<div>'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>'+
                    '<button type="submit" class="btn btn-primary">Valider</button>'+
                    '</div> </form>';
        });

        //**********id client***********//
        $(document).ready(function()
        {
            $('#Edit-numCommande').keyup(function()
            {
                searchTable_withID($(this).val());
            });
        });

        function searchTable_withID(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#idCommande');
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

        $(document).ready(function(){
            $('#Edit-DateCommande').change(function(){
                searchTable_withName(this.value);
            });
        });

        function searchTable_withName(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#dateCommande');
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

        //  Generer les livraisons
        $("#gen-livraison").click(function() {

            var ids = $('.id_commande:checked').map(function(_, el) {
                        return $(el).val();
                    }).get(),
                    transporteur = $('#id-transporteur').val(),
                    dateLivraison = $('#date-livraison').val();
            if( ids.length == 0 ){
                alert('Selectionner les Commande à affecter');
            }else if(transporteur == ""){
                alert('selectionner un Transporteur');
            }else if(dateLivraison == ""){
                alert('Selectionner Une Date de Livraison')
            } else {


                $.post('genererLivraison',
                        {
                            id_commandes : ids,
                            transporteur : transporteur,
                            dateLivraison : dateLivraison
                        }, function(data) {
                            console.log(data);
                            location.reload();
                        } );

            }
        } );
    </script>

    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}
@endsection