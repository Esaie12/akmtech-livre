<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Redirect;

use App\Models\Categorie;
use App\Models\Publication;
use App\Models\Souscription;
use App\Models\Notif;
use App\Models\User;
use App\Models\Mesvue;

class LivreController extends Controller
{
    function nouvelle_publication(){
        return view('userView.publications.new');
    }
    function liste_pub(){
        $data = DB::table('publications')
        ->where('idUser', Auth::user()->id)->where('by_admin', false)
        ->get();

        return view('userView.publications.liste',['pubs'=>$data]);
    }

    function publier_save(Request $req){
        //categ_pub":null,"titre_pub":null,"auteur_pub":null,"lien_pub":null,"description_pub"
        $req->validate([
            'categ_pub'=>['required', 'numeric', 'min:1'],
            'titre_pub'=>['required', 'string', 'max:170'],
            'auteur_pub'=>['required', 'string', 'max:170'],
            'lien_pub'=>['required', 'string', 'max:170'],
            'description_pub'=>['nullable', 'string', 'max:230'],
            'photo_pub'=>['required', 'file', 'mimes:jpg,png,jpeg'],
            'booster'=>['required', 'numeric', 'min:0', 'max:1'],
            'boost_id'=>['nullable', 'numeric', 'min:1'],
        ]);

        if($req['booster'] == 1){
            $req->validate([
                'boost_id'=>['required','min:1', 'numeric'],
            ]);
        }

        $chemin =  $req->file('photo_pub')->store('upload/img_livre', 'public');

        $pub = new Publication();
        $pub->idUser = Auth::user()->id;
        $pub->idCategorie = $req['categ_pub'];
        $pub->titre_pub = $req['titre_pub'];
        $pub->auteur_pub = $req['auteur_pub'];
        $pub->description_pub = $req['description_pub'];
        $pub->lien_pub = $req['lien_pub'];
        $pub->photo_pub = $chemin;
        $pub->date_pub = date('Y-m-d');
        $pub->visible_pub = false;
        $pub->by_admin = false;

        if($req['booster'] == 1){
            $pub->with_plan = true;
            $pub->type_plan = $req['boost_id'];
            $pub->etat_paiement = false;
        }else{
            $pub->with_plan = false;
        }

        $pub->save();

        return redirect()->route('publier')->with('msg-success',"LIvre publié avec succès");
    }

    function publier_paid($id){
        $pub = Publication::find($id);
        return view('userView.publications.paidBoost',['data'=>$pub]);
    }

    function paid_boostage(Request $req , $id){

        if($req['transaction-status'] != "approved"){
            return redirect()->back();
        }

        $pub = Publication::find($id);
        $pub->id_transaction = $req['transaction-id'];
        $pub->etat_paiement = 1;
        $pub->date_paiement = date('Y-m-d');
        $pub->visible_pub = 1;
        $pub->save();

        return redirect()->route('publier');
    }

    function visiter_pub($id){

        $sous = DB::table('souscriptions')
        ->where('idUser', Auth::user()->id)
        ->orderByDesc('id')
        ->first();


        if($sous->dateEnd != null and $sous->dateEnd >= date('Y-m-d')){

            $pub = Publication::find($id);

            //use App\Models\Mesvue;
            $v_c = DB::table('mesvues')->where('idUser',Auth::user()->id)
            ->where('idLivre',$id)->count();

            if($v_c == 0){
                $v = new Mesvue();
                $v->idUser = Auth::user()->id;
                $v->idLivre = $id;
                $v->date_vue = date('Y-m-d');
                $v->save();
            }

            $pub->count_view = $pub->count_view +1;
            $pub->save();

            $url = $pub->lien_pub;

            return redirect()->away($url);

        }else{
            return redirect()->route('tarif')->with('msg',"Vous n'avez aucun abonnement en cours. Veuillez souscrire à un des packs ci-dessous, pour profitez de nos livres.");
        }

    }

    function abonnement(Request $req ,$id , $type){

        if($req['transaction-status'] != "approved"){
            return redirect()->back()->with('msg', "Transaction non reussie, veuillez réesayer");
        }

        if($id == 1){

            $su = new Souscription();
            $su->idUser = Auth::user()->id;
            $su->idPack = $id;
            $su->description = "Abonnement de type ".$type;
            $su->dateStart = date('Y-m-d');
            $su->dateEnd = date('Y-m-d', strtotime("+4 days")) ;
            $su->idTransaction = $req['transaction-id'];
            $su->save();

        }

        if($id == 2){

            $su = new Souscription();
            $su->idUser = Auth::user()->id;
            $su->idPack = $id;
            $su->description = "Abonnement de type ".$type;
            $su->dateStart = date('Y-m-d');
            $su->dateEnd = date('Y-m-d', strtotime("+25 days")) ;
            $su->idTransaction = $req['transaction-id'];
            $su->save();


            return "march".$id;

        }

        if($id == 3){

            $su = new Souscription();
            $su->idUser = Auth::user()->id;
            $su->idPack = $id;
            $su->description = "Abonnement de type ".$type;
            $su->dateStart = date('Y-m-d');
            $su->dateEnd = date('Y-m-d', strtotime("+55 days")) ;
            $su->idTransaction = $req['transaction-id'];
            $su->save();

        }

        if($id == 4){

            $su = new Souscription();
            $su->idUser = Auth::user()->id;
            $su->idPack = $id;
            $su->description = "Abonnement de type ".$type;
            $su->dateStart = date('Y-m-d');
            $su->dateEnd = date('Y-m-d', strtotime("+12 months")) ;
            $su->idTransaction = $req['transaction-id'];
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
                $g->solde = $g->solde +25;
                $g->solde_off = $g->solde_off - 25;
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


        return redirect()->route('bibliotheque');


    }

    function effacer_publication($id){
        $pub = Publication::find($id);
        $pub->delete();

        return redirect()->back();
    }

    function modifier_pub($id){
        $pub = Publication::find($id);
        return view('userView.publications.modifier',['data'=>$pub]);
    }

    function modifier_save(Request $req){
        $req->validate([
            'idPub'=>['required', 'numeric', 'min:1'],
            'categ_pub'=>['required', 'numeric', 'min:1'],
            'titre_pub'=>['required', 'string', 'max:170'],
            'auteur_pub'=>['required', 'string', 'max:170'],
            'lien_pub'=>['required', 'string', 'max:170'],
            'description_pub'=>['nullable', 'string', 'max:170'],
            'photo_pub'=>['nullable', 'file', 'mimes:jpg,png,jpeg'],
            'booster'=>['required', 'numeric', 'min:0', 'max:1'],
            'boost_id'=>['nullable', 'numeric', 'min:1'],
        ]);

        if($req['booster'] == 1){
            $req->validate([
                'boost_id'=>['required','min:1', 'numeric'],
            ]);
        }



        $pub = Publication::find($req['idPub']);

        $pub->idCategorie = $req['categ_pub'];
        $pub->titre_pub = $req['titre_pub'];
        $pub->auteur_pub = $req['auteur_pub'];
        $pub->description_pub = $req['description_pub'];
        $pub->lien_pub = $req['lien_pub'];

        if($req['photo_pub'] != null){

            $chemin =  $req->file('photo_pub')->store('upload/img_livre', 'public');
            $pub->photo_pub = $chemin;
        }

        if($req['booster'] == 1){
            $pub->with_plan = true;
            $pub->type_plan = $req['boost_id'];
            $pub->etat_paiement = false;
        }else{
            $pub->with_plan = false;
        }

        $pub->save();

        return redirect()->route('publier')->with('msg-success',"LIvre modfié avec succès");
    }

}
