<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/accueil') }}" class="site_title"><i class="fa fa-car"></i> <span>VenteEmbarquée</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{!! URL::asset('assets/images/img.jpg') !!}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>BienVenu,</span>
                <h2>
                    {{ Auth::user()->nom }}
                    {{ Auth::user()->prenom }}
                </h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ url('accueil') }}">
                            <i class="fa fa-home"></i>
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-user"></i>
                            Administration
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu" style="display: none">
                            <li>
                                <a href="{{ url('employes') }}">Employé</a>
                            </li>
                            <li>
                                <a href="{{ url('vehicule') }}">Véhicule</a>
                            </li>
                            <li>
                                <a href="{{ url('produit') }}">Produit</a>
                            </li>
                            <li>
                                <a href="{{ url('secteur') }}">Secteur</a>
                            </li>
                            <li>
                                <a href="{{ url('comptes') }}">Compte Utilisateur</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('client') }}">
                            <i class="fa fa-user"></i>
                            Client
                            <span class="fa fa-chevron-down"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('commande') }}">
                            <i class="fa fa-shopping-cart"></i>
                                Commande
                            <span class="fa fa-chevron-down"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('livraisons') }}">
                            <i class="fa fa-truck"></i>
                            Livraison
                            <span class="fa fa-chevron-down"></span>
                        </a>
                    </li>
                    <li>
                        <a >
                            <i class="fa fa-database"></i>
                            <span class="fa fa-chevron-down"></span>
                            Tournée
                        </a>
                        <ul class="nav child_menu" style="display: none">
                            <li>
                                <a href="{{ url('tournes') }}">Generer Tournées</a>
                            </li>
                            <li>
                                <a href="{{ url('planifierTournees') }}">Planification Tournées</a>
                            </li>
                            <li>
                                <a href="{{ url('suiviTournees') }}">Suivi Des Tournées</a>
                            </li>

                            <li>
                                <a href="{{ url('suiviTournee') }}">Suivi D'une Tournée</a>
                            </li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-file-text"></i> Configuration </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>