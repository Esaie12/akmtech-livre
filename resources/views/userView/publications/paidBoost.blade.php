@extends('userView.templateUser')

@section('titre') Boostage Paid
@endsection

@section('codeCCS')
@endsection

@section('contenu')
<div class="row">
    <div class="offset-md-3 col-md-6 mt-5">
        <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
                <h4 class="card-title">{{ $data->titre_pub}}</h4>
                <p class="card-text">
                    Payer les frais de boostage de votre livre pour le rendre visible
                </p>
                <div class="card-text">
                    Frais de boostage : <br>
                    <!--
                        <select name="boost_id" id="" class="form-control">
                                        <option value="">Choisir</option>
                                        <option value="1">1.000 Lecteurs ( 5000 Fcfa)</option>
                                        <option value="2">2.500 Lecteurs ( 10.000 Fcfa)</option>
                                        <option value="3">5.000 Lecteurs ( 17.000 Fcfa)</option>
                                        <option value="4">10.000 Lecteurs ( 20.000 Fcfa)</option>
                                    </select>
                    -->
                    @php
                    switch ($data->type_plan) {
                        case 1:
                            $prix = 5000; $lec = 1000;
                            break;
                        case 2:
                            $prix = 10000; $lec = 2500;
                            break;

                        case 3:
                            $prix = 17000; $lec = 5000;
                            break;

                        case 4:
                            $prix = 20000; $lec = 10000;
                            break;
                    }
                    @endphp
                </div>
                <div class="card-text">
                    <p>
                        Vous voulez que votre livre atteigne rapidement les <strong class="text-primary">{{ $lec }}</strong>
                        lecteurs dans le mois. Ainsi pour permettre à notre algorithme de mettre votre production en tete
                        vous devez payer <strong class="text-primary">{{ $prix }} FCFA</strong>. <br>
                        Une fois, le paiement effectué votre publication sera automatiquement visible sur la plateforme. <br>
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{route('publier.paid',$data->id)}}" method="get"  >

                                <input type="hidden" name="field" value="{{$prix}}">
                                <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                                  data-public-key="pk_live_hddDjyZ4Z7o97OP3_qMksl4_" data-button-text="Payer avec FedaPay"
                                  data-button-class="pay-btn btn btn-primary btn-block mt-2" data-transaction-amount="{{$prix}}"
                                  data-transaction-description="Boostage sur PlumLivre" data-currency-iso="XOF">
                                </script>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                @csrf
                                <input type="hidden" name="boost" value="1">
                                <input id="amount" type="hidden" class="form-control" name="amount" value="{{$prix / 650}}" >

                                <input type="hidden" name="idLivre" value="{{$data->id}}" >
                                <input type="hidden" name="idBost" value="{{$data->type_plan}}" >
                                <button type="submit" class="btn btn-primary btn-block mt-2">
                                    Payer avec PayPal
                                </button>
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
