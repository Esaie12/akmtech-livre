@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')

<div class="row mt-4" >
    <div class="col-xl-3">
        <div class="card border-0">
            <div class="row row-flush">
                <div class="col-4 bg-info text-center d-flex align-items-center justify-content-center rounded-left"><em
                        class="fa fa-users fa-2x"></em></div>
                <div class="col-8">
                    <div class="card-body text-center">
                        <h4 class="mt-0">{{$users}}</h4>
                        <p class="mb-0 text-muted">INSCRITS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">

        <div class="card border-0">
            <div class="row row-flush">
                <div class="col-4 bg-danger text-center d-flex align-items-center justify-content-center rounded-left">
                    <em class="fa fa-music fa-2x"></em></div>
                <div class="col-8">
                    <div class="card-body text-center">
                        <h4 class="mt-0">{{$pub}}</h4>
                        <p class="mb-0 text-muted">LIVRES</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">

        <div class="card border-0">
            <div class="row row-flush">
                <div class="col-4 bg-inverse text-center d-flex align-items-center justify-content-center rounded-left">
                    <em class="fas fa-code-branch fa-2x"></em></div>
                <div class="col-8">
                    <div class="card-body text-center">
                        <h4 class="mt-0">{{$pub_us}}</h4>
                        <p class="mb-0 text-muted">PUBLICATIONS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">

        <div class="card border-0">
            <div class="row row-flush">
                <div class="col-4 bg-green text-center d-flex align-items-center justify-content-center rounded-left">
                    <em class="fa fa-inbox fa-2x"></em></div>
                <div class="col-8">
                    <div class="card-body text-center">
                        <h4 class="mt-0">{{$retrait}}</h4>
                        <p class="mb-0 text-muted">DEMANDES DE RETRAIT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('codeJS')
@endsection
