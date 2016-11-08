@extends('layout.template')

@section('contenu')
    <h1 class="header-page">Modification d'un Véhicule</h1>
    <div class="x_content">
        <br>
        {!! Form::open(['method'=>'PATCH','action' => ['VehiculeController@SauvegarderModification',$vehicule->id], 'class'=>'form-horizontal form-label-left']) !!}


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Matricule <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('matricule',$vehicule->matricule,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'matricule', 'data-parsley-id'=>'9303', 'required'=>'required', 'onkeypress'=> 'validate(event)', 'maxlength'=>'11']) !!}
                @if($errors->has('matricule'))
                    <span class="help-block" style="color:red">{{$errors->first('matricule')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kilométrage de Début ( Km ) <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('KMDebut',$vehicule->KMDebut,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'KMDebut', 'data-parsley-id'=>'8525', 'required'=>'required', 'onkeypress'=> 'validate(event)']) !!}
                @if($errors->has('KMDebut'))
                    <span class="help-block" style="color:red">{{$errors->first('KMDebut')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
            </div>
        </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Capacité de Stockage ( Kg ) <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('capacite',$vehicule->capaciteStockage,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'capacite', 'data-parsley-id'=>'9303', 'required'=>'required', 'onkeypress'=> 'validate(event)']) !!}
                @if($errors->has('capacite'))
                    <span class="help-block" style="color:red">{{$errors->first('capacite')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
        </div>


        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-7 col-sm-offset-7 col-xs-offset-7 ">
                <a class="btn btn-primary" href="/vehicule">Annuler</a>
                <button type="submit" class="btn btn-success">Sauvegarder</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection