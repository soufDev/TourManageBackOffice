@extends('layout.template')

@section('contenu')
    <div class="liste_client_page">
        <h1 class="header-page">
            Gestion des Produits
        </h1>
        <div role="form" class="form-horizontal col-lg-10 col-xs-12 col-lg-offset-2">

            {!! Form::open(['url' => '#']) !!}
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
                </div>
                <div class="form-group col-md-5 col-xs-12 col-lg-8">
                    <div class="col-md-6 col-lg-2 col-xs-12 col-lg-offset-5">
                        <a href="#AjouterModal" class="ajout_produit" id="openBtn" data-toggle="modal">
                            <button class="btn btn-success btn-lg col-md-12 col-lg-12 col-xs-12">Ajouter</button>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xs-12 col-lg-offset-1">
                        {!! Form::submit('Rechercher', ['class' => 'btn btn-primary btn-lg col-md-12 col-lg-12 col-xs-12']) !!}
                    </div>
                </div>

            </div>

            {!! Form::close() !!}
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
                        <a href="#Edit_myModal" class="use-address" id="openBtn" data-toggle="modal">
                            <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                        </a>
                    </td>
                    <td class="a-right a-right " id="supprimer" style="text-align: center">
                        <a href="#">
                            <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>


                        </a>
                    </td>
                    <td class=" last" id="show_details" style="text-align: center">
                        <a href="#Detail_myModal" class="use-address" id="openBtn" data-toggle="modal">
                            <i class="fa fa-info-circle" id="datail" style="font-size: 1.5em; color: #1A82C3"></i>
                        </a>
                    </td>
                </tr>

            @endfor
        </table>
        <!-- Details Modal -->
        <div class="modal fade" id="Detail_myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Details</h3>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " data-dismiss="modal">Fermer</button>
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
                        <h3 class="modal-title">Modifier Produit</h3>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => 'AjouterProduit', 'class'=>'form-horizontal form-label-left']) !!}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ID
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('idProduit',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'id-produit', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Designation <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('designation',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'designation', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Categorie<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('categorie',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'categorie', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Quantite<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('quantite',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'quantite', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Code d'Identification<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('codeIdentification',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code-identification', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Prix Achat<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('prixAchat',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prix-achat', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Code Mesure<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('codeMesure',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code-mesure', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Reference <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('reference',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'reference', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Taux TVA <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('tauxTva',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'taux-tva', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
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

    <!-- Ajouter Modal -->
    <div class="modal fade" id="AjouterModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title">Ajouter Produit</h3>
                </div>

                <div class="modal-body">
                    {!! Form::open(['url' => 'AjouterProduit', 'class'=>'form-horizontal form-label-left']) !!}

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('idProduit',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'id-produit', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Designation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('designation',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'designation', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Categorie<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('categorie',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'categorie', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Quantite<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('quantite',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'quantite', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Code d'Identification<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('codeIdentification',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code-identification', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Prix Achat<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('prixAchat',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prix-achat', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Code Mesure<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('codeMesure',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code-mesure', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Reference <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('reference',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'reference', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                            <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Taux TVA <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('tauxTva',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'taux-tva', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
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