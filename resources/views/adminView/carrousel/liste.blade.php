@extends('adminView.templateAdmin')

@section('titre') Mes Carrousels
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">
    @foreach ($data as $item)
    <div class="col-lg-4 col-sm-6">
        <div class="card card-default">
            <div class="card-header">
                @if($item->visible == 1)
                Image Visible sur l'accueil
                @else
                Image Invisible
                @endif
            </div>
            <div class="card-body text-center">
                <img class="mb-2 img-fluid rounded-circle thumb64" src="{{asset(env('start').$item->image)}}"
                    alt="Contact">
                <h4>{{$item->titre}}</h4>
                <p>{{$item->description}}</p>
            </div>
            <div class="card-footer d-flex">
            <div>
            </div>
                @if($item->visible == 1)
                <a class="btn btn-xs btn-danger" href="{{ route('admin.carrousel.decision',[0, $item->id]) }}">Rendre
                    invisible</a>
                @else
                <a class="btn btn-xs btn-success" href="{{ route('admin.carrousel.decision',[1, $item->id]) }}">Rendre
                    visible</a>
                @endif
                <div class="ml-auto"><a class="btn btn-xs btn-secondary" href="#">Voir</a></div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection


@section('codeJS')
@endsection
