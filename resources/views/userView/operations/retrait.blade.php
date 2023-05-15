@extends('userView.templateUser')

@section('titre') Retrait
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="row py-lg-5 py-3 mx-2">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card b mb-2">
            <div class="card-header">
                <h4 class="card-title"><a class="text-inherit" data-toggle="collapse" data-parent="#accordion"
                        href="#acc1collapse1" aria-expanded="true">Faire un retrait d'argent</a></h4>
            </div>
            <div class="collapse show" id="acc1collapse1" style="">
                <div class="card-body" id="collapse01">
                    <div class="row">
                        <div class="col-lg-6">
                            <p><strong>A savoir</strong></p>
                            <ol>
                                <li>Vous devez avoir de l'argent dans votre compte PLUMLIVRE</li>
                                <li>Vous devez avoir souscrire à Abonnement Payant au moins une fois</li>
                                <li>Une demande de retrait doit etre traitée par nos administrateurs</li>
                                <li>Une fois la demande approuvée, vous recevez de l'argent dans votre compte mobile money ou paypal</li>
                                <li>Votre compte sera ensuite débité</li>
                                <li>La durée d'une demande de retrait depend de l'affluence des demandes en attente</li>
                            </ol>
                        </div>
                        <div class="col-lg-6">

                            @if(Session::get('msg'))
                            <div class="alert alert-danger" role="alert">
                                <strong>{{Session::get('msg')}}</strong>
                            </div>
                            @endif

                            <form method="post" action="{{ route('retrait.save') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center">
                                    <h3>Solde : <b class="text-primary"> {{ Auth::user()->solde }} </b> FCFA</h3>
                                </div>
                                <div class="px-lg-3 px-3 py-3">

                                    <div class="form-group">
                                        <label>Montant à retirer </label>
                                        <input class="form-control" type="text" name="montant_retirer"
                                            value="{{ @old('montant_retirer') }}" placeholder="">
                                        @error('montant_retirer')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Vous voulez le recevoir par ?</label>
                                        <select name="receve_moyen" id="" class="form-control">
                                            <option value="">Chosir le moyen</option>
                                            <option value="mobile">Mobile Money</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                        @error('receve_moyen')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Numéro Mobile Money ou adresse Paypal</label>
                                        <input class="form-control" type="text" name="numero_adresse"
                                            value="{{ @old('numero_adresse') }}" placeholder="">
                                        @error('numero_adresse')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Autres informations (si vous en avez )</label>
                                        <input class="form-control" type="text" name="info_receve"
                                            value="{{ @old('info_receve') }}"
                                            placeholder="Donnez nous le nom de votre compte Mobile money ou celui du compte PayPal">
                                        @error('info_receve')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                   </div>

                                    <button class="btn btn-sm btn-primary" type="submit">Lancer la demande </button>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('codeJS')
@endsection
