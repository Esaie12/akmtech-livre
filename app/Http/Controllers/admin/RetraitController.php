<?php

namespace App\Http\Controllers\admin;

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

class RetraitController extends Controller
{
    function liste_demande(){

         $data =DB::table('operations')
        ->select(['operations.*', 'users.name', 'users.prenoms'])
        ->join('users', 'operations.idUser', 'users.id')
        ->where('etat_demande',0)
        ->orderByDesc('operations.id')
        ->paginate(10);

        return view('adminView.retrait.liste',['data'=>$data]);
    }

    function liste_demande_approuver(){

        $data =DB::table('operations')
       ->select(['operations.*', 'users.name', 'users.prenoms'])
       ->join('users', 'operations.idUser', 'users.id')
       ->where('etat_demande','!=' ,0)
       ->orderByDesc('operations.id')
       ->paginate(10);

       return view('adminView.retrait.listeSuccess',['data'=>$data]);
   }

    function approuver_demande($id){

        $data =DB::table('operations')->select(['operations.*', 'users.name', 'users.prenoms'])
        ->join('users', 'operations.idUser', 'users.id')
        ->where('operations.id',$id)
        ->orderByDesc('operations.id')
        ->first();

        return view('adminView.retrait.success',['item'=>$data]);
    }

    function confirmer_demande(Request $req){
        $req->validate([
            'idOpe'=>['required', 'numeric', 'min:1'],
            'image'=>['required', 'file', 'mimes:pdf,png,jpeg,jpg']
        ]);
        $chemin = $req->file('image')->store('upload/img_retrait', 'public');

        $op = Operation::find($req['idOpe']);
        $op->etat_demande = 1;
        $op->etude_by_idAdmin = Auth::user()->id;
        $op->preuve_envoie = $chemin;
        $op->date_reponse = date('Y-m-d');
        $op->save();

        $us = User::find(Auth::user()->id);
        $us->solde = $us->solde - $op->montant_retirer;
        $us->save();

        $noti = new Notif();
        $noti->idUser_from = $op->idUser;
        $noti->message = "La demande de retrait de ".$op->montant_retirer." Fcfa que vous avez lancée le"
        .$op->date_demande." vient d'etre approuver. Veillez verifier votre compte ".$op->receve_moyen;
        $noti->date_receve = date('Y-m-d');
        $noti->save();

        return redirect()->route('admin.demande.liste');

    }
}
