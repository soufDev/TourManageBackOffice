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
                    {!! Form::text('typeVehicule', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Type Vehicule', 'id' => 'Edit-typeVehicule']) !!}
                </div>
                <div class="">
                    <a href="#AjouterModal" class="ajout_client" id="openBtn" data-toggle="modal">
                        <button class="btn btn-success col-md-1 col-lg-1 col-xs-12">Ajouter</button>
                    </a>
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
                <th>Type </th>
                <th>Matricule </th>
                <th>Modifier </th>
                <th>Supprimer </th>
                <th class=" no-link last"><span class="nobr">Details</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @for($i=1 ; $i<=50 ; $i++)
                <tr class="even pointer" data-toggle="modal" data-id="{!! $i !!}" data-target="#orderModal">
                    <td class="a-center ">
                        <input type="checkbox" class="tableflat">
                    </td>
                    <td id="num-vehicule">{!! $i !!}</td>
                    <td id="type-vehicule">Soufiane AIT AKKACHE</td>
                    <td id="matricule">121000210
                    </td>
                    <td id="modifier" style="text-align: center">
                        <a href="#EditModal" class="use-address" id="openBtn" data-toggle="modal">
                            <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                        </a>
                    </td>
                    <td class="a-right a-right " id="supprimer" style="text-align: center">
                        <a href="#">
                            <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>


                        </a>
                    </td>
                    <td class=" last" id="show_details" style="text-align: center">
                        <a href="#DetailModal" class="use-address" id="openBtn" data-toggle="modal">
                            <i class="fa fa-info-circle" id="datail" style="font-size: 1.5em; color: #1A82C3"></i>
                        </a>
                    </td>
                </tr>

            @endfor
        </table>
        <!-- Details Modal -->
        <div class="modal fade" id="DetailModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Details</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="num-vehicule">N° : </b></div>
                        <div ><b id="type-vehicule">Type : </b></div>
                        <div ><b id="matricule">Matricule : </b></div>
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
        $("#show_details").click(function () {
            var item = $(this).parent().parent(),
                    numVehicule = item.find("#num-vehicule").text(),
                    typevehicule = item.find("#type-vehicule").text(),
                    matricule = item.find("#matricule").text(),
                    modal = $('#DetailModal').find('.modal-body');
            modal.html('<div><b id="num-vehicule">N° : </b>'+numVehicule+'</div>'+
                    '<div><b id="type-vehicule">Type : </b>'+typevehicule+'</div>'+
                    '<div><b id="matricule">Matricule : </b>'+matricule+'</div>');
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
        });

        function searchTable_withName(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#type-vehicule');
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


