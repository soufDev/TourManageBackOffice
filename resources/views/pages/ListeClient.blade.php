@extends('app')

@section('content')


    <div class="liste_client_page">
        <h1 class="header-page">
            Gestion des Clients
        </h1>
        <!--message de validation !-->
        <div class="container">
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    <p class="text-capitalize">{{ Session::get('message') }}</p>
                </div>
            @endif
        </div>
        <div role="form" class="form-horizontal col-lg-offset-2">

            {!! Form::open(['url' => '#']) !!}
            <div class="form-group">
                <div class="col-md-4 col-xs-12 col-lg-4">
                    {!! Form::text('idclient', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Id Client', 'id'=>'Edit-idclient']) !!}
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                    {!! Form::text('nomClient', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Nom Client', 'id' => 'Edit-nomClient']) !!}
                </div>
                <div class="">
                    <a href="{{ url('client/ajouter') }}" class="btn btn-success col-md-1 col-lg-1 col-xs-12" id="openBtn">Ajouter
                    </a>
                </div>

            </div>

            {!! Form::close() !!}
        </div>

        <div class="table-responsive">
            <table id="example" class="table table-striped responsive-utilities jambo_table">
                <thead>
                <tr class="headings">
                    <th>
                        <input type="checkbox" class="tableflat">
                    </th>
                    <th>N° Client </th>
                    <th>Nom </th>
                    <th>Segment </th>
                    <th>Email </th>
                    <th>Modifier </th>
                    <th>Supprimer </th>
                    <th class=" no-link last"><span class="nobr">Details</span>
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php $i = 1; ?>
                @foreach($clients as $client)
                    <tr class="even pointer" data-toggle="modal" data-id="{!! $client->id !!}" data-target="#orderModal" id="id_client">
                        <td class="a-center ">
                            <input type="checkbox" class="tableflat">
                        </td>
                        <td id="idClient" hidden>{{$client->id}}</td>
                        <td id="N°">{{$i}}</td>
                        <td id="name">{{$client->Nom}} {{$client->Prenom}}</td>
                        <td id="segment">{{$client->SegmentClient}}</td>
                        <td id="adress">{{$client->Email}}</td>
                        <td id="telephone" hidden>{{$client->telephone}}</td>
                        <td id="dateAdd" hidden>{{$client->DateCreation}}</td>
                        <td id="nom" hidden>{{$client->Nom}}</td>
                        <td id="prenom" hidden>{{$client->Prenom}}</td>
                        <td id="" style="text-align: center">
                            <a href="{{ url('client/modifier') }}/{{$client->id}}" class="use-address modifier" id="openBtn" >
                                <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td id="supprimer" style="text-align: center">
                            <a href="#DeleteModal" data-toggle="modal" class="use-address delete" >
                                <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td class=" last" id="" style="text-align: center">
                            <a href="#DetailModal" class="use-address show_details" id="openBtn" data-toggle="modal">
                                <i class="fa fa-info-circle" id="datail" style="font-size: 1.5em; color: #1A82C3"></i>
                            </a>
                        </td>
                    </tr>
                <?php $i=$i+1; ?>
                @endforeach
            </table>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Confirmation</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="name">Voulez-Vous Vraiment Supprimer Ce Client ? </b></div>
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
                        <div ><b id="name">Nom : </b></div>
                        <div ><b id="segment">segment : </b></div>
                        <div ><b id="adress">Email : </b></div>
                        <div ><b id="telephone">Téléphone : </b></div>
                        <div ><b id="dateAdd">Date Ajout : </b></div>
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

                        {!! Form::open(['method'=>'PUT' , 'action' => [ 'ListeClientController@getmodifierClient',0], 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nom Client <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('nomClient',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'nom-client', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                    <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Prénom Client<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('prenom',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prenom-client', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                    <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Segement <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('segement',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'segment', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                    <ul class="parsley-errors-list" id="parsley-id-9303"></ul> </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::email('adress',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'adress', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                    <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">telephone <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('telephone',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'telephone', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                    <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Ajout <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12" id="dateAddEdite">
                                     <input  class='form-control col-md-7 col-xs-12' type="date" name="dateAdd"  step="1" id="dateAdd" required="required">
                                    <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
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




    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}

    <script>
        $(".show_details").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#prenom").text(),
                    name = item.find("#name").text(),
                    segment = item.find("#segment").text(),
                    adress = item.find("#adress").text(),
                    telephone= item.find("#telephone").text(),
                    dateAdd= item.find("#dateAdd").text(),
                    modal = $('#DetailModal').find('.modal-body');
            modal.find('#name').text('Nom : '+name);
            modal.find('#segment').text('Segment : '+segment);
            modal.find('#adress').text('Adress : '+adress);
            modal.find('#telephone').text('Téléphone : '+telephone);
            modal.find('#dateAdd').text('Date Ajout : '+dateAdd);
        });

        $(".modifier").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#id").text(),
                    nom = item.find("#nom").text(),
                    prenom = item.find("#prenom").text(),
                    segment = item.find("#segment").text(),
                    adress = item.find("#adress").text(),
                    telephone= item.find("#telephone").text(),
                    dateAdd= item.find("#dateAdd").text(),
                    id_client=item.find("#id_client");
            modal = $('#EditModal').find('.modal-body');
            modal.find('#id-client').val(id);
            modal.find('#nom-client').val(nom);
            modal.find('#prenom-client').val(prenom);
            modal.find('#segment').val(segment);
            modal.find('#adress').val(adress);
            modal.find('#telephone').val(telephone);
            document.getElementById('dateAddEdite').innerHTML= '<input  class="form-control col-md-7 col-xs-12" type="date" name="dateAdd"  id="dateAdd" required="required" value='+dateAdd+'> <ul class="parsley-errors-list" id="parsley-id-9303"></ul>';

        });


        $(".delete").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#idClient").text();
            document.getElementById("modal-footer-delete").innerHTML =
                    '<form method="POST" action="client/'+id+'">'+
                    '<input name="_token" type="hidden" value="{{ csrf_token() }}"'+
                    '<div>'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>'+
                    '<button type="submit" class="btn btn-primary">Valider</button>'+
                    '</div> </form>';
        });



        //**********id client***********//
        $(document).ready(function()
        {
            $('#Edit-idclient').keyup(function()
            {
                searchTable_withID($(this).val());
            });
        });

        function searchTable_withID(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#id');
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
            $('#Edit-nomClient').keyup(function()
            {
                searchTable_withName($(this).val());
            });

            $('#Edit-idclient').keyup(function()
            {
                searchTable_withNum($(this).val());
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


        function searchTable_withNum(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#N°');
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


