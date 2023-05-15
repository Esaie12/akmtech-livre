<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('welcome', function ($view) {
            $carr = DB::table('carrousels')->where('visible', true)->orderByDesc('id')->get();
            $mot_n = DB::table('citations')->where('date_pour', date('Y-m-d'))->orderByDesc('id')->count();
            $mot = DB::table('citations')->where('date_pour', date('Y-m-d'))->orderByDesc('id')->first();

            $view->with(['les_carrousels'=>$carr , 'mot_n'=>$mot_n, 'mot'=>$mot] );
        });

        view()->composer(['*'], function ($view)
        {
            $categ = DB::table('categories')->orderBy('name_categ')->get(['name_categ','id']);


            $view->with('les_categories', $categ );

            if(Auth::check()){
                $ab = DB::table('souscriptions')->where('idUser',Auth::user()->id)
                ->orderByDesc('id')->first();

                $not = DB::table('notifs')->where('vue_from',false)
                ->where('idUser_from',Auth::user()->id)
                ->count();


                $view->with(['abonnement'=> $ab, 'not'=>$not] );

            }

        });

    }
}
