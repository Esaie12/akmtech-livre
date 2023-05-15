<nav class="sidebar" data-sidebar-anyclick-close="">
    <!-- START sidebar nav-->
    <ul class="sidebar-nav">
        <!-- START user info-->
        <!--li class="has-user-block">
            <div class="collapse show" id="user-block">
                <div class="item user-block">

                    <div class="user-block-picture">
                        <div class="user-block-status">
                            <img class="img-thumbnail rounded-circle" src="{{asset('asset_user/img/user/01.jpg')}}"
                                alt="Avatar">
                            <div class="circle bg-success circle-lg"></div>
                        </div>
                    </div>

                    <div class="user-block-info"><span class="user-block-name"><span
                                data-localize="sidebar.WELCOME">Welcome</span>, Jane</span><span
                            class="user-block-role">Designer</span></div>
                </div>
            </div>
        </li-->

        <li class="nav-heading ">
            <span class="nav-text" data-localize="sidebar.heading.HEADER">Main
                Navigation
            </span>
        </li>

        <li class=" active">
            <a class="ripple" href="{{route('admin.home')}}" title="Welcome">
                <em class="icon-tag"></em>
                <span class="nav-text" data-localize="sidebar.nav.WELCOME">Accueil</span>
            </a>
        </li>

        <li class=" active">
            <a class="ripple" href="{{route('admin.categ.index')}}" title="Welcome">
                <em class="icon-tag"></em>
                <span class="nav-text" data-localize="sidebar.nav.WELCOME">Catégorie</span>
            </a>
        </li>

        <li class=" ">
            <a class="ripple" href="#dashboard" title="Dashboard" data-toggle="collapse"><!--span
                    class="float-right badge badge-info">3</span--><em class="icon-speedometer"></em><span
                    class="nav-text" data-localize="sidebar.nav.DASHBOARD">Publications</span></a>

            <ul class="sidebar-nav sidebar-subnav collapse " id="dashboard">
                <li class="sidebar-subnav-header">Publications</li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.pub.index')}}" title="Dashboard v1"><span
                            class="nav-text">Publier</span></a>
                </li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.pub.liste')}}" title="Dashboard v2"><span
                            class="nav-text">Voir la liste</span></a>
                </li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.pub.attente')}}" title="Dashboard v3"><span
                            class="nav-text">En attente</span></a>
                </li>
            </ul>
        </li>

        <li class=" ">
            <a class="ripple" href="#collabo" title="Dashboard" data-toggle="collapse"><!--span
                    class="float-right badge badge-info">3</span--><em class="icon-speedometer"></em><span
                    class="nav-text" data-localize="sidebar.nav.DASHBOARD">Collaborateurs</span></a>

            <ul class="sidebar-nav sidebar-subnav collapse " id="collabo">
                <li class=" ">
                    <a class="ripple" href="{{route('admin.collabo.new')}}" title="Dashboard v1"><span
                            class="nav-text">Ajouter un nouveau</span></a>
                </li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.collabo.liste')}}" title="Dashboard v2"><span
                            class="nav-text">Voir la liste</span></a>
                </li>
            </ul>
        </li>

        <li class=" ">
            <a class="ripple" href="#car" title="Dashboard" data-toggle="collapse"><!--span
                    class="float-right badge badge-info">3</span--><em class="icon-speedometer"></em><span
                    class="nav-text" data-localize="sidebar.nav.DASHBOARD">Carrousel</span></a>

            <ul class="sidebar-nav sidebar-subnav collapse " id="car">
                <li class=" ">
                    <a class="ripple" href="{{route('admin.carrousel.new')}}" title="Dashboard v1"><span
                            class="nav-text">Ajouter un nouveau</span></a>
                </li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.carrousel.liste')}}" title="Dashboard v2"><span
                            class="nav-text">Voir la liste</span></a>
                </li>
            </ul>
        </li>

        <li class=" ">
            <a class="ripple" href="#citation" title="Dashboard" data-toggle="collapse"><!--span
                    class="float-right badge badge-info">3</span--><em class="icon-speedometer"></em><span
                    class="nav-text" data-localize="sidebar.nav.DASHBOARD">Mots et Citations</span></a>

            <ul class="sidebar-nav sidebar-subnav collapse " id="citation">
                <li class=" ">
                    <a class="ripple" href="{{route('admin.mot.new')}}" title="Dashboard v1"><span
                            class="nav-text">Ajouter un nouveau</span></a>
                </li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.mot.liste')}}" title="Dashboard v2"><span
                            class="nav-text">Voir la liste</span></a>
                </li>
            </ul>
        </li>

        <li class=" ">
            <a class="ripple" href="#retr" title="Dashboard" data-toggle="collapse"><!--span
                    class="float-right badge badge-info">3</span--><em class="icon-speedometer"></em><span
                    class="nav-text" data-localize="sidebar.nav.DASHBOARD">Retrait</span></a>

            <ul class="sidebar-nav sidebar-subnav collapse " id="retr">
                <li class=" ">
                    <a class="ripple" href="{{route('admin.demande.liste')}}" title="Dashboard v1"><span
                            class="nav-text">Voir les demandes</span></a>
                </li>
                <li class=" ">
                    <a class="ripple" href="{{route('admin.demande.success')}}" title="Dashboard v2"><span
                            class="nav-text">Voir la liste</span></a>
                </li>
            </ul>
        </li>



        <li class="">
            <a class="ripple" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            href="{{ route('admin.logout') }}">
                <em class="icon-tag"></em>
                <span class="nav-text" data-localize="sidebar.nav.WELCOME">Deconnexion</span>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
            </form>
        </li>


    </ul>
</nav>
