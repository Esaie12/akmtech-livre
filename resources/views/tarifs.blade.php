@extends('userView.templateUser')

@section('titre') Packs
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="container">


    <div class="text-center my-3 py-4">
        <div class="h2 text-bold">NOS TARIFS</div>
        <p>Souscrivez à l'un de nos packs et bénificiez des avantages que nous vous offrons</p>
    </div><!-- START PLAN TABLE-->
    <div class="mb-3 text-center">
        @if(Session::get('msg'))
        <div class="alert alert-warning" role="alert">
             {{Session::get('msg')}}
        </div>
        @endif
    </div>

    <div class="row">
        <!-- PLAN-->
        <div class="col-lg-3">
            <div class="card b">
                <div class="card-body text-center bb">
                    <div class="text-bold">BASIC</div>
                    <h3 class="my-3"><sup>FCFA</sup><span class="text-lg">100</span></h3>
                    <div class="text-bold">4 jours</div>
                </div>
                <div class="card-body">
                    <p>
                        <em class="fa fa-check fa-fw text-green mr-2"></em> Accédez aux livres et BD numériques et profitez d'un livre audio par mois parmi une sélection.
                    </p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em> Amour</p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em> Société</p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em> Nos livres numériques en illimité</p>
                </div>
                <div class="card-body text-center">
                    @auth
                    <div>
                        Payer avec : <br>
                        <!--input type="radio" name="avec" id="" class="mr-2"  onclick="pour(1,1)" >Cartes Bancaires-->
                        <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(1,2)" >Mobile Money<br>
                        <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(1,3)" >PayPal
                    </div>
                    <div id="1Kki" style="display: none" >
                        KkiaPay <br>
                        <kkiapay-widget amount="100"
                            key="85abcb60ae8311ecb9755de712bc9e4f"
                            url="<url-vers-votre-logo>"
                            position="center"
                            sandbox="true"
                            data=""
                            paymentmethod=""
                            callback="{{route('abonnement',[1, "basic"])}}">
                        </kkiapay-widget>
                    </div>
                    <div  id="1Fed" style="display: none" >

                        <form action="{{route('abonnement',[1, "basic"])}}" method="get"  >
                            <input type="hidden" name="field" value="100">

                            <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                              data-public-key="pk_live_hddDjyZ4Z7o97OP3_qMksl4_" data-button-text="Souscrire"
                              data-button-class="pay-btn btn btn-primary btn-block" data-transaction-amount="100"
                              data-transaction-description="Abonnement 500fr sur PlumLivre" data-currency-iso="XOF">
                            </script>
                        </form>
                    </div>
                    <div id="1Pay" style="display: none" >
                        Pay Pal
                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                            @csrf
                            <input id="amount" type="hidden" class="form-control" name="amount" value="2.5" >

                            <input type="hidden" name="idPack" value="1" >
                            <button type="submit" class="btn btn-primary btn-block mt-2">
                                PayPal
                            </button>
                        </form>
                    </div>
                    @else
                    <a class="btn btn-secondary btn-lg" href="{{route('login')}}">Souscrire</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card b">
                <div class="card-body text-center bg-green">
                    <div class="text-bold">VIP</div>
                    <h3 class="my-3"><sup>FCFA</sup><span class="text-lg">500</span></h3>
                    <div class="text-bold">25 Jours</div>
                </div>
                <div class="card-body">
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em>
                        <span>Accédez aux livres et BD numériques et profitez d'un livre audio par mois parmi une sélection.</span>
                    </p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Amour</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Société</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Humour</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Nos livres numériques en illimité                    </span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Multiple installation</span></p>
                    <p><em class="fa fa-times fa-fw text-warning mr-2"></em><span>Not ready for resale</span></p>
                </div>
                <div class="card-body text-center">
                    @auth
                    <div>
                        Payer avec : <br>
                        <!-- type="radio" name="avec" id="" class="mr-2"  onclick="pour(2,1)" >Cartes bancaires-->
                        <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(2,2)" >Mobile Money <br>
                        <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(2,3)" >PayPal
                    </div>
                    <div id="2Kki" style="display: none">
                        <kkiapay-widget amount="5000"
                            key="85abcb60ae8311ecb9755de712bc9e4f"
                            url="<url-vers-votre-logo>"
                            position="center"
                            sandbox="true"
                            data=""
                            paymentmethod="card"
                            callback="{{route('abonnement',[2, "vip"])}}">
                        </kkiapay-widget>
                    </div>
                    <div  id="2Fed" style="display: none" >

                        <form action="{{route('abonnement',[2, "vip"])}}" method="get"  >

                            <input type="hidden" name="field" value="500">
                            <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                              data-public-key="pk_live_hddDjyZ4Z7o97OP3_qMksl4_" data-button-text="Souscrire"
                              data-button-class="pay-btn btn btn-primary btn-block" data-transaction-amount="500"
                              data-transaction-description="Abonnement 500fr sur PlumLivre" data-currency-iso="XOF">
                            </script>
                        </form>
                    </div>
                    <div class="my-2" id="2Pay" style="display: none">
                        PayPal
                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                            @csrf
                            <input id="amount" type="hidden" class="form-control" name="amount" value="10" >

                            <input type="hidden" name="idPack" value="2" >
                            <button type="submit" class="btn btn-primary btn-block mt-2">
                                PayPal
                            </button>
                        </form>
                    </div>
                    @else
                    <a class="btn btn-secondary btn-lg" href="{{route('login')}}">Souscrire</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card b">
                <div class="card-body text-center bb">
                    <div class="text-bold">GOLD</div>
                    <h3 class="my-3"><sup>FCFA</sup><span class="text-lg">1000</span></h3>
                    <div class="text-bold">55 Jours</div>
                </div>
                <div class="card-body">
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Accédez aux livres et BD numériques et profitez d'un livre audio par mois parmi une sélection.</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Amour ,Humour, Société</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Epique ( royautés africaines )</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Nos livres numériques en illimité</span></p>
                </div>
                <div class="card-body text-center">
                    <div class="card-body text-center">
                        @auth
                        <div>
                            Payer avec : <br>
                            <!--input type="radio" name="avec" id="" class="mr-2"  onclick="pour(3,1)" >Cartes bancaires-->
                            <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(3,2)" > Mobile Money<br>
                            <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(3,3)" >PayPal
                        </div>
                        <div id="3Kki" style="display: none">
                            <kkiapay-widget amount="1000"
                                key="85abcb60ae8311ecb9755de712bc9e4f"
                                url="<url-vers-votre-logo>"
                                position="center"
                                sandbox="true"
                                data="" paymentmethod="card"
                                callback="{{route('abonnement',[3, "gold"])}}">
                            </kkiapay-widget>
                        </div>
                        <div  id="3Fed" style="display: none" >

                            <form action="{{route('abonnement',[3, "gold"])}}" method="get"  >

                                <input type="hidden" name="field" value="1000">
                                <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                                  data-public-key="pk_live_hddDjyZ4Z7o97OP3_qMksl4_" data-button-text="Souscrire"
                                  data-button-class="pay-btn btn btn-primary btn-block" data-transaction-amount="12000"
                                  data-transaction-description="Abonnement 500fr sur PlumLivre" data-currency-iso="XOF">
                                </script>
                            </form>
                        </div>
                        <div class="my-2" id="3Pay" style="display: none">
                            PayPal
                            <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                @csrf
                                <input id="amount" type="hidden" class="form-control" name="amount" value="20" >

                                <input type="hidden" name="idPack" value="3" >
                                <button type="submit" class="btn btn-primary btn-block mt-2">
                                    PayPal
                                </button>
                            </form>
                        </div>
                        @else
                        <a class="btn btn-secondary btn-lg" href="{{route('login')}}">Souscrire</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card b">
                <div class="card-body text-center bb">
                    <div class="text-bold">EVASION</div>
                    <h3 class="my-3"><sup>FCFA</sup><span class="text-lg">6000</span></h3>
                    <div class="text-bold">12 Mois</div>
                </div>
                <div class="card-body">
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Accédez aux livres et BD numériques et profitez d'un livre audio par mois parmi une sélection.</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Amour, Société, Humour, Epique</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>Nos livres numériques en illimité</span></p>
                    <p><em class="fa fa-check fa-fw text-green mr-2"></em><span>1 Livre en version papier</span></p>
                </div>
                <div class="card-body text-center">
                    @auth
                    <div>
                        Payer avec : <br>
                        <!--input type="radio" name="avec" id="" class="mr-2"  onclick="pour(4,1)" >Cartes bancaires-->
                        <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(4,2)" >Mobile Money <br>
                        <input type="radio" name="avec" id="" class="ml-3 mr-2" onclick="pour(4,3)" >PayPal
                    </div>
                    <div id="4Kki" style="display: none" >
                        <kkiapay-widget amount="6000"
                            key="85abcb60ae8311ecb9755de712bc9e4f"
                            url="<url-vers-votre-logo>"
                            position="center"
                            sandbox="true"
                            data=""
                            paymentmethod="card"
                            callback="{{route('abonnement',[4, "evasion"])}}">
                        </kkiapay-widget>
                    </div>
                    <div  id="4Fed" style="display: none" >
                        <form action="{{route('abonnement',[4, "evasion"])}}" method="get"  >

                            <input type="hidden" name="field" value="6000">
                            <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                              data-public-key="pk_live_hddDjyZ4Z7o97OP3_qMksl4_" data-button-text="Souscrire"
                              data-button-class="pay-btn btn btn-primary btn-block" data-transaction-amount="20000"
                              data-transaction-description="Abonnement 500fr sur PlumLivre" data-currency-iso="XOF">
                            </script>
                        </form>
                    </div>
                    <div class="my-2" id="4Pay" style="display: none">
                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                            @csrf
                            <input id="amount" type="hidden" class="form-control" name="amount" value="30" >

                            <input type="hidden" name="idPack" value="4" >
                            <button type="submit" class="btn btn-primary btn-block mt-2">
                                PayPal
                            </button>
                        </form>
                    </div>
                    @else
                    <a class="btn btn-secondary btn-lg" href="{{route('login')}}">Souscrire</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="col-12">

    </div>
    <p class="text-center text-muted"><small>PlumLivre votre Bibliothèque Digitale
    </small></p>
</div>

@endsection


@section('codeJS')
<script>
    function pour(div, choix){
        $(function(){
            if(choix == 1){
                $('#'+div+"Kki").show();
                $('#'+div+"Fed").hide();
                $('#'+div+"Pay").hide();
            }
            if(choix == 2){
                $('#'+div+"Fed").show();
                $('#'+div+"Pay").hide();
                $('#'+div+"Kki").hide();

            }
            if(choix == 3){
                $('#'+div+"Pay").show();
                $('#'+div+"Kki").hide();
                $('#'+div+"Fed").hide();
            }

        })
    }

</script>
@endsection
