
<nav class="navbar topnavbar navbar-expand-lg navbar-light">
    <!-- START navbar header-->
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('welcome')}}">
            <div class="brand-logo">
                <img class="img-fluid" src="{{asset('asset_user/logo.png')}}" style="height: 70px; max-width: 100%; "></div>
            <div class="brand-logo-collapsed">
                <img class="img-fluid" src="{{asset('asset_user/logo-single.png')}}"
                    alt="App Logo"></div>
        </a><button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#topnavbar"><span class="navbar-toggler-icon"></span></button></div>


    <div class="navbar-collapse collapse" id="topnavbar">
        <!-- START Left navbar-->
        <ul class="nav navbar-nav ml-auto flex-column flex-lg-row">
            <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('bibliotheque')}}">Bibliothèque</a></li>

            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    href="#dashboard" data-toggle="dropdown">Parcourir</a>
                <div class="dropdown-menu animated fadeIn">

                        @foreach ($les_categories as $item)
                        <a class="dropdown-item"
                        href="{{route('book_categ',[$item->id, $item->name_categ])}}">{{$item->name_categ}}</a>
                        @endforeach
                    </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('search')}}">Rechercher</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('tarif')}}">Tarifs</a></li>
            @auth
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                href="#dashboard" data-toggle="dropdown">Mon compte @if($not >0 ) <sup> <span class="badge badge-success">{{$not}}</span> </sup> @endif </a>
                <div class="dropdown-menu animated fadeIn">
                    <b class="dropdown-item">Solde : <b class="text-primary">{{Auth::user()->solde}}</b> FCFA</b>
                    <a class="dropdown-item" href="{{ route('notif') }}">Notifications <span class="badge badge-success">{{$not}}</span> </a>
                    <a class="dropdown-item" href="{{ route('publier') }}">Mes Publications</a>
                    <a class="dropdown-item" href="{{ route('profil.index') }}">Profil</a>
                    <a class="dropdown-item" href="{{ route('retrait_index') }}">Faire un retrait</a>
                    <a class="dropdown-item" href="{{ route('operation') }}">Mes opérations</a>
                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    href="{{ route('logout') }}">
                        <span class="nav-text" data-localize="sidebar.nav.WELCOME">Deconnexion</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </li>
            @endauth

        </ul><!-- END Left navbar-->

       <div class="mr-lg-4 mr-2">
            @auth
            <a href="{{ route('publier.new') }}" class="btn btn-success ">Publier un livre</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-success">Se connecter</a>
            <a href="{{ route('login') }}" class="btn btn-success">S'inscrire</a>
            @endif
       </div>
    </div><!-- END Nav wrapper-->
    <!-- START Search form-->
    <form class="navbar-form" role="search"
        action="http://themicon.co/theme/mdangle/v1.0/static-html/app/search.html">
        <div class="form-group"><input class="form-control" type="text"
                placeholder="Type and hit enter ...">
            <div class="fa fa-times navbar-form-close" data-search-dismiss=""></div>
        </div><button class="d-none" type="submit">Submit</button>
    </form><!-- END Search form-->
</nav>
