@extends('layout.template')

@section('contenu')
    <h1 class="header-page">Ajout d'un Secteur</h1>
    <div class="x_content">
        <br>
        {!! Form::open(['method'=>'POST','action' => ['SecteurController@insererSecteur'], 'class'=>'form-horizontal form-label-left']) !!}


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nom Secteur <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('nomSecteur',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>'nomSecteur', 'required'=>'required']) !!}
                @if($errors->has('nomSecteur'))
                    <span class="help-block" style="color:red">{{$errors->first('nomSecteur')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Wilaya <span class="required">*</span>
            </label>
            <div  class="col-md-6 col-sm-6 col-xs-12">

                <select name="wilaya" class="form-control col-md-7 col-xs-12" onchange='getCommunes(this.value,{{$communes}})'>
                        <option value="" name="wilaya0" disabled="true" selected> Selectionner la wilaya </option>
                        @foreach($wilayas as $wilaya)
                             <option value={{$wilaya->id}}> {{$wilaya->id}} - {{$wilaya->wilaya}} </option>
                        @endforeach
                </select>
                @if($errors->has('wilaya'))
                    <span class="help-block" style="color:red">{{$errors->first('wilaya')}}</span>
                @endif
                <ul class="parsley-errors-list" id="parsley-id-8525"></ul>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Communes
            </label>
            <div  class="form-control col-md-7 col-xs-12" style="overflow:auto; width: 48.5%; height: 0; padding-bottom: 20%; margin-bottom: 20px; margin-left: 10px; background-color:#eee; border: 1px solid #888; border-radius:3px;" id="liste_commune">

            </div>
        </div>


        <div class="form-group" id="test">

        </div>


        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-7 col-sm-offset-7 col-xs-offset-7 ">
                <a class="btn btn-primary" href="/secteur">Annuler</a>
                <button type="submit"  class="btn btn-success">Valider</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>


    <script type="text/javascript">

        function getCommunes($id,$communes)
        {
            $liste="";

            for(var j=0 in $communes)
            {
                if($communes[j].idwilaya == $id)
                {
                    $liste=$liste+"<div class='checkbox'><label><input type='checkbox' class='tableflat' value='"+$communes[j].id+"' name='name"+$communes[j].id+"'>"+$communes[j].nomcommune+"</label></div>";
                }
            }

            document.getElementById("liste_commune").innerHTML=$liste;
        }

    </script>

@endsection
