<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Categorie;
use App\Models\Publication;
use App\Models\Notif;

class PubController extends Controller
{
    function index(){
        return view('adminView.publication.index');
    }

    function creer_pub(Request $req){
        //categ_pub":null,"titre_pub":null,"auteur_pub":null,"lien_pub":null,"description_pub"
        $req->validate([
            'categ_pub'=>['required', 'numeric', 'min:1'],
            'titre_pub'=>['required', 'string', 'max:170'],
            'auteur_pub'=>['required', 'string', 'max:170'],
            'lien_pub'=>['required', 'string', 'max:170'],
            'description_pub'=>['nullable', 'string', 'max:230'],
            'photo_pub'=>['required', 'file', 'mimes:jpg,png,jpeg'],
        ]);

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

        $pub->save();

        return redirect()->route('admin.pub.liste')->with('msg-success',"LIvre publié avec succès");
    }

    function liste_pub(){

        $data = DB::table('publications')
        ->select('publications.*')
        ->where('by_admin', true)
        ->orderByDesc('id')->paginate(10);

        return view('adminView.publication.liste',['publications'=>$data]);

    }

    function attente_pub(){
        $data = DB::table('publications')
        ->select(['publications.*', 'users.name', 'users.prenoms'])
        ->join('users', 'publications.idUser', 'users.id')
        //->where('idUser', Auth::user()->id)
        ->where('by_admin', false)
        ->orderByDesc('id')->paginate(10);

        return view('adminView.publication.attente',['pubs'=>$data]);
    }

    function etudier_pub($id){

        $data = DB::table('publications')
        ->select(['publications.*', 'users.name', 'users.prenoms', 'users.email'])
        ->join('users', 'publications.idUser','users.id')
        ->where('publications.id', $id)->first();

        return view('adminView.publication.etude',['pub'=>$data]);
    }

    function decision_pub(Request $req){
        //"idPub":"1","decision":

        $req->validate([
            'decision'=>['required', 'numeric', 'min:0', 'max:1'],
        ]);

        if($req['decision'] == 1){
            $req->validate([
                'idPub'=>['required', 'numeric', 'min:1']
            ]);
            $p = Publication::find($req['idPub']);
            $p->etat_demande = 1 ;

            if($p->with_plan == 0){
                $p->visible_pub = 1;
            }

            $p->save();


            $noti = new Notif();
            $noti->idUser_from = $p->idUser;
            $noti->message = "Votre livre ".$p->titre_pub." vient d'etre valider par les administrateurs. Il est
            désormais visible sur la plateforme";
            $noti->date_receve = date('Y-m-d');
            $noti->save();



        }

        if($req['decision'] == 0){
            $req->validate([
                'idPub'=>['required', 'numeric', 'min:1'],
                'raison'=>['required', 'string', 'max:300'],
            ]);

            $p = Publication::find($req['idPub']);
            $p->etat_demande = 2 ;
            $p->raison_rejet = $req['raison'];

            $p->save();

            $noti = new Notif();
            $noti->idUser_from = $p->idUser;
            $noti->message = "Votre livre ".$p->titre_pub." a été rejetter par les administrateurs. Il ne sera pas visible sur la plateforme, veillez modifier le contenu";
            $noti->date_receve = date('Y-m-d');
            $noti->save();


        }

        return redirect()->route('admin.pub.attente')->with('msg',"Ca marche");

    }

    function revoir_visibilite($type , $idPub){

        if( in_array($type , array(0,1))){

            $pub = Publication::find($idPub);
            $pub->visible_pub = $type;
            $pub->save();

        }

        return redirect()->back();
    }

    function delete_pub($id){
        $r = Publication::find($id);
        $r->delete();

        return redirect()->back();
    }

    function editer_pub($id){
        return view('adminView.publication.edit',['data'=>Publication::find($id)]);
    }

    function editer_save_pub(Request $req){
        $req->validate([
            'id'=>['required', 'numeric', 'min:1'],
            'categ_pub'=>['required', 'numeric', 'min:1'],
            'titre_pub'=>['required', 'string', 'max:170'],
            'auteur_pub'=>['required', 'string', 'max:170'],
            'lien_pub'=>['required', 'string', 'max:170'],
            'description_pub'=>['nullable', 'string', 'max:170'],
            'photo_pub'=>['nullable', 'file', 'mimes:jpg,png,jpeg'],
        ]);



        $pub =  Publication::find($req['id']);

        $pub->idCategorie = $req['categ_pub'];
        $pub->titre_pub = $req['titre_pub'];
        $pub->auteur_pub = $req['auteur_pub'];
        $pub->description_pub = $req['description_pub'];
        $pub->lien_pub = $req['lien_pub'];

        if($req['photo_pub'] != null){
            $chemin =  $req->file('photo_pub')->store('upload/img_livre', 'public');
            $pub->photo_pub = $chemin;
        }

        $pub->save();

        return redirect()->route('admin.pub.liste')->with('msg-success',"LIvre publié avec succès");
    }
}
