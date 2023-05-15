<?php

use Illuminate\Support\Facades\Route;
use App\Providers\FortifyServiceProvider;

use App\Http\Controllers\PersonnelController;

use App\Http\Controllers\user\ProfilController;
use App\Http\Controllers\user\WelcomeController;
use App\Http\Controllers\user\LivreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\user\OperationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/loginadmin', function () {
    return redirect()->route('admin.login');
})->name('loginadmin');

Route::get('/ok', function () {
    return view('userView.home');
});

Route::get('/', [WelcomeController::class , 'welcome_page'])
->name('welcome');
/*invite=true&code=*/

Route::get('invite/{code}', [WelcomeController::class, "invitation_register"])
->name('register.invite');

Route::middleware(['auth:web' , 'verified'])->group(function () {

    Route::get('/home',[WelcomeController::class , 'welcome_page'])
    ->name('home');

    Route::get('read/{id}', [LivreController::class , "visiter_pub"])
    ->name('read');

    Route::prefix('profils')->name('profil.')->group(function () {

        Route::get('/', [ProfilController::class, "voir_profil"])
        ->name('index');

        Route::get('/edit', [ProfilController::class, "modifier_profil"])
        ->name('edit');

        Route::post('/edit_save', [ProfilController::class, "save_profil"])
        ->name('edit.save');

    });

    Route::get('notifications', [OperationController::class, 'see_notifs'])
    ->name('notif');

    Route::get('operations', [OperationController::class, 'mes_operations'])
    ->name('operation');

    Route::get('retrait/request', [OperationController::class , 'lancer_retrait'])
    ->name('retrait_index');

    Route::post('retrait/save', [OperationController::class , 'save_retrait'])
    ->name('retrait.save');


    Route::prefix('publier')->group(function () {

        Route::get('/', [LivreController::class, 'liste_pub'])
        ->name('publier');

        Route::get('/new', [LivreController::class, 'nouvelle_publication'])
        ->name('publier.new');

        Route::post('/save', [LivreController::class, 'publier_save'])
        ->name('publier.save');

        Route::get('paid-boost/{id}', [LivreController::class, 'paid_boostage'] )
        ->name('publier.paid');

        Route::get('/effacer/{id}', [LivreController::class, 'effacer_publication'])
        ->name('publier.delete');


        Route::get('/edit/{id}', [LivreController::class, 'modifier_pub'])
        ->name('publier.editer');

        Route::post('/edit-save', [LivreController::class, 'modifier_save'])
        ->name('publier.edit.save');

        Route::get('paid/{id}', [LivreController::class, 'publier_paid'])
        ->name('publier.get_paid');

    });

    Route::get('abonnement/{id}/{type}',[LivreController::class, "abonnement"])
    ->name('abonnement');

    Route::get('paywithpaypal', [PaiementController::class , 'payWithPaypal'])->name('paywithpaypal');
    Route::post('paypal', [PaiementController::class , 'postPaymentWithpaypal' ] )->name('paypal');
    Route::get('paypal', [PaiementController::class ,'getPaymentStatus' ])->name('status');


});

Route::get('/bibliotheque', [WelcomeController::class , 'bibliotheques'])
->name('bibliotheque');

Route::get('/book/{id}/{name}', [WelcomeController::class , 'book_categ'])
->name('book_categ');

Route::get('search', [WelcomeController::class , 'page_recherche'])
->name('search');

Route::get('start_recherche', [WelcomeController::class, 'start_page_recherche'])
->name('start_page_recherche');

Route::get('/tarif', function () {
    return view('tarifs');
})->name('tarif');

require __DIR__.'/admin.php';

/*
E:\Projet Web\Templ\templates\MDangle2\themicon.co\theme\mdangle\v1.0\static-html\app
*/
