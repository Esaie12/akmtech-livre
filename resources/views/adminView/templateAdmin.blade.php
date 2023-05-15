<!DOCTYPE html>
<html lang="fr">

<head>
    @include('includes.meta')

    <title>@yield('titre')</title>

    @include('includes.link.cssLink')

    @yield('codeCSS')

</head>

<body class="layout-fixed">
    <div class="wrapper">
        <!-- top navbar-->
        <header class="topnavbar-wrapper">
            <!-- START Top Navbar-->
            @include('layout.admin.header')
            <!-- END Top Navbar-->
        </header>

        <!-- sidebar-->
        <aside class="aside-container">
            <!-- START Sidebar (left)-->
            <div class="aside-inner">

                @include('includes.menu.adminMenu')

            </div>
            <!-- END Sidebar (left)-->
        </aside>
        <!-- offsidebar-->
        <aside class="offsidebar d-none">
            <!-- START Off Sidebar (right)-->
            <nav>
                <div role="tabpanel">
                </div>
            </nav>
            <!-- END Off Sidebar (right)-->
        </aside>

        <!-- Main section-->
        <div class="section-container">
            <!-- Page content-->
            <div class="content-wrapper">
                @yield('contenu')
            </div>
        </div>

        <!-- Page footer-->
        <footer class="footer-container"><span>&copy; 2019 - MDAngle</span></footer>
    </div>

    @include('includes.link.jsLink')

    @yield('codeJS')

</body>


<!-- Mirrored from themicon.co/theme/mdangle/v1.0/static-html/app/welcome.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Nov 2020 09:29:14 GMT -->

</html>
