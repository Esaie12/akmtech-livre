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

class ProfilController extends Controller
{
    function voir_profil(){

        $data = User::find(Auth::user()->id);
        $pub = DB::table('publications')->where('by_admin',false)
        ->where('idUser',Auth::user()->id)->count();

        $af = DB::table('users')->where('invite_by', Auth::user()->id)->count();

        return view('userView.profils.voir',['data'=>$data , 'pub'=>$pub , 'aff'=>$af]);
    }

    function modifier_profil(){
        $data = User::find(Auth::user()->id);

        return view('userView.profils.edit',['data'=>$data]);
    }

    function save_profil(Request $req){

        $req->validate([

            'name'=>['required', 'string', 'max:120'],
            'prenoms'=>['required', 'string','max:200'],
            'birthday'=>['nullable', 'date'],
            'adresse'=>['nullable', 'string', 'max:200'],
            'telephone'=>['nullable', 'numeric'],
            'sexe'=>['nullable', 'string', 'max:2', 'min:1']
        ]);
        //"name":null,"prenoms":null,"birthday":null,"adresse":null,"telephone":null,"sexe":null
        $u = User::find(Auth::user()->id);
        $u->name = $req['name'];
        $u->prenoms = $req['prenoms'];
        $u->birthday = $req['birthday'];
        $u->adresse = $req["adresse"];
        $u->telephone = $req['telephone'];
        $u->sexe = $req['sexe'];
        $u->save();

        return redirect()->route('profil.index')->with('msg',"Profil modifié avec succès");

    }


}
