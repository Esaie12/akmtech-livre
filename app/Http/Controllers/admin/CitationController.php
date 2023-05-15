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
use App\Models\Citation;

class CitationController extends Controller
{
    function delete_mot($id){
        $d = Citation::find($id);
        $d->delete();

        return redirect()->route('admin.mot.liste');
    }

    function liste_mot(){
        $data = DB::table('citations')->orderByDesc('date_pour')
        ->paginate(5);

        return view('adminView.mot.liste',['data'=>$data]);
    }

    function new_mot(){
        return view('adminView.mot.new');
    }

    function save_mot(Request $req){
        //"mot_day":null,"definition_mot":null,"citation_day":null,"citation_auteur":null,"date_pour"
        $req->validate([
            'mot_day'=>['required', 'string', 'max:75'],
            'definition_mot'=>['required', 'string', 'max:254'],
            'citation_day'=>['required', 'string'],
            'date_pour'=>['date', 'required'],
            'citation_auteur'=>['required', 'string', 'max:100']
        ]);
        $c = new Citation();
        $c->idAdmin = Auth::user()->id;
        $c->date_pour = $req['date_pour'];
        $c->mot_day = $req['mot_day'];
        $c->definition_mot = $req['definition_mot'];
        $c->citation_day = $req['citation_day'];
        $c->citation_auteur = $req['citation_auteur'];
        $c->save();

        return redirect()->route('admin.mot.liste');
    }
}
