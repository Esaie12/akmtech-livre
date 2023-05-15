<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Administrateur;

class CollaboController extends Controller
{
    function new_collabo(){
        return view('adminView.collabo.new');
    }

    function liste_collabo(){
        $data = DB::table('administrateurs')->get();
        return view('adminView.collabo.liste',['data'=>$data]);
    }

    function new_collabo_save(Request $req){
        //"name":null,"email":null,"mdp
        $req->validate([
            'name'=>['required', 'string', 'max:120'],
            'email'=>['required', 'email'],
            'mdp'=>['required', 'string', 'min:8']
        ]);
        $ad = new Administrateur();
        $ad->name = $req['name'];
        $ad->email = $req['email'];
        $ad->password = $req['mdp'];
        $ad->save();

        return redirect()->route('admin.collabo.liste');

    }

    function decision_collabo($dec , $id){
        $ad = Administrateur::find($id);
        $ad->statut = $dec;
        $ad->save();

        return redirect()->route('admin.collabo.liste');
    }
}
