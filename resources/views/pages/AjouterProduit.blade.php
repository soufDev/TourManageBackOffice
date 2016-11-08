@extends('app')

@section('content')
    <h1 class="header-page">Ajouter produit</h1>
    <div class="x_content">
        <br>
        {!! Form::open(['url' => 'produit', 'class'=>'form-horizontal form-label-left']) !!}

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Designation <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('Designation',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'designation1', 'data-parsley-id'=>'8525']) !!}
                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
            </div>

        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Categorie <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::select('idCategorie',$categories,null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'categorie1', 'data-parsley-id'=>'9303']) !!}

            <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
        </div>
            </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Code d'Identification<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('CodeIdentification',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code-identification1', 'data-parsley-id'=>'9303']) !!}
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Prix Achat<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('PrixAchatAppliquee',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prix-achat1', 'data-parsley-id'=>'9303']) !!}
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Code Mesure<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('codeMesure',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code-mesure1', 'data-parsley-id'=>'9303']) !!}
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
            </div>
        </div>
        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Reference <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('reference',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'reference1', 'data-parsley-id'=>'9303']) !!}
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pseudo">Taux TVA <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('tauxTVA',$taxes,null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'categorie1', 'data-parsley-id'=>'9303']) !!}

                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
            </div>
        </div>


    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">


            {!! Form::submit('Ajouter',['class'=>'btn btn-primary pull-right block ']) !!}
            <a href="{{ url('/produit') }}"  class="btn btn-default " >Annuler</a>

            @if($errors->any())

                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        {!! Form::close() !!}



    </div>





@endsection
