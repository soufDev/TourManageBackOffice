@extends('app')

@section('content')

    <?php $ref=""; ?>
    <div class="ajouer_commande_page">
        <h1 class="header-page">
            Création Commande
        </h1>
        {!! Form::open(['method'=>'PATCH','action' => ['GestionCommandeController@insertion',$newCommande->id]]) !!}
        <div role="form" class="form-horizontal col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
            <div class="form-group col-lg-10 col-md-10 col-xs-12 col-sm-10">
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="Edit-numCommande" >N° Commande</label>
                    {!! Form::text('numCommande', $newCommande->id, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'placeholder' => 'N° Commande', 'id'=>'Edit-numCommande']) !!}
                </div>

                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="nomClient">Client</label>
                    <select name="client" class="form-control col-xs-12 col-lg-4 col-md-4">
                        <option value="" name="client0" disabled="true" selected> Selectionner un Client ... </option>
                        @foreach($clients as $client)
                            <option value={{$client->id}}> {{$client->Nom}} {{$client->Prenom}} </option>
                        @endforeach
                    </select>
                    @if($errors->has('client'))
                        <span class="help-block" style="color:red">{{$errors->first('client')}}</span>
                    @endif
                    <ul class="parsley-errors-list" id="parsley-id-8525"></ul>


                </div>
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="date-creation">Date de Creation</label>
                    <input  class='form-control col-md-7 col-xs-12' type="date" name="dateAjout"  step="1" id="dateAjout" required="required" value="{{$newCommande->DateCreation}}" >
                </div>
                <div class="col-md-5 col-xs-12 col-lg-5">
                    <label for="status">Status</label>
                    {!! Form::select('statut', ['En Cours'=>'En Cours','Livré'=>'Livré','Livré partiellement'=>'Livré partiellement','Annuler'=>'Annuler'], null, ['class' => 'form-control col-xs-12 col-lg-4 col-md-4', 'id'=>'status']) !!}
                </div>
            </div>
        </div>
        <a data-target="#AjouterProduitModal" class="btn btn-dark btn-lg col-xs-12 col-sm-4 col-md-4 col-lg-2" id="openBtn" data-toggle="modal">
            <i class="fa fa-plus-circle" style="align-content: center"></i>
            Ajouter Produit
        </a>

        <div class="table-responsive col-lg-12">
            <table id="example" class="table table-striped responsive-utilities jambo_table" >
                <thead style="text-align: center">
                <tr class="headings">
                    <th>Réference</th>
                    <th>Désignation</th>
                    <th>Montant U.HT</th>
                    <th>Taux Remise</th>
                    <th>Montant U Remise HT</th>
                    <th>Quantité cmd</th>
                    <th>Montant T Remise HT</th>
                    <th>Montant T.HT</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                <tbody >

                @foreach($lignes as $ligne)
                    <tr>
                        <td id="idLigne" hidden>{{$ligne->id}}</td>
                        <td id="reference">{{ DB::table('produit')->where('id','=',$ligne->idProduit)->first()->reference }}</td>
                        <td id="designation">{{ DB::table('produit')->where('id','=',$ligne->idProduit)->first()->Designation }}</td>
                        <td id="montant-u-ht">{{ DB::table('prix')->where('idProduit','=',$ligne->idProduit)->first()->PrixHT }}</td>
                        <td id="taux-remise">{{$ligne->tauxRemise}}%</td>
                        <td id="montant-u-remise-ht">{{(DB::table('prix')->where('idProduit','=',$ligne->idProduit)->first()->PrixHT - $ligne->PrixHT)*(-1)}}</td>
                        <td id="cmd-quantite">{{$ligne->QuantiteCmd}}</td>
                        <td id="montant-t-remise-ht">{{((DB::table('prix')->where('idProduit','=',$ligne->idProduit)->first()->PrixHT - $ligne->PrixHT)*(-1))*$ligne->QuantiteCmd}}</td>
                        <td id="montant-t-ht">{{ $ligne->totalPrixHT}}</td>
                        <td id="" style="text-align: center">
                            <a href="" data-target="#modifier_produit_modal" class="modifier" id="openBtn" data-toggle="modal">
                                <i class="fa fa-pencil-square-o" style="color:#26B99A ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                        <td id="supprimer" style="text-align: center">
                            <a href="#DeleteModal" data-toggle="modal" class="use-address delete" >
                                <i class="fa fa-times" style="color:#ff2918 ;font-size: 1.5em; align-content: center"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <br><br>

        <div class="form-inline form-group col-lg-10 col-lg-offset-1">
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="total-remise" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">Total Remise</label>
                <input type='numbre' step='0.1' class="form-control" id="total-remise" name="total-remise" value="{{DB::table('lignecommande')->where('idCommande','=',$newCommande->id)->sum('montantRemise')}}" readonly>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="total-ht" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">Total HT</label>
                <input type="text" class="form-control" id="total-ht" name="total-ht" value="{{DB::table('lignecommande')->where('idCommande','=',$newCommande->id)->sum('totalPrixHT')}}" readonly>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="tva" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">TVA</label>
                <input type="text" class="form-control" id="tva" name="tva" value="{{$tva}}" readonly>
            </div>
            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <label for="total-ttc" class="control-label col-lg-7 col-md-7 col-sm-7 col-xs-12">Total TTC</label>
                <input type="text" class="form-control" id="total-ttc"  name="total-ttc" value="{{$ttc}}" readonly>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="form-group ">
            <div class="col-md-10 col-xs-12 col-lg-10 col-lg-offset-8">
                <a href="{{ url('/commande/annuler/'.$newCommande->id) }}" class="btn btn-danger btn-lg col-xs-12 col-md-4 col-lg-2 btn-ajouter-produit"> Annuler</a>
                {!! Form::submit('valider', ['class' => 'btn btn-success btn-lg col-xs-12 col-md-4 col-lg-2 btn-ajouter-produit', 'id'=>'valider']) !!}
             </div>
        </div>

        {!! Form::close() !!}



                <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Confirmation</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="name">Voulez-Vous Vraiment Supprimer Ce Produit ? </b></div>
                    </div>
                    <div class="modal-footer" id="modal-footer-delete">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Not Found Modal -->
        <div class="modal fade" id="NotFoundModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title">Produit Introuvable</h3>
                    </div>
                    <div class="modal-body">
                        <div ><b id="name">Le Produit est introuvable ! </b></div>
                    </div>
                    <div class="modal-footer" id="modal-footer-delete">
                        <a href='' class='btn btn-default' data-dismiss='modal'>Ok</a>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade" name="AjouterProduitModal" tabindex="-1" id="AjouterProduitModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Ajouter Produit</h3>
                    </div>
                    <div class="modal-body"  id="formulaire">
                        <form method='POST' action='/commande/ajouter/{{$newCommande->id}}'>
                            <input name='_token' type='hidden' value='{{ csrf_token() }}'>
                            <div class='form-group col-lg-6'>
                                <label for='reference' class='control-label'>Reference <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='reference' name='reference' placeholder='Reference' onchange='test(this.value)' required='required' autocomplete='off'>
                                </div>
                            <div class='form-group col-lg-6'>
                                <label for='code-tva' class='control-label'>Code TVA <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='code-tva' name='code-tva' placeholder='Code TVA' readonly>
                                </div><div class='from-group col-lg-6'><label for='quantite-cmd' class='control-label'>Quantité Cmd <span class='required'>*</span></label>
                                <input type='text' class='form-control'  id='quantite-cmd' name='quantite-cmd' placeholder='Quantité Commandée' onkeyup='GetTotal(this.value)' onchange='GetTotal(this.value)' required='required' autocomplete='off'>
                                </div>
                            <div class='form-group col-lg-6'>
                                <label for='prix-u-ht' class='control-label'>Prix U.HT : <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='prix-u-ht' name='prix-u-ht' placeholder='Prix U.HT' readonly>
                                </div>
                            <br>
                            <div class='form-group col-lg-6'>
                                <label for='taux-remise' class='control-label'>Taux Remise % <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='taux-remise' name='taux-remise' placeholder='Taux Remise'  onkeyup='GetRemise(this.value)' onchange='GetRemise(this.value)' autocomplete='off'>
                                </div>
                            <div class='form-group col-lg-6'>
                                <label for='prix-u-ttc' class='form-label'>Prix U.TTC <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='prix-u-ttc' name='prix-u-ttc' placeholder='Prix U.TTC' readonly>
                                </div>

                            <div class='form-group col-lg-6'>
                                <label for='montant-u-remise' class='form-label'>Montant U.Remise <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='montant-u-remise' name='montant-u-remise' placeholder='Montant U.Remise' readonly>
                                </div>

                            <div class='form-group col-lg-6'>
                                <label for='prix-t-ttc' class='form-label'>Prix T.TTC <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='prix-t-ttc' name='prix-t-ttc' placeholder='Prix T.TTC' readonly>
                                </div>

                            <div class='form-group col-lg-6'>
                                <label for='montant-t-remise' class='form-label'>Montant T.Remise <span class='required'>*</span></label>
                                <input type='numbre' step='0.1' class='form-control' name='montant-t-remise' id='montant-t-remise' placeholder='Montant T.Remise' readonly>
                                </div>

                            <div class='form-group col-lg-6'>
                                <label for='montant-marge' class='form-label'>Montant Marge <span class='required'>*</span></label>
                                <input type='text' class='form-control' id='montant-marge' name='montant-marge'  placeholder='Montant Marge' readonly>
                                </div>
                            <div class='group-form pull-right'>
                                <a href='' class='btn btn-default' data-dismiss='modal'>Annuler</a>
                                <button type='submit' id='ajouter' class='btn btn-primary'>Ajouter</button>
                                </div></form>


                    </div>

                </div>
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="modifier_produit_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Ajouter Produit</h3>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url'=>'', 'class'=>'form-group']) !!}
                        <div class="form-group col-lg-6">
                            <label for="reference" class="control-label">Reference</label>
                            <input type="text" class="form-control" id="reference" name="reference">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="designation" class="control-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation">
                        </div>

                        <div class="from-group col-lg-6">
                            <label for="montant-u-ht" class="control-label">Montant U.HT</label>
                            <input type="text" class="form-control" id="montant-u-ht" name="montant-u-ht">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="taux-remise" class="control-label">Taux Remise</label>
                            <input type="text" class="form-control" id="taux-remise" name="taux-remise">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="taux-u-remise-ht" class="control-label">Taux U Remise HT</label>
                            <input type="text" class="form-control" id="taux-u-remise-ht" name="taux-u-remise-ht">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="quantite-cmd" class="form-label">Quantité Cmd</label>
                            <input type="text" class="form-control" id="quantite-cmd" name="quantite-cmd">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="montant-t-remise-ht" class="form-label">Montant T.Remise HT</label>
                            <input type="text" class="form-control" id="montant-t-remise-ht" name="montant-t-remise-ht">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="montant-t-ht" class="form-label">Montant T.HT</label>
                            <input type="text" class="form-control" id="montant-t-ht" name="montant-t-ht" >
                        </div>

                        <div class="group-form pull-right">
                            <button type="submit" id="ajouter" class="btn btn-primary">Modifier</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">Annuler</a>
                        </div>
                        {!! Form::close() !!}


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div hidden>

           <div id="prixHT"></div>
           <div id="produit_tva"></div>
           <div id="prixTTC" ></div>

    </div>
    {!! Html::script('assets/js/datatables/js/jquery.dataTables.js') !!}
    {!! Html::script('assets/js/datatables/tools/js/dataTables.tableTools.js') !!}
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}

    <script type="text/javascript">



        $(".modifier").click(function () {
            var item = $(this).parent().parent(),
                    reference = item.find("#reference").text(),
                    designation = item.find("#designation").text(),
                    montant_u_ht = item.find("#montant-u-ht").text(),
                    taux_remise = item.find("#taux-remise").text(),
                    cmd_quantite = item.find("#cmd-quantite").text(),
                    montant_t_remise_ht = item.find("#montant-t-remise-ht").text(),
                    montant_t_ht = item.find("#montant-t-ht").text(),
                    montant_u_remise_ht = item.find("#montant-u-remise-ht").text(),

                    modal = $('#modifier_produit_modal').find('.modal-body');
                    modal.find('#reference').val(reference);
                    modal.find('#designation').val(designation);
                    modal.find('#montant-u-ht').val(montant_u_ht);
                    modal.find('#taux-remise').val(taux_remise);
                    modal.find('#quantite-cmd').val(cmd_quantite);
                    modal.find('#montant-t-ht').val(montant_t_ht);
                    modal.find('#montant-u-remise-ht').val(montant_t_remise_ht);
                    modal.find('#montant-t-remise-ht').val(montant_u_remise_ht);
        });

        //**********id client***********//
        $(document).ready(function()
        {
            $('#Edit-pseudo').keyup(function()
            {
                searchTable_withID($(this).val());
            });
        });


        $(".delete").click(function () {
            var item = $(this).parent().parent(),
                    id = item.find("#idLigne").text();
            document.getElementById("modal-footer-delete").innerHTML =
                    '<form method="POST" action="/commande/ajouter/supprimer/'+id+'">'+
                    '<input name="_token" type="hidden" value="{{ csrf_token() }}"'+
                    '<div>'+
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>'+
                    '<button type="submit" class="btn btn-primary">Valider</button>'+
                    '</div> </form>';
        });

        function searchTable_withID(inputVal)
        {
            var table = $('#example');
            table.find('tr').each(function(index, row)
            {
                var allCells = $(row).find('td#pseudo');
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
            $('#Edit-nomAgent').keyup(function()
            {
                searchTable_withName($(this).val());
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


        function test($val)
        {
            $("#taux-remise").val('0');
            $("#prix-u-ttc").val('');
            $("#code-tva").val('');
            $("#prix-u-ht").val('');
            $("#prix-u-ttc").val('');
            $("#prix-t-ttc").val('');
            $("#montant-u-remise").val('0');
            $("#montant-t-remise").val('0');



            $.get("/produitInfo?ID="+$val, function(res,stat){

                if(res != '')
                {
                    GetTVA(res[0].tauxTVA);
                    GetPrix(res[0].id);

                }
                else
                {
                    alert("La référence de produit n'exite pas");
                }
            });
        }

        function GetTVA($id)
        {

            $.get("/tvaInfo?ID="+$id, function(res,stat){

                if(res != '')
                {
                    $("#code-tva").val(res[0].libelle);
                    document.getElementById('produit_tva').innerHTML=res[0].taux * 0.01;
                }
                else
                {
                    alert("La référence de produit"+$id+"n'exite pas");
                }
            });
        }

        function GetPrix($id)
        {

            $.get("/prixInfo?ID="+$id, function(res,stat){

                if(res != '')
                {
                    $("#prix-u-ht").val(res[0].PrixHT);
                    $("#prix-u-ttc").val(res[0].PrixTTC);
                    document.getElementById("prixHT").innerHTML=res[0].PrixHT;
                    document.getElementById("prixTTC").innerHTML=res[0].PrixTTC;
                }
                else
                {
                    alert("La référence de produit n'exite pas"+$id);
                }
            });
        }

        function GetTotal($qmd)
        {
            var puht = document.getElementById('prixHT').textContent;
            var remise= document.getElementById('taux-remise').value;
            var puhtr = 0;
            var mur = 0;
            var mtr = 0;
            var puttcr=0;
            var ptttcr=0;

            if(remise!=0) {
                mur = puht * remise * 0.01;
                puhtr = puht - mur;
                mtr = mur * $qmd;
                puttcr = puhtr * (1 + document.getElementById("produit_tva").textContent);
                ptttcr = puttcr * $qmd;
                $("#montant-u-remise").val(mur);
                $("#montant-t-remise").val(mtr);
                $("#prix-u-ht").val(puhtr);
                $("#prix-u-ttc").val(puttcr);
                $("#prix-t-ttc").val(ptttcr);
            }
            else
            {
                $("#prix-u-ht").val(puht);
                $("#prix-u-ttc").val(document.getElementById("prixTTC").textContent);
                $("#prix-t-ttc").val(document.getElementById("prixTTC").textContent * $qmd);
            }

        }



        function GetRemise($value) {

            var puht = document.getElementById('prixHT').textContent;
            var qmd= document.getElementById('quantite-cmd').value;
            var puhtr = 0;
            var mur = 0;
            var mtr = 0;
            var puttcr=0;
            var ptttcr=0;
            var tva =0;


            if($value!=0) {
                mur = puht * $value * 0.01;
                puhtr = puht - mur;
                tva=puhtr*document.getElementById('produit_tva').textContent;
                mtr = mur * qmd;
                puttcr = puhtr +tva;
                ptttcr = puttcr * qmd;
                $("#montant-u-remise").val(mur);
                $("#montant-t-remise").val(mtr);
                $("#prix-u-ht").val(puhtr);
                $("#prix-u-ttc").val(puttcr);
                $("#prix-t-ttc").val(ptttcr);
            }
            else
            {
                $("#prix-u-ht").val(puht);
                $("#prix-u-ttc").val(document.getElementById("prixTTC").textContent);
                $("#prix-t-ttc").val(document.getElementById("prixTTC").textContent * qmd);
                $("#montant-u-remise").val('0');
                $("#montant-t-remise").val('0');

            }
        }

        $(function() {

            $('#Edit-numCommande').autocomplete({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                source: '{{ URL('getdata') }}',
                minLength: 1,

                select: function( event, ui ) {
                    $('#Edit-numCommande').val(ui.item.id);
                }
            });
        });


    </script>
@endsection