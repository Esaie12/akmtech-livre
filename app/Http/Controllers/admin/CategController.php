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

class CategController extends Controller
{
    function index(){
        $data = DB::table('categories')->get();

        return view('adminView.categorie.index',['categories'=>$data]);
    }

    function creer_categ(Request $req){

        //"name_categ":null,"description_categ":null,"visible":
        $req->validate([
            'name_categ'=>['required', 'string', 'min:5', 'max:170'],
            'description_categ'=>['nullable', 'string'],
        ]);

        $cat = new Categorie();
        $cat->name_categ = $req['name_categ'];
        //$cat-> = $req[''];
        $cat->date_add_categ = date('Y-m-d');
        $cat->save();

        return redirect()->route('admin.categ.index')->with('msg-success', "Catégorie enregistrée avec succès");
    }

    function delete_categ($id){
        $cate= Categorie::find($id);
        $cate->delete();
        return redirect()->route('admin.categ.index')->with('msg-success', "Catégorie supprimée avec succès");
    }

    function edit_categ($id){
        $cate = Categorie::find($id);
        return view('adminView.categorie.edit',['data'=>$cate]);
    }

    function edit_save_categ(Request $req){
        $req->validate([
            'id'=>['required', 'numeric', 'min:1'],
            'name_categ'=>['required', 'string', 'min:5', 'max:170'],
            'description_categ'=>['nullable', 'string'],
        ]);

        $cat = Categorie::find($req['id']);
        $cat->name_categ = $req['name_categ'];
        $cat->save();

        return redirect()->route('admin.categ.index')->with('msg-success', "Catégorie enregistrée avec succès");
    }
}
