@extends('layout.template')

@section('contenu')

    <div class="liste_client_page">
        <h1 class="header-page">
            Gestion des Vehicules
        </h1>
        <div role="form" class="form-horizontal col-lg-offset-2">

            {!! Form::open(['url' => '#']) !!}
            <div class="form-group">
                <div class="col-md-4 col-xs-12 col-lg-4">
                    {!! Form::text('numvehicule', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'N° Vehicule', 'id'=>'Edit-numVehicule']) !!}
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                    {!! Form::text('typeVehicule', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Matricule', 'id' => 'Edit-typeVehicule']) !!}
                </div>
                <div class="">
                    <a href="/vehicule/ajouter" class="btn btn-success col-md-1 col-lg-1 col-xs-12" id="openBtn">Ajouter</a>
                </div>
                <div class="">
                    {!! Form::submit('Rechercher', ['class' => 'btn btn-primary col-md-1 col-lg-1 col-xs-12']) !!}
                </div>

            </div>

            {!! Form::close() !!}
        </div>

        <table id="example" class="table table-striped responsive-utilities jambo_table">
            <thead>
            <tr class="headings">
                <th>
                    <input type="checkbox" class="tableflat">
                </th>
                <th>N° Vehicule </th>
                <th>Matricule </th>
                <th>KM de Début </th>
                <th>Capacité Srockage </th>
                <th>Modifier </th>
                <th>Supprimer </th>
                <th class=" no-link last"><span class="nobr">Details</span>
                </th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 1; ?>
            @foreach($vehicules as $vehicule)
                <tr class="even pointer" data-toggle="modal" data-id="{!! $i !!}" data-target="#orderModal">
                    <td class="a-center ">
                        <input type="checkbox" class="tableflat">
                    </td>
                    <td id="idVehicule" hidden>{{$vehicule->id}}</td>
                    <td id="num_vehicule">{!! $i !!}</td>
                    <td id="matricule">{{$vehicule->matricule}}</td>
                    <td id="kmdebut">{{$vehicule->KMDebut}}</td>
                    <td id="capacite">{{$vehicule->capaciteStockage}}</td>


                    <td id="" style="text-align: center">
                        <a href="vehicule/modifier/{{$vehicule->id}}" class="use-address modifier" id="openBtn" >
                            <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                        </a>
                    </td>
                    <td id="supprimer" style="text-align: center">
                        <a href="#DeleteModal" data-toggle="modal" class="use-address delete" >
                            <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>
                        </a>
                    </td>
                    <td class=" last" id="show_details" style="text-align: center">
                        <a href="#DetailModal" class="use-address show_details" id="openBtn" data-toggle="modal">
                            <i class="fa fa-info-circle" id="datail" style="font-size: 1.5em; color: #1A82C3"></i>
                        </a>
                    </td>
                </tr>
            <?php $i=$i+1; ?>
            @endforeach
        </table>

        <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Confirmation</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="name">Voulez-Vous Vraiment Supprimer Ce Véhicule ? </b></div>
                    </div>
                    <div class="modal-footer" id="modal-footer-delete">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->




        <!-- Details Modal -->
        <div class="modal fade" id="DetailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Details</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="num_vehicule">N° : </b></div>
                        <div ><b id="matricule">Matricule : </b></div>
                        <div ><b id="kmdebut">KM de Début : </b></div>
                        <div ><b id="capacite">Capacité Srockage : </b></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " data-dismiss="modal">Fermer</button>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Edit Modal -->
        <div class="modal fade" id="EditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Modifier Client</h3>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'AjouterVehicule', 'class'=>'form-horizontal form-label-left']) !!}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">N° Vehicule <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('NumVehicule',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'num-vehicule', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('typeVehicule',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'type-vehicule', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Matricule <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('matricule',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'matricule', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul> </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Modifier</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Ajouter Modal -->
    <div class="modal fade" id="AjouterModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title">Ajouter Client</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'AjouterVehicule', 'class'=>'form-horizontal form-label-left']) !!}

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">N° Vehicule <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('NumVehicule',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'num-vehicule', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('typeVehicule',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'type-vehicule', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Matricule <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('matricule',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'matricule', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul> </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
            </div>

        </div>


    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>


    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}

    <script>
        $(".show_details").click(function () {
            var item = $(this).parent().parent(),
                    numVehicule = item.find("#num_vehicule").text(),
                    matricule = item.find("#matricule").text(),
                    kmdebut = item.find("#kmdebut").text(),
                    capacite = item.find("#capacite").text(),
                    modal = $('#DetailModal').find('.modal-body');
            modal.html('<div><b id="num_vehicule">N° : </b>'+numVehicule+'</div>'+
                    '<div><b id="matricule">Matricule : </b>'+matricule+'</div>'+
                    '<div><b id="kmdebut">KM de Début : </b>'+kmdebut+'</div>'+
                    '<div><b id="capacite">Capacité Srockage : </b>'+capacite+'</div>');
        });

        $("#modifier").click(function () {
            var item = $(this).parent().parent(),
                    numVehicule = item.find("#num-vehicule").text(),
                    typevehicule = item.find("#type-vehicule").text(),
                    matricule = item.find("#matricule").text(),
                    modal = $('#EditModal').find('.modal-body');
            modal.find('#num-vehicule').val(numVehicule);
            modal.find('#type-vehicule').val(typevehicule);
            modal.find('#matricule').val(matricule);
        });



        $(".delete").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#idVehicule").text();
            document.getElementById("modal-footer-delete").innerHTML =
                    '<form method="POST" action="vehicule/'+id+'">'+
                    '<input name="_token" type="hidden" value="{{ csrf_token() }}"'+
                    '<div>'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>'+
                    '<button type="submit" class="btn btn-primary">Valider</button>'+
                    '</div> </form>';
        });


        //**********id client***********//
        $(document).ready(function()
        {
            $('#Edit-numVehicule').keyup(function()
            {
                searchTable_withID($(this).val());
            });
        });

        function searchTable_withID(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#num-vehicule');
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
            $('#Edit-typeVehicule').keyup(function()
            {
                searchTable_withName($(this).val());
            });

            $('#Edit-numVehicule').keyup(function()
            {
                searchTable_withNum($(this).val());
            });
        });

        function searchTable_withName(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#matricule');
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

        function searchTable_withNum(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#num_vehicule');
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


