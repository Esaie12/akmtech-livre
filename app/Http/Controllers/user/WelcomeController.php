<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Categorie;
use App\Models\Publication;

class WelcomeController extends Controller
{
    function page_recherche(){
        return view('userView.search');
    }
    function start_page_recherche(Request $req){

        $req->validate([
            'titre'=>['nullable', 'string', 'max:170'],
            'categorie'=>['numeric' , 'required', 'min:0']
        ]);
        $d = Publication::query();

        $data = DB::table('publications')
        ->where('visible_pub',1);

        if(isset($req['titre'])){
            $data = $data->where('titre_pub', 'like', '%'.$req['titre'].'%');
        }
        if($req['categorie'] >0){
            $data = $data->where('idCategorie', $req['categorie']);
        }

        $data = $data->orderByDesc('id')
        ->paginate(8);

        return view('userView.search',['publications'=>$data , 'titre'=>$req['titre'] , 'categorie'=>$req['categorie'], 'resultat'=>1]);
    }

    function welcome_page(){

        $data = DB::table('publications')->where('visible_pub',1)
        ->inRandomOrder()->limit(8)->get();
        return view('welcome',['publications'=>$data]);

    }

    function bibliotheques(){
        $data = DB::table('publications')->where('visible_pub',1)
        ->orderByDesc('id')
        ->paginate(8);
        return view('userView.biblio',['publications'=>$data]);
    }

    function book_categ($id, $name){

        $data = DB::table('publications')->where('idCategorie',$id)
        ->orderByDesc('id')
        ->paginate(4);

        return view('userView.categBook',['publications'=>$data , 'name'=>$name]);

    }

    function invitation_register($code) {
        $nb = DB::table('users')->where('code_invitation', $code)
        ->count();

        if($nb == 0){
            return "non juste";
            return redirect()->back();

        }else{

            $data = DB::table('users')->where('code_invitation', $code)
            ->first();
            return view('auth.registerInvite',['idUser'=>$data->id , 'nameUser'=>$data->name." ".$data->prenoms]);
        }

    }
}
