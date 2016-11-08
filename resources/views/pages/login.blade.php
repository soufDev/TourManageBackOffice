<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('include.head')
    <title>Vente Embarquée</title>

</head>

<body style="background:#F7F7F7;">

<div class="">

    <div id="wrapper" ng-app="myApp">
        <div id="login" class="animate form" ng-controller="loginController">
            <div class="login_content">
                <form name="loginForm" ng-submit="doLogin('loginForm')">
                    <h1>Authentification</h1>
                    <div>
                        <input type="text" name="identifiant" ng-model="login.username" required placeholder="Identifiant" class="form-control">
                    </div>
                    <div>
                        <input type="password" name="password" ng-model="login.password" required placeholder="Mot de Passe" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" value="Connexion" name="save" ng-click="doLogin()" >
                        <a class="reset_pass" href="#">Mot de Passe Oublié</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-car" style="font-size: 26px;"></i>Vente Embarquée</h1>
                        </div>
                    </div>
                </form>

                <!-- form -->
            </div>
            <!-- content -->
        </div>
    </div>
</div>

<script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
<script src="<?= asset('app/lib/angular/angular-route.min.js') ?>"></script>
<script src="<?= asset('app/lib/angular/angular-md5.js') ?>"></script>

<script text="text/javascript" src="{{asset('app/app.js')}}"></script>
<script text="text/javascript" src="{{asset('app/controllers/loginController.js')}}"></script>
</body>

</html>