@extends('adminView.templateAdmin')

@section('titre')
@endsection

@section('codeCSS')
@endsection

@section('contenu')

<div class="row px-5">
    <div class="col-md-6 mb-3">
        <!-- START card-->
        <div class="card card-default">
            <div class="card-header">Détails sur le livre</div>
            <div class="card-body">
                <div class="">
                    <h4 class="text-primary">Informations sur l'auteur</h4>
                    <b>Nom de l'auteur de la publication</b>
                    <p>{{ $pub->name." ".$pub->prenoms }}</p>
                    <p>{{ $pub->email }}</p>
                </div>
                <div class="">
                    <h4 class="text-primary">Informations sur le livre</h4>
                    <b>Titre</b>
                    <p>{{  $pub->titre_pub}}</p>
                    <b>Auteur</b>
                    <p>{{  $pub->auteur_pub}}</p>
                    <b>Description</b>
                    <p>{{  $pub->description_pub}}</p>
                    <b>Lien</b>
                    <p>{{  $pub->lien_pub}}</p>
                    <a href="{{ $pub->lien_pub }}" class="mb-3 btn btn-primary">Accéder au lien</a>
                </div>
                <div class="">
                    <h4 class="text-primary">Plus d'informations</h4>
                    <b>Date de publication</b>
                    <p>{{  $pub->titre_pub}}</p>
                    <b>La pub a t'elle été boster ?</b>
                    <p>
                        @if($pub->with_plan == 0)
                        <b class="text-danger">Non</b>
                        @elseif( $pub->with_plan == 1)
                        <b class="text-success">OUI</b>
                        @endif
                    </p>
                </div>
            </div>
        </div><!-- END card-->
    </div>

    <div class="col-md-6 mb-3">

        @if($pub->etat_demande == 1)
            @if($pub->visible_pub == 1)
            <b>
                Cette publication est actuellement visible sur la plateforme. Si vous voulez désactiver la visibilité,
                cliquez sur le bouton ci-dessous.
            </b> <br>
            <a href="{{ route('admin.pub.revoir-decision',[ 0 , $pub->id  ]) }}" class="btn btn-danger px-3">Rendre invisible</a>
            @else
            <b>
                Cette publication est actuellement invisible sur la plateforme. Si vous voulez re-activer la visibilité,
                cliquez sur le bouton ci-dessous.
            </b> <br>
            <a href="{{ route('admin.pub.revoir-decision',[ 1 , $pub->id  ]) }}" class="btn btn-warning px-3">Rendre visible</a>
            @endif
        @endif

        @if($pub->etat_demande == 2)
        Rejetée
        @endif

        @if($pub->etat_demande == 0 )
        <div class="card card-default">
            <div class="card-header bg-success">Approuver la publication</div>
            <div class="card-body">
                <div class="">
                    <p>Apres avoir étudier la publication, cliquer sur le bouton cii-dessous. Cette action
                        rendra visible ce livre sur la plateform. <br>
                        Si la publication a été boster par l'auteur, ce livre ne sera visible que pares paiement
                        de la caution de booster à par ce dernier.
                    </p>
                    <form action="{{  route('admin.pub.decision')}}" method="post">
                        @csrf
                        <input type="hidden" name="idPub" value="{{$pub->id}}" >
                        <input type="hidden" name="decision" value="1" >
                        <button class="btn btn-success px-3">Valider</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-default mt-lg-5 mt-3">
            <div class="card-header bg-danger">Rejeter la publication</div>
            <div class="card-body">
                <div class="">
                    <p>Apres avoir étudier la publication, cliquer sur le bouton cii-dessous. Cette action
                        rendra visible ce livre sur la plateform. <br>
                        Si la publication a été boster par l'auteur, ce livre ne sera visible que pares paiement
                        de la caution de booster à par ce dernier.
                    </p>
                    <form action="{{  route('admin.pub.decision')}}" method="post">
                        @csrf
                        <input type="hidden" name="idPub" value="{{$pub->id}}" >
                        <input type="hidden" name="decision" value="0" >
                        <b>La raison du rejet</b>
                        <textarea name="raison" id="" cols="30" rows="5" class="form-control"></textarea>
                        <button class="btn btn-danger px-3 mt-3">Rejeter</button>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection


@section('codeJS')
@endsection
