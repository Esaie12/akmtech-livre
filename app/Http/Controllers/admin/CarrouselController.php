<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Categorie;
use App\Models\Publication;
use App\Models\Notif;
use App\Models\Carrousel;

class CarrouselController extends Controller
{
    function new_carr(){
        return view('adminView.carrousel.new');
    }

    function liste_carr(){

        $data = DB::table('carrousels')->orderByDesc('id')
        ->get();

        return view('adminView.carrousel.liste',['data'=>$data]);
    }

    function save_carr(Request $req){
        //name":null,"description":null,"image
        $req->validate([
            'name'=>['required', 'string', 'max:150'],
            'description'=>['nullable' ,'string', 'max:200'],
            'image'=>['required','file', 'mimes:png,jpg,jpeg']
        ]);
        $chemin =  $req->file('image')->store('upload/img_carrousel', 'public');

        $ca = new Carrousel();
        $ca->idAdmin = AUth::user()->id;
        $ca->titre= $req['name'];
        $ca->description = $req['description'];
        $ca->image =  $chemin;
        $ca->date_add = date('Y-m-d');
        $ca->save();

        return redirect()->route('admin.carrousel.liste')->with('msg', "Carrousel actif");

    }
    function decision_carr($dec, $id){
        $ca = Carrousel::find($id);
        $ca->visible = $dec;
        $ca->save();

        return redirect()->back();
    }
}
