@extends('layout.template')

@section('contenu')
    <h1 class="header-page">Ajout d'un Client</h1>
    <div class="x_content">
        <br>

        {!! Form::open(['method'=>'POST','action' => ['ListeClientController@postajouterClient'], 'class'=>'form-horizontal form-label-left']) !!}


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Nom Client <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('nomClient',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'nom-client', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}

                @if($errors->has('nomClient'))
                    <span class="help-block" style="color:red">{{$errors->first('nomClient')}}</span>
                @endif

                <ul class="parsley-errors-list" id="parsley-id-9303"></ul>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Prénom Client<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('prenomClient',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'prenomClient', 'data-parsley-id'=>'8525', 'required'=>'required']) !!}
                @if($errors->has('prenomClient'))
                    <span class="help-block" style="color:red">{{$errors->first('prenomClient')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
            </div>
        </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Segement <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('segement',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'segment', 'data-parsley-id'=>'9303', 'required'=>'required', ]) !!}
                @if($errors->has('segement'))
                    <span class="help-block" style="color:red">{{$errors->first('segement')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul> </div>
        </div>
        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::email('email',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'email', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                @if($errors->has('email'))
                    <span class="help-block" style="color:red">{{$errors->first('email')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
        </div>
        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">telephone <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('telephone',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'telephone', 'data-parsley-id'=>'9303', 'required'=>'required','onkeypress'=> 'validate(event)' ]) !!}
                @if($errors->has('telephone'))
                    <span class="help-block" style="color:red">{{$errors->first('telephone')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
        </div>

        <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nom Societé <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('societe',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'societe', 'data-parsley-id'=>'9303', 'required'=>'required']) !!}
                @if($errors->has('societe'))
                    <span class="help-block" style="color:red">{{$errors->first('societe')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
        </div>
        <!--
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Ajout <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input  class='form-control col-md-7 col-xs-12' type="date" name="dateAjout"  step="1" id="dateAjout" required="required" >
                @if($errors->has('dateAjout'))
                    <span class="help-block" style="color:red">{{$errors->first('dateAjout')}}</span>
                @endif

                <ul class="parsley-errors-list" id="parsley-id-9303"></ul></div>
        </div>
        -->

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-7 col-sm-offset-7 col-xs-offset-7 ">
            <a class="btn btn-primary" href="/client">Annuler</a>
            <button type="submit" class="btn btn-success">Valider</button>
        </div>
    </div>

    {!! Form::close() !!}
    </div>
@endsection