@extends('userView.templateUser')

@section('titre') Bibliothèque
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="bg-lg-white py-lg-5 text-center">
    <div class="">
        <div class="">
            <h3 class="mt-4" style="color: orange" >BIBLIOTHEQUE</h3>
        </div>
    </div>
    @if(Auth::check())
    @include('userView.chrono')
    @endif

</div>

<div class="px-lg-5 bg-light py-lg-3">


    <div class="row mt-3 ">
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
@endsection


@section('codeJS')
@endsection
