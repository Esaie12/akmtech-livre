@extends('adminView.templateAdmin')

@section('titre') Approuver un retrait
@endsection

@section('codeCSS')
@endsection

@section('contenu')
<div class="row">

    <div class="col-xl-12">

        <div class="card card-default">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2 ">
                        <h3>Détails surl'opération</h3>
                        <div class="mt-2" >
                            <span>Nom de l'utilisateur</span>: <br>
                            <b>{{ $item->name." ".$item->prenoms }}</b>
                        </div>
                        <div class="mt-2" >
                            <span>Montant à retirer</span>: <br>
                            <b>{{$item->montant_retirer}} FCFA</b>
                        </div>
                        <div class="mt-2" >
                            <span>A recevoir par </span>: <br>
                            <b>{{ $item->receve_moyen }}</b>
                        </div>
                        <div class="mt-2" >
                            <span>A envoyer sur</span>: <br>
                            <b>{{ $item->numero_adresse }}</b>
                        </div>
                        <div class="mt-2" >
                            <span>Date de la demande</span>: <br>
                            <b>{{ $item->date_demande }}</b>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <h3>Envoyer les preuves du transfert ou virement</h3>
                        @if($item->etat_demande == 0)
                        <form action="{{ route('admin.demande.confirmer') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="idOpe" value="{{$item->id}}" >
                            <input type="file" name="image" id=""> <br>
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror <br>
                            <button class="btn btn-success mt-3">Envoyer</button>
                        </form>
                        @endif

                        @if($item->etat_demande == 1)
                        Deja envoyé
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('codeJS')
@endsection
