@extends('userView.templateUser')

@section('titre') Rechercher un livre
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="container">
    <div class="row mt-lg-4">
        <div class="col-md-12">
            <form action="{{route('start_page_recherche')}}" method="get" >
                <div class="form-group mb-4">

                    <div class="row">
                        <div class="col-md-8 mb-2">
                            @if(isset($resultat) and $resultat == 1)
                            @php $titre = $titre ; $cate = $categorie ; @endphp
                            @else
                            @php $titre = ""; $cate = 0 ; @endphp
                            @endif
                            <input class="form-control mb-2" value="{{$titre}}"  name="titre" type="text" placeholder="Entrez le nom du livre que vous recherchez">
                        </div>
                        <div class="col-md-3 mb-1">
                            <select name="categorie" id="" class="form-control">
                                <option value="0">Toutes les catégories</option>
                                @foreach ($les_categories as $item)
                                <option @if($cate == $item->id) selected @endif value="{{$item->id}}">{{$item->name_categ}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">

                        <button class="btn btn-secondary" type="submit">Lancer la recherche</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>


@if(isset($resultat) and $resultat == 1)

<div class="px-lg-5 bg-light py-lg-3">

    @if(count($publications) == 0)
    <div class="alert alert-danger text-center" role="alert">
        <strong>Aucun livre trouvé</strong>
    </div>
    @endif

    <div class="row mt-3 " e >
        @foreach ($publications as $item)
        <div class="col-md-3 mb-3 px-4">
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
        <div class="col-12 text-center">
            {{ $publications->links('component.pagination') }}
        </div>
    </div>
</div>

@endif


@endsection


@section('codeJS')
@endsection
