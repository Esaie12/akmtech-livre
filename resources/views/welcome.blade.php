@extends('userView.templateUser')

@section('titre')
Acceuil
@endsection

@section('codeCSS')

<link rel="stylesheet" href="{{asset('owlcarousel/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('owlcarousel/dist/assets/owl.theme.default.min.css')}}">

<style>
#main{
   background-color: orange

}
#main h2{
    font-family: 'Times New Roman';
    font-size: 50px;
    margin-top: 9%;
    letter-spacing: 2px;
}
div.scrollmenu {

overflow: auto;
white-space: nowrap;
}

div.scrollmenu::-webkit-scrollbar{
    display: none;
}

div.scrollmenu a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px;
    text-decoration: none;
}

</style>
@endsection

@section('contenu')

<div class="row">

</div>

<div id="main" style="" class="py-5 px-lg-5" >
    <div class="row px-5">
        <div class="col-md-6">
            <div class="row mt-lg-5">
                <div class="col-md-12 ">
                    <h3>Bienvenue sur PLUM LIVRE</h3>
                </div>
            </div>
            <div class="row  mt-lg-4 mt-2">
                <div class="col-md-12">
                    <p>
                        Plus de 10 millions de personnes lisent ici, parcequ'ils aiment se cultiver et se faire plaisir.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($les_carrousels as $key=> $item)
                        @php $active = "" ; @endphp
                        @if($key == 0) @php $active = "active" ; @endphp @endif

                        <div class="carousel-item {{$active}} ">
                            <img class="d-block w-100" src="{{asset(env('start').$item->image)}}" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                              <h4>{{$item->titre}}</h4>
                              <p>{{$item->description}}</p>
                            </div>
                        </div>

                    @endforeach


                </div>
                @if(count($les_carrousels) != 0)
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="px-lg-5 bg-light py-3">
    <!--h3>A LA DECOUVERTE</h3>
    <div class="row mt-3 ">
        <div class="col-md-3 mb-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" height="213px" src="{{ asset('asset_user/img/1.jpeg') }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Commencer la lecture</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" height="213px" src="{{ asset('asset_user/img/1.jpeg') }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Commencer la lecture</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" height="213px" src="{{ asset('asset_user/img/1.jpeg') }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Commencer la lecture</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" height="213px" src="{{ asset('asset_user/img/1.jpeg') }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Commencer la lecture</a>
                </div>
            </div>
        </div>
    </div-->

    <h4 style="color:orange" class="mt-4" >NOS CATEGORIES</h4>
    <div class="scrollmenu mt-4">
        <a href="{{ route('bibliotheque') }}" class="nav-link mx-4" style="background-color:white ; border:2px solid orange" >
            <div class="" style="color:orange" >
                BIBLIOTHEQUE
            </div>
        </a>
        @foreach ($les_categories as $item)
        <a href="{{ route('book_categ',[$item->id , $item->name_categ]) }}" class="nav-link mx-4" style="background-color:white ; border:2px solid orange ; text-tranform:uppercase" >
            <div class="" style="color:orange" >
                {{$item->name_categ}}
            </div>
        </a>
        @endforeach

    </div>
    <!--div class="row">
        <div class="col-12">
            <div class="owl-carousel">
                <a href="{{ route('bibliotheque') }}" class="nav-link">
                    <div id="categorie-biblio" class="m-2 py-3">

                    </div>
                </a>

                @foreach ($les_categories as $item)
                <a href="{{ route('book_categ',[$item->id , $item->name_categ]) }}" class="nav-link" >
                    <div id="categorie" class="m-2 py-3" >{{$item->name_categ}}</div>
                </a>

                @endforeach
            </div>
        </div>
    </div-->

    <div class="text-center mt-lg-5">
        <h4 class="mt-4 " >
            <span style="color:orange" >PARCOURIR NOS LVRES</span>
            <a class="ml-lg-3" href="{{ route('bibliotheque') }}">Voir tout</a>
        </h4>
    </div>
    <div class="row mt-3 mt-lg-5 mx-2">
        @foreach ($publications as $item)
        <div class="col-md-3 col-12 mb-3 px-4">
            <div class="text-center">
                <h4 class="card-title mt-3">
                    <b>{{ $item->titre_pub}}</b>
                </h4>
            </div>

            <div class="card" >

                <img class="card-img-top" style="min-height: 275px"  src="{{ asset(env('start').$item->photo_pub) }}" alt="Card image cap">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <b>{{ $item->auteur_pub}}</b>
                  </h5>
                  <!--p class="card-text">{{ $item->description_pub }}</p-->
                  <a href="{{ route('read',$item->id) }}" class="btn btn-success">Commencer la lecture</a>

                </div>
                <div class="text-right px-3">
                   {{$item->count_view}} <i>Vues</i>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@if($mot_n != 0 )
<div class="row bg-white">
    <div class="col-md-4 px-2 mt-lg-3">
        <div class="text-center" >
            <h3 style="color:orange"  class="mt-4" >MOT DU JOUR</h3>
        </div>
        <div class="text-center mt-3">
            <b>{{$mot->mot_day}}</b>
        </div>
        <div class="text-center mt-lg-4 mt-3 mx-4" >
           {{$mot->definition_mot}}
        </div>
    </div>
    <div class="col-md-4 text-center">
        <img height="280px" width="280px" src="{{ asset('asset_user/img/girl.jpg') }}" alt="">
    </div>
    <div class="col-md-4 px-2 mt-lg-3">
        <div class="text-center" >
            <h3 style="color:orange"  class="mt-4" >CITATION DU JOUR</h3>
        </div>
        <div class="text-justify mt-lg-4 mt-3 mx-4" >
            {{$mot->citation_day}}
        </div>
        <div class="text-center mt-3">
            <b>{{$mot->citation_auteur}}</b>
        </div>
    </div>

</div>
@endif

@endsection


@section('codeJS')
<script src="{{asset('owlcarousel/dist/owl.carousel.min.js')}}"></script>
<script>
    $(document).ready(function(){

        $('.owl-carousel').owlCarousel({
            center: true,
            items:2,
            loop:true,
            margin:10,
            responsive:{
            600:{
                items:4
            }
        }
});
    });
</script>
@endsection
