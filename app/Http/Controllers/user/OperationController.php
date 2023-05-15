<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Redirect;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Publication;
use App\Models\Souscription;
use App\Models\Notif;
use App\Models\Operation;


class OperationController extends Controller
{
    function see_notifs(){

        $data = DB::table('notifs') ->where('idUser_from',Auth::user()->id)
        ->where('vue_from',false)->get();

        foreach ($data as  $value) {
            $n = Notif::find($value->id);
            $n->vue_from = true;
            $n->save();
        }

        $data =DB::table('notifs')->where('idUser_from',Auth::user()->id)
        ->orderByDesc('notifs.id')
        ->paginate(10);

        return view('userView.profils.notifications',['data'=>$data]);
    }

    function lancer_retrait(){
        return view('userView.operations.retrait');
    }

    function save_retrait(Request $req){
        //"montant_retirer":null,"receve_moyen":null,"numero_adresse":null,"info_receve"
        $req->validate([
            'montant_retirer'=>['required', 'numeric' , 'min:1000' ],
            'receve_moyen'=>['required', 'string', 'min:4' ],
            'numero_adresse'=>['required', 'string', ],
            'info_receve'=>['required', 'string'],
        ]);

        if($req['montant_retirer'] <= Auth::user()->solde ){
            //Act
            $op = new Operation();
            $op->idUser = Auth::user()->id;
            $op->solde_moment = Auth::user()->solde;
            $op->montant_retirer = $req['montant_retirer'];
            $op->receve_moyen =  $req['receve_moyen'];
            $op->numero_adresse = $req['numero_adresse'];
            $op->info_receve =$req['info_receve'];
            $op->date_demande = date('Y-m-d');
            $op->save();

            $u = User::find(Auth::user()->id);
            $u->solde = $u->solde - $req['montant_retirer'];
            $u->save();

            $noti = new Notif();
            $noti->idUser_from = Auth::user()->id;
            $noti->message = "Vous avez lancer un retrait de ".$req['montant_retirer']." FCFA de votre compte. Nos administrateurs traitent deja votre demande. Vueillez patienter";
            $noti->date_receve = date('Y-m-d');
            $noti->save();

            return redirect()->route('operation');

        }else{

            $noti = new Notif();
            $noti->idUser_from = Auth::user()->id;
            $noti->message = "Le montant que vous souhaitez retiré est supérieur au solde de votre portefeuil";
            $noti->date_receve = date('Y-m-d');
            $noti->save();

            return redirect()->back()->with('msg',"Le montant que vous souhaitez retiré est supérieur au solde de votre portefeuil");
        }
    }

    function mes_operations(){

        $data =DB::table('operations')->where('idUser',Auth::user()->id)
        ->orderByDesc('operations.id')
        ->paginate(10);

        return view('userView.operations.liste',['data'=>$data]);
    }
}
