<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

class HomeController extends Controller
{
    function page_home(){
        $us = DB::table('users')->count();
        $pub = DB::table('publications')->where('by_admin', 1)->count();
        $pub_us = DB::table('publications')->where('by_admin', 0)->count();
        $ret = DB::table('operations')->where('etat_demande',0)->count();

        return view('adminView.home',[
            'users'=>$us,
            'pub'=>$pub,
            'pub_us'=>$pub_us,
            'retrait'=>$ret
        ]);
    }
}
