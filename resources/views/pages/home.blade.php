@extends('app')


@section('content')

    <div class="row parent_home">
        <div class="parent_home_bloc">
            <a href="{{ url('/comptes') }}" class="home_link">
                <div class="col-lg-3 col-xs-8 col-md-4 home_bloc">
                    <i class="fa fa-cogs"></i>
                    <p>Administration</p>
                </div>
            </a>

            <a href="{{ url('/client') }}" class="home_link">
                <div class="col-lg-3 col-xs-8 col-md-4 home_bloc">
                    <i class="fa fa-users"></i>
                    <p>Client</p>
                </div>
            </a>

            <a href="{{ url('/commande') }}" class="home_link">
                <div class="col-lg-3 col-xs-8 col-md-4 home_bloc">
                    <i class="fa fa-shopping-cart"></i>
                    <p>Commande</p>
                </div>
            </a>

            <a href="{{ url('/livraisons') }}" class="home_link">
                <div class="col-lg-3 col-xs-8 col-md-4 home_bloc">

                        <i class="fa fa-truck"></i>
                        <p>Livraison</p>

                </div>
            </a>
            <a href="{{ url('/tournes') }}" class="home_link">
                <div class="col-lg-3 col-xs-8 col-md-4 home_bloc">
                    <i class="fa fa-cab"></i>
                    <p>Tournée</p>
                </div>
            </a>

            <a href="#" class="home_link">
                <div class="col-lg-3 col-xs-8 col-md-4 home_bloc">
                    <i class="fa fa-file-text-o"></i>
                    <p>Configuration</p>
                </div>
            </a>


        </div>

    </div>
    @endsection