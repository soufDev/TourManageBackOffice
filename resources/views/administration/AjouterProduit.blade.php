@extends('layout.template')

@section('contenu')
    <div class="liste_client_page">
        <h1 class="header-page">
            Ajouter un produit
        </h1>
        {!! Form::open(['url' => '#']) !!}
        <div role="form" class="form-horizontal col-lg-10 col-xs-12 col-lg-offset-2">


            <div class="form-group">
                <div class="form-group-lg form-group">
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::text('codebarProduit', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Code a Barres', 'id'=>'Edit-codeBar']) !!}
                    </div>
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::text('referenceProduit', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Réferences', 'id' => 'Edit-referenceProduit']) !!}
                    </div>
                </div>
                <div class="form-group-lg form-group">
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::text('DesignationProduit', null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Désignation', 'id' => 'Edit-designationProduit']) !!}
                    </div>
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::select('PrixAchatProduit', [],null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Prix Achat Appliqué', 'id' => 'Edit-prixAchatProduit']) !!}
                    </div>

                </div>
                <div class="form-group-lg form-group">
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::select('categorieProduit', [], null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Catégories', 'id' => 'Edit-categorieProduit']) !!}
                    </div>
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::select('MesureProduit', [],null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Mesure', 'id' => 'Edit-mesureProduit']) !!}
                    </div>

                </div>
                <div class="form-group-lg form-group">
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        {!! Form::select('cadeTaxeProduit', [], null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'Code Taxe', 'id' => 'Edit-codeTaxeProduit']) !!}
                    </div>
                    <div class="col-md-5 col-xs-12 col-lg-5">
                        <a href="#AjouterModal" class="ajout_produit" id="openBtn" data-toggle="modal">
                            <button class="btn btn-success btn-lg col-md-6 col-lg-6 col-xs-12 col-lg-offset-6 col-md-offset-6">Ajouter Prix</button>
                        </a>
                    </div>
                </div>
            </div>

            </div>
            <table id="example" class="table table-striped responsive-utilities jambo_table">
                <thead>
                <tr class="headings">
                    <th>Code a Barres </th>
                    <th>References </th>
                    <th>Categorie </th>
                    <th>Désignation </th>
                    <th>Tarification </th>
                    <th>Modifier </th>
                    <th>Supprimer </th>
                    <th>Details</span>
                    </th>
                </tr>
                </thead>

                <tbody>
                @for($i=1 ; $i<=50 ; $i++)
                    <tr class="even pointer" data-toggle="modal" data-id="{!! $i !!}" data-target="#orderModal">
                        <td id="id">sofi_rap</td>
                        <td id="designation">Soufiane AIT AKKACHE</td>
                        <td id="quantite">Nord
                        </td>
                        <td id="prix">21/12/2015</td>
                        <td id="remise">21/12/2015</td>
                        <td id="modifier" style="text-align: center">
                            <a href="#AjouterModal" class="use-address" id="openBtn" data-toggle="modal">
                                <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td class="a-right a-right " id="supprimer" style="text-align: center">
                            <a href="#">
                                <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>


                            </a>
                        </td>
                        <td class="last" id="show_details" style="text-align: center">
                            <a href="#Detail_myModal" class="use-address" id="openBtn" data-toggle="modal">
                                <i class="fa fa-info-circle" id="datail" style="font-size: 1.5em; color: #1A82C3"></i>
                            </a>
                        </td>
                    </tr>

                @endfor
            </table>
            <br>
            <br>
            <br>
            <div class="col-md-6 col-lg-4 col-xs-12 col-sm-6 col-lg-offset-10 col-md-offset-7">
                <a href="#" class="ajout_produit btn btn-dark btn-lg col-md-5 col-lg-3 col-xs-12 col-sm-5">
                    Annuler
                </a>
                {!! Form::submit('Valider', ['class' => 'btn btn-primary btn-lg col-md-5 col-lg-3 col-xs-12 col-sm-5']) !!}
            </div>


        {!! Form::close() !!}

        <!-- Details Modal -->
        <div class="modal fade" id="Detail_myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Detail Produit</h3>
                    </div>
                    <div class="modal-body">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Details Modal -->
        <div class="modal fade" id="AjouterModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Ajouter Prix</h3>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'AjouterProduit', 'class'=>'form-horizontal form-label-left']) !!}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Segment<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-10 col-xs-12">
                                {!! Form::select('segment',['segment1'=>'segment1', 'segment3'=>'segment3', 'segment2'=>'segment2'],null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'segment', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Prix HT <span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                {!! Form::text('prix-ht',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prix-ht', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>

                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Prix TTC <span class="required">*</span>
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                {!! Form::text('prix-ttc',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prix-ttc', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Marge
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                {!! Form::text('marge',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'marge', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>

                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Valeur
                            </label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                {!! Form::text('valeur',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'valeur', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="gender" class="btn-group col-lg-offset-3" data-toggle="buttons">
                                <label class="btn btn-default parsley-success active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="activer" value="actif" data-parsley-multiple="gender" data-parsley-id="3126"> &nbsp; Actif &nbsp;
                                </label>
                                <ul class="parsley-errors-list" id="parsley-id-multiple-gender"></ul>
                                <label class="btn btn-dark" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="activer" value="inactif" checked="" data-parsley-multiple="gender" data-parsley-id="3126"> Inactif
                                </label>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Ajouter</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>


    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}

    <script>

        var ajouter_body = '';
        $("#show_details").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#id").text(),
                    designation = item.find("#designation").text(),
                    quantite = item.find("#quantite").text(),
                    prix = item.find("#prix").text(),
                    remise = item.find("#remise").text(),

                    modal = $('#Detail_myModal').find('.modal-body');
            modal.html('<div><b id="pseudo">ID : </b>'+id+'</div>'+
                    '<div><b id="name">Designation : </b>'+designation+'</div>'+
                    '<div><b id="region">Quantité : </b>'+quantite+'</div>'+
                    '<div><b id="prix">Prix : </b>'+prix+'</div>'+
                    '<div><b id="remise">Remise : </b>'+remise+'</div>');
        });

        $("#modifier").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#id").text(),
                    designation = item.find("#designation").text(),
                    quantite = item.find("#quantite").text(),
                    prix = item.find("#prix").text(),
                    remise = item.find("#remise").text(),

                    modal = $('#Edit_myModal').find('.modal-body');
            modal.find('#id-produit').val(id);
            modal.find('#designation').val(designation);
            modal.find('#quantite').val(quantite);
        });

        //**********id client***********//
        $(document).ready(function()
        {
            $('#Edit-idProduit').keyup(function()
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
            $('#Edit-designation').keyup(function()
            {
                searchTable_withName($(this).val());
            });
        });

        function searchTable_withName(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#designation');
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