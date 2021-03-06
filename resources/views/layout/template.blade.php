<!DOCTYPE html>
<html lang="fr" >

<head>
    <title>Vente Embarquée</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" content="{ { csrf_token() } }">


    <!-- Bootstrap core CSS -->


    {!! Html::style('assets/css/bootstrap.min.css') !!}
{!! Html::style('assets/fonts/css/font-awesome.min.css') !!}
{!! Html::style('assets/css/animate.min.css') !!}
{!! Html::style('assets/css/custom.css') !!}
{!! Html::style('assets/css/maps/jquery-jvectormap-2.0.1.css') !!}
{!! Html::style('assets/css/icheck/flat/green.css') !!}
{!! Html::style('assets/css/floatexamples.css') !!}
{!! Html::style('assets/css/datatables/tools/css/datatables.tableTools.css') !!}

{!! Html::script('assets/js/jquery.min.js') !!}

{!! Html::style('assets/style.css') !!}

<!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>

    {!! Html::script('assets/js/nprogress.js') !!}
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    {!! Html::script('assets/js/bootstrap.min.js') !!}

            <!-- gauge js -->
    {!! Html::script('assets/js/gauge/gauge.min.js') !!}
    {!! Html::script('assets/js/gauge/gauge_demo.js') !!}
            <!-- chart js -->
    {!! Html::script('assets/js/chartjs/chart.min.js') !!}
            <!-- bootstrap progress js -->
    {!! Html::script('assets/js/progressbar/bootstrap-progressbar.min.js') !!}
    {!! Html::script('assets/js/nicescroll/jquery.nicescroll.min.js') !!}
            <!-- icheck -->
    {!! Html::script('assets/js/icheck/icheck.min.js') !!}
            <!-- daterangepicker -->
    {!! Html::script('assets/js/moment.min.js') !!}
    {!! Html::script('assets/js/datepicker/daterangepicker.js') !!}


    {!! Html::script('assets/js/custom.js') !!}
            <!-- flot js -->
    <!--[if lte IE 8]>
    {!! Html::script('assets/js/excanvas.min.js') !!}
    <![endif]-->
    {!! Html::script('assets/js/flot/jquery.flot.js') !!}
    {!! Html::script('assets/js/flot/jquery.flot.pie.js') !!}
    {!! Html::script('assets/js/flot/jquery.flot.orderBars.js') !!}
    {!! Html::script('assets/js/flot/jquery.flot.time.min.js') !!}
    {!! Html::script('assets/js/flot/date.js') !!}
    {!! Html::script('assets/js/flot/jquery.flot.spline.js') !!}
    {!! Html::script('assets/js/flot/jquery.flot.stack.js') !!}
    {!! Html::script('assets/js/flot/curvedLines.js') !!}
    {!! Html::script('assets/js/flot/jquery.flot.resize.js') !!}
    {!! Html::script('assets/js/jquery-1.12.1.min.js') !!}
    {!! Html::script('assets/js/script.js') !!}


    <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>

</head>


<body class="nav-md">

<div class="container body">

    <div class="main_container">

        @include('include.sidebar')

                <!-- top navigation -->
        @include('include.top-navigation')
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col">
            @yield('contenu')
        </div>
        <!-- /page content -->

    </div>

</div>

<!-- AngularJS Application Scripts -->
<script src="<?= asset('app/app.js') ?>"></script>
</body>

</html>
