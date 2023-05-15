<?php
use Illuminate\Support\Facades\Route;
use App\Providers\FortifyServiceProvider;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

use App\Http\Controllers\admin\CategController;
use App\Http\Controllers\admin\PubController;
use App\Http\Controllers\admin\CollaboController;
use App\Http\Controllers\admin\CarrouselController;
use App\Http\Controllers\admin\CitationController;
use App\Http\Controllers\admin\RetraitController;
use App\Http\Controllers\admin\HomeController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('home', [HomeCOntroller::class, 'page_home'])
    ->middleware('auth:admin')
    ->name('home');

    Route::middleware([ 'auth:admin'])->group(function () {

        //LEs demandes
        Route::prefix('demandes')->name('demande.')->group(function () {

            Route::get('/', [RetraitController::class , "liste_demande"])
            ->name('liste');

            Route::get('/success', [RetraitController::class , "liste_demande_approuver"])
            ->name('success');

            Route::get('/approuve/{id}', [RetraitController::class , "approuver_demande"])
            ->name('approuve');

            Route::post('confirmer', [RetraitController::class, "confirmer_demande"])
            ->name('confirmer');

        });

        //Carrousel
        Route::prefix('carrousel')->name('carrousel.')->group(function () {

            Route::get('/', [CarrouselController::class, 'liste_carr'])
            ->name('liste');

            Route::get('/new', [CarrouselController::class, 'new_carr'])
            ->name('new');

            Route::post('/save', [CarrouselController::class, 'save_carr'])
            ->name('save');

            Route::get('/decision/{dec}/{id}', [CarrouselController::class, 'decision_carr'])
            ->name('decision');

        });

        //Mots et citations
        Route::prefix('word&citation')->name('mot.')->group(function () {

            Route::get('/', [CitationController::class, "liste_mot"])
            ->name('liste');

            Route::get('/new', [CitationController::class, 'new_mot'])
            ->name('new');


            Route::post('/save',[CitationController::class, 'save_mot'])
            ->name('save');

            Route::get('delete/{id}', [CitationController::class, 'delete_mot'])
            ->name('delete');

        });

        //Publications
        Route::prefix('publications')->name('pub.')->group(function () {

            Route::get('/', [PubController::class, "index"])
            ->name('index');

            Route::get('edit/{id}', [PubController::class, "editer_pub"])
            ->name('edit');

            Route::post('edit_save', [PubController::class, "editer_save_pub"])
            ->name('edit_save');

            Route::get('delete/{id}', [PubController::class, "delete_pub"])
            ->name('delete');

            Route::post('/create', [PubController::class, "creer_pub"])
            ->name('create');

            Route::get('/liste', [PubController::class, "liste_pub"])
            ->name('liste');

            Route::get('/attente', [PubController::class, "attente_pub"])
            ->name('attente');

            Route::get('/etude/{id}', [PubController::class, "etudier_pub"])
            ->name('etude');

            Route::post('/decision', [PubController::class, "decision_pub"])
            ->name('decision');

            Route::get('visible/{type}/{id}',  [PubController::class, 'revoir_visibilite'])
            ->name('revoir-decision');

        });

        //Categories
        Route::prefix('categories')->name('categ.')->group(function () {

            Route::get('/', [CategController::class, "index"])
            ->name('index');

            Route::post('/create', [CategController::class, "creer_categ"])
            ->name('create');

            Route::get('/delete/{id}', [CategController::class , "delete_categ"])
            ->name('delete');

            Route::get('/edit/{id}', [CategController::class, "edit_categ"])
            ->name('edit');

            Route::post('/edit_save', [CategController::class, "edit_save_categ"])
            ->name('edit_save');

        });

        //Les collaborateurs
        Route::prefix('collabo')->name('collabo.')->group(function () {

            Route::get('/new', [CollaboController::class, "new_collabo"])
            ->name('new');

            Route::get('/liste', [CollaboController::class , "liste_collabo"]
            )->name('liste');

            Route::post('/save', [CollaboController::class, "new_collabo_save"])
            ->name('save');

            Route::get('/decision/{dec}/{id}', [CollaboController::class, "decision_collabo"])
            ->name('decision');
        });

    });


    Route::get('login',function(){ return view('auth.loginAdmin'); })
    ->middleware(['guest:admin'])
    ->name('login');


    $limiter = config('fortify.limiters.login');
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:admin',
            $limiter ? 'throttle:'.$limiter : null,
        ]));

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:admin')
        ->name('logout');

});
