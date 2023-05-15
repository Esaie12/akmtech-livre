<!DOCTYPE html>
<html lang="fr">

<head>
    @include('includes.meta')

    <title>PlumLivre - @yield('titre')</title>

    @include('includes.link.cssLink')

    @yield('codeCSS')

</head>

<body class="layout-h">
    <div class="wrapper">
        <!-- top navbar-->
        <header class="topnavbar-wrapper">

            @include('layout.user.header')

        </header>

        <div style="min-height: 800px" >
            @yield('contenu')
        </div>


        <!--div class="section-container">

            <div class="content-wrapper">

                yield('contenu')

            </div>
        </div-->

        <footer>
            <!--span>&copy; 2019 - MDAngle</span-->
            <div class="row pt-3" style="background-color: orange" >

                <div class="col-md-3 mb-3">
                    <img class="img-fluid" src="{{asset('asset_user/logo.png')}}" style="height: 70px; max-width: 100%; ">
                </div>
                <div class="col-md-4 mb-3">
                    <ul class="nav" >
                        <li class="mr-2" >
                            <a style="color: white" href="{{route('admin.home')}}">Administration</a>
                        </li>
                        <li class="mr-2" >
                            <a style="color: white" href="{{route('bibliotheque')}}">Bibliothèque</a>
                        </li>
                        <li class="mr-2" >
                            <a style="color: white" href="{{route('tarif')}}">Tarifs</a>
                        </li>
                    </ul>

                </div>
                <div class="col-md-4 mb-3 col-12 text-center">
                    <div class="btn-group">
                        <a href="" class="btn ">
                            <img width="30px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhOJXK9LBIJW27NHXjAtj8mmyQaXGeF2AZTA&usqp=CAU" alt="">
                        </a>
                        <a href="" class="btn btn-link">
                            <img  width="30px" src="data:image/png;base64,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" alt="">
                        </a>
                        <a href="" class="btn btn-link">
                            <img width="30px" src="data:image/png;base64,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" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- =============== VENDOR SCRIPTS ===============-->

    @include('includes.link.jsLink')

    @yield('codeJS')

    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <!-- SPARKLINE-->
    <script src="vendor/jquery-sparkline/jquery.sparkline.js"></script><!-- FLOT CHART-->
    <script src="vendor/flot/jquery.flot.js"></script>
    <script src="vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.js"></script>
    <script src="vendor/flot/jquery.flot.resize.js"></script>
    <script src="vendor/flot/jquery.flot.pie.js"></script>
    <script src="vendor/flot/jquery.flot.time.js"></script>
    <script src="vendor/flot/jquery.flot.categories.js"></script>
    <script src="vendor/jquery.flot.spline/jquery.flot.spline.js"></script><!-- EASY PIE CHART-->
    <script src="vendor/easy-pie-chart/dist/jquery.easypiechart.js"></script><!-- MOMENT JS-->
    <script src="vendor/moment/min/moment-with-locales.js"></script><!-- =============== APP SCRIPTS ===============-->
    <script src="js/app.js"></script>

    <script src="https://cdn.kkiapay.me/k.js"></script>
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

</body>


</html>
