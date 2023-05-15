<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


use App\Models\Souscription ;
use App\Models\Publication ;
use App\Models\User ;
use App\Models\Notif ;
use App\Models\Transaction as Trans;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    private $_api_context;

    public function __construct()
    {

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('userView.pay');
    }

    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Abonnement')
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Oups, La transaction a échouée, veillez réessayer. Merci !!');
                //return Redirect::route('paywithpaypal');
                return Redirect::route('paiement.start');
            } else {
                \Session::put('error','Oups, La transaction a échouée, veillez réessayer. Merci !!');
                //return Redirect::route('paywithpaypal');
                return Redirect::route('paiement.start');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {

            if(isset($request['boost']) and $request['boost'] == 1){

                $da = new Trans();
                $da->idUser = Auth::user()->id;
                //$da->idPack = $request['idPack'];
                $da->idLivre = $request['idLivre'];
                $da->boost = true;
                $da->idBost = $request['idBost'];
                $da->paiement_id = $payment->getId();
                $da->save();

            }else{

                $da = new Trans();
                $da->idUser = Auth::user()->id;
                $da->idPack = $request['idPack'];
                $da->paiement_id = $payment->getId();
                $da->save();

            }


            return Redirect::away($redirect_url);
        }

        \Session::put('error','Oups, La transaction a échouée, veillez réessayer. Merci !!');
    	//return Redirect::route('paywithpaypal');



        return Redirect::route('paiement.start');
    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Oups, La transaction a échouée, veillez réessayer. Merci !!');
            //return Redirect::route('paywithpaypal');
            return Redirect::route('paiement.start');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::put('success','Paiement effectué avec succes. Nous vous remercions pour votre Don. !!');
            //return Redirect::route('paywithpaypal');

            $rec = DB::table('transactions')
            ->where('paiement_id',$payment_id)->first();

            if($rec->boost == true){

                $pub = Publication::find($idLivre);
                $pub->id_transaction = $payment_id;
                $pub->etat_paiement = 1;
                $pub->date_paiement = date('Y-m-d');
                $pub->visible_pub = 1;
                $pub->save();

            }else{

                $id = $rec->idPack;

            if($id == 1){

                $su = new Souscription();
                $su->idUser = Auth::user()->id;
                $su->idPack = $id;
                $su->description = "Abonnement de type Basic";
                $su->dateStart = date('Y-m-d');
                $su->dateEnd = date('Y-m-d', strtotime("+4 days")) ;
                $su->idTransaction = $payment_id;
                $su->save();

            }

            if($id == 2){

                $su = new Souscription();
                $su->idUser = Auth::user()->id;
                $su->idPack = $id;
                $su->description = "Abonnement de type VIP";
                $su->dateStart = date('Y-m-d');
                $su->dateEnd = date('Y-m-d', strtotime("+25 days")) ;
                $su->idTransaction = $payment_id;
                $su->save();

            }

            if($id == 3){

                $su = new Souscription();
                $su->idUser = Auth::user()->id;
                $su->idPack = $id;
                $su->description = "Abonnement de type GOLD";
                $su->dateStart = date('Y-m-d');
                $su->dateEnd = date('Y-m-d', strtotime("+55 days")) ;
                $su->idTransaction = $payment_id;
                $su->save();

            }

            if($id == 4){

                $su = new Souscription();
                $su->idUser = Auth::user()->id;
                $su->idPack = $id;
                $su->description = "Abonnement de type EVASION";
                $su->dateStart = date('Y-m-d');
                $su->dateEnd = date('Y-m-d', strtotime("+12 months")) ;
                $su->idTransaction = $payment_id;
                $su->save();

            }

            if(Auth::user()->invite == 1){

                $nbre = DB::table('souscriptions')->where('idUser',Auth::user()->id)
                ->where('idPack','>=', 1)
                ->where('idPack', '<=',4)
                ->where('id', '!=', $su->id)
                ->count();

                if($nbre == 0){
                    $g = User::find(Auth::user()->invite_by);
                    $g->solde_off = $g->solde_off - 25;
                    $g->solde = $g->solde +25;
                    $g->save();

                    //LEs notifications
                    $noti = new Notif();
                    $noti->idUser_from = Auth::user()->invite_by;
                    $noti->message = "Vous avez obtenu 25 FCFA sur votre compte. ".Auth::user()->name." ".Auth::user()->prenoms." que vous
                    avez affilié vient de faire son premier abonnement";
                    $noti->date_receve = date('Y-m-d');
                    $noti->save();

                }
            }

            }


            return Redirect::route('bibliotheque');
            return redirect()->route('bibliotheque');

        }

        \Session::put('error','Oups, La transaction a échouée, veillez réessayer. Merci !!');
		//return Redirect::route('paywithpaypal');
        return Redirect::route('paiement.start');
    }

}
