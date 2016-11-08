@extends('app')

<Script language='javascript'>

    function CalculerMontantTTC()
    {
        if (isNaN(idhortax.value) == true)
        {
            alert('Merci de saisir un montant correct. Calcul impossible.');
            idhortax.value = '0';
        }
        else
        {
        idtva.value = (idhortax.value - '{{$produits->PrixAchatAppliquee}}') ,
            idttc.value = (Number(idhortax.value) *'{{$taux->taux}}')/100,
            idvaleur.value =(( Number(idhortax.value) - '{{$produits->PrixAchatAppliquee}}')/'{{$produits->PrixAchatAppliquee}}')*100;
        }
    }


</Script>
@section('content')

    <h1 class="header-page">Ajouter Prix</h1>



        <br>




    <h2>nom du produit : {{$produits->Designation}}</h2>







        <div>
    {!! Form::open(['url' => 'prix', 'class'=>'form-horizontal form-label-left']) !!}













                   {{Form::hidden ('idProduit',$produits->id,null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>"idgh" ])}}



    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Prix HT<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12"  >

       {{-- <input type='text' class="form-control col-md-7 col-xs-12" id="idhortax"  Name='ht' onkeyup='CalculerMontantTTC();' Value='0'  >--}}
            {{Form::text('PrixHT',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>"idhortax" ,'onkeyup'=>'CalculerMontantTTC();','Value'=>'0'])}}
        </div>
        </div>
         <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Taux<span class="required">*</span>
             </label>
        <div class="col-md-6 col-sm-6 col-xs-12"  >
        {{--<input type ='text' class="form-control col-md-7 col-xs-12" id="idtva" Name='tva' disabled>--}}
            {{Form::text('marge',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>"idtva" ])}}
        </div>
             </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Prix TTC<span class="required">*</span>
                </label>
        <div class="col-md-6 col-sm-6 col-xs-12"  >
        {{--<input type ='text' id="idttc" class="form-control col-md-7 col-xs-12" Name='ttc' disabled>--}}
            {{Form::text('PrixTTC',null,['class'=>'form-control col-md-7 col-xs-12', 'id'=>"idttc" ])}}

            </div>
                </div>



            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Valeur %<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="div2" >
                {{Form::text('margeValeur',null,['class'=>'form-control col-md-7 col-xs-12' ,'id'=>'idvaleur' ])}}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Début Promo<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"  >

                    {{-- <input type='text' class="form-control col-md-7 col-xs-12" id="idhortax"  Name='ht' onkeyup='CalculerMontantTTC();' Value='0'  >--}}
                    {{Form::date('DateDebutPromo', \Carbon\Carbon::now()),['class'=>'form-control col-md-7 col-xs-12' ]}}

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Fin Promo<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"  >

                    {{-- <input type='text' class="form-control col-md-7 col-xs-12" id="idhortax"  Name='ht' onkeyup='CalculerMontantTTC();' Value='0'  >--}}
                    {{Form::date('DateFinPromo',\Carbon\Carbon::now()),['class'=>'form-control col-md-7 col-xs-12' ]}}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomAgent">Activer<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"  >


                    {{--{{Form::radio('Etat', '1')}} Oui
                    {{Form::radio('Etat','0')}} Non--}}
                </div>
            </div>
            <div id="gender" class="btn-group col-lg-offset-3" data-toggle="buttons">
                <label class="btn btn-default parsley-success active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    {{Form::radio('Etat', '1',true)}} &nbsp; Actif &nbsp;
                </label>
                <ul class="parsley-errors-list" id="parsley-id-multiple-gender"></ul>
                <label class="btn btn-default parsley-success " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    {{Form::radio('Etat','0')}} Inactif
                </label>
            </div>



    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">



            {!! Form::submit('Ajouter',['class'=>'btn btn-primary pull-right block ', 'id'=>'ajouter_btn']) !!}
            {!! Form::reset('Cancel',['class'=>'btn btn-default ']) !!}



        </div>
        {!! Form::close() !!}
        </div>



    </div>









    @if($errors->any())

        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif


    <script>
        var myInput = document.getElementById("input"),
                myDiv = document.getElementById("div"),
                myDiv2 = document.getElementById("div2"),
                 third = document.getElementById("tva") ;
        myInput.onkeyup= function calcUSD() {

            var second = myInput.value * 0.17;
            myDiv.innerHTML = second ;



            myDiv2.innerHTML =myInput.value * second;

            }

        $("#ajouter_btn").click(function () {

        var myInput= document.getElementById("input").value;
        var myDiv = document.getElementById("div").value;
        var myDiv2 = document.getElementById("div2").value;

        })

          </script>





























@endsection