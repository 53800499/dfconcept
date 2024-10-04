<?php
use Illuminate\Support\Facades\Route;
use App\http\Controllers\AdminController;
use App\http\Controllers\CategoryController;
use App\http\Controllers\ClientController;
use App\http\Controllers\ProductController;
use App\http\Controllers\SliderController;

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

Route::get('/', "ClientController@home");
Route::get('/shop',"ClientController@shop" );
Route::get('/panier', "ClientController@panier");
Route::get('/paiement', "ClientController@paiement");
Route::get('/loginup', "ClientController@login");
Route::get('/signup', "ClientController@signup");
Route::post('/creer_compte','ClientController@creer_compte');
Route::post('/acceder_compte','ClientController@acceder_compte');
Route::get('/logout', "ClientController@logout");
Route::get('/ajouter_panier/{id}','ClientController@ajouter_panier');
Route::post('/modifier_panier/{id}','ClientController@modifier_panier');
Route::get('/retirer_produit_panier/{id}','ClientController@retirer_produit_panier');





Route::get('/admin', "AdminController@admin");



Route::get('/ajouterCategory', "CategoryController@ajouterCategory");
Route::post('/sauvercategorie', "CategoryController@sauvercategorie");
Route::get('/categories', "CategoryController@categories");
Route::get('/editcategory/{id}', "CategoryController@editcategory");
Route::post('/modifiercategory/{id}', "CategoryController@modifiercategory");
Route::post('/supprimercategory', "CategoryController@supprimercategory");
Route::get('/select_par_cat/{name}', "CategoryController@select_par_cat");



Route::get('/ajouterproduit', 'ProductController@ajouterproduit');
Route::post('/sauverproduit', 'ProductController@sauverproduit');
Route::get('/produit', 'ProductController@produit');
Route::get('/editproduit/{id}', 'ProductController@editproduit');
Route::post('/modifierproduit/{id}', 'ProductController@modifierproduit');
Route::get('/supprimerproduit/{id}', 'ProductController@supprimerproduit');
Route::get('/activer_produit/{id}', 'ProductController@activer_produit');
Route::get('/desactiver_produit/{id}', 'ProductController@desactiver_produit');




Route::get('/ajouterslider', 'SliderController@ajouterslider');
Route::post('/sauverslider', 'SliderController@sauverslider');
Route::get('/slider', 'SliderController@slider');
Route::get('/editslider/{id}', 'SliderController@editslider');
Route::post('/modifierslider/{id}', 'SliderController@modifierslider');
Route::get('/supprimerslider/{id}', 'SliderController@supprimerslider');
Route::get('/activer_slider/{id}', 'SliderController@activer_slider');
Route::get('/desactiver_slider/{id}', 'SliderController@desactiver_slider');


