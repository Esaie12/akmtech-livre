<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <title>PLUMLIVRE - @yield('titre')</title>

    @include('includes.link.cssLink')

    @yield('codeCSS')

</head>

<body>
    <div class="wrapper">
        <div class="block-center mt-4 wd-xl">
            <!-- START card-->
            <div class="card card-flat">
                <div class="card-header text-center bg-warning">
                    <a href="{{route('welcome')}}">
                        <img class="block-center rounded" src="{{asset('asset_user/logo.png')}}" style="height: 80px; max-width: 100%; " alt="Image">
                    </a>
                </div>
                @yield('contenu')
            </div>

            <div class="p-3 text-center">
                <span class="mr-2">&copy;</span><span>2023</span><span
                    class="mr-2">-</span><span>PLUMLIVRE</span><br><span>By AKM_TECH</span>
            </div>
        </div>
    </div>

    @include('includes.link.jsLink')

    @yield('codeJS')

</body>


</html>
