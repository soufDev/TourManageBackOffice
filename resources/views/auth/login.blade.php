@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Authentification</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('identifiant') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Identifiant</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="identifiant" value="{{ old('identifiant') }}">

                                @if ($errors->has('identifiant'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identifiant') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Mot de Passe</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-btn fa-sign-in"></i>Connexion
                                    </button>
                                    <label class="col-lg-offset-1 col-md-offset-1 col-xs-offset-1">
                                        <input type="checkbox" name="remember"> Se Souvenir de moi
                                    </label>
                                </div>

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
