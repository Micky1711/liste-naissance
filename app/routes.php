<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('uses' => 'PageController@getHomepage', 'as' => 'homepage'));
Route::get('/informations', array('uses' => 'PageController@getInformation', 'as' => 'informations'));
Route::get('/liste-de-naissance', array('uses' => 'ProductsController@getListe', 'as' => 'liste'));
Route::post('/liste-de-naissance', array('uses' => 'ProductsController@postListe', 'as' => 'reservation'));
Route::get('/financement-libre', array('uses' => 'FinancementsController@getLibre', 'as' => 'libre'));

Route::post('/financement-libre', array('uses' => 'FinancementsController@postLibre', 'as' => 'libre.post'));

Route::get('/mailing1', array('uses' => 'EmailsController@getTest', 'as' => 'mail'));

/* Routes pour les connaissances */   
Route::group(array('prefix' => 'nos-proches'), function(){
	/* LOGIN */
	Route::get('identification', array('before' => 'guest', 'uses' => 'UserController@getLogin', 'as' => 'login'));
	Route::post('identification', array('before' => array('guest','csrf'), 'uses' => 'UserController@postLogin'));
	/* LOGOUT */
	Route::get('logout', array('before' => 'auth', 'uses' => 'UserController@getLogout', 'as' => 'logout'));
	/* REGISTER */
	Route::post('inscription', array('before' => array('guest', 'csrf'), 'uses' => 'UserController@postRegister', 'as' => 'register'));

	Route::post('registerexpress', array('before' => array('guest', 'csrf'), 'uses' => 'UserController@postRegisterExpress'));
	Route::post('loginexpress', array('before' => array('guest', 'csrf'), 'uses' => 'UserController@postLoginExpress'));
	Route::get('register_confirmation/{id}-{email}-{key}', array('before' => 'guest', 'uses' => 'UserController@getConfirmation', 'as' => 'registrer_confirmation'));
	Route::get('register_confirmation', array('before' => 'guest', 'uses' => 'UserController@getConfirmationError', 'as' => 'registrer_confirmation_result'));
	/* MOT DE PASSE PERDU */
	Route::get('mot-de-passe-perdu', array('before' => 'guest', 'uses' => 'UserController@getLostpassword', 'as' => 'lostpassword'));
	Route::post('mot-de-passe-perdu', array('before' => array('guest', 'csrf'), 'uses' => 'UserController@postLostpassword'));
	Route::get('confirm_password/{email}/{key}', array('before' => 'guest', 'uses' => 'UserController@getConfirmpassword', 'as' => 'confirmpassword'));
	/* AFFICHAGE ET MODIFICATION DU PROFIL */
	Route::get('profil', array('before' => 'auth', 'uses' => 'UserController@getProfil', 'as' => 'profil'));
	Route::post('profil', array('before' => array('auth', 'csrf'), 'uses' => 'UserController@postProfil'));

	Route::get('offres', array('before' => 'auth', 'uses' => 'ProductsController@getUserListe', 'as' => 'offres'));
	Route::post('renoncement', array('uses' => 'ProductsController@postUserRenoncement', 'as' => 'renoncement'));

	Route::get('{id}-{slug}', array('uses' => 'ProductsController@getArticle', 'as' => 'article'))->where(array("id" => "[0-9]+"));
	Route::get('mes-offres', array('uses' => 'GiftController@getListe', 'as' => 'ma-liste'));
	Route::get('paypal', array('uses' => 'GiftsController@getPaypal', 'as' => 'paypal'));
	Route::post('paypal', array('uses' => 'GiftsController@postPaypal', 'as' => 'paypal'));

	/* PAYPAL */
	Route::get('paypal/cancel', array('uses' => 'GiftsController@getPaypalCancel', 'as' => 'paypal.cancel'));
	Route::get('paypal/return/{commande}/{key}', array('uses' => 'GiftsController@getPaypalReturn', 'as' => 'paypal.return'));
	Route::post('paypal/notify', array('uses' => 'GiftsController@postPaypalNotify', 'as' => 'paypal.notify'));
	Route::get('paypal/notify', array('uses' => 'GiftsController@postPaypalNotify', 'as' => 'paypal.notify'));

});


/* Routes de test pour les email */   
Route::group(array('prefix' => 'emails'), function(){
	/* LOGIN */
	Route::get('reservations', array('uses' => 'EmailsController@getReservations', 'as' => 'emails.reservations'));
});

/* Routes pour le backoffice */   
Route::group(array('prefix' => 'parents'), function(){
	Route::get('/', array('uses' => 'AdminController@getIndex', 'as' => 'admin'));
	Route::get('ma-liste/', array('uses' => 'ProductsController@getAdminListe', 'as' => 'admin.products.liste'));
	Route::get('nouveau-produit/', array('uses' => 'ProductsController@getAdminAdd', 'as' => 'admin.products.add'));
	Route::post('nouveau-produit/', array('uses' => 'ProductsController@postAdminAdd'));
	Route::get('mon-produit/{id}', array('uses' => 'ProductsController@getAdminAdd', 'as' => 'admin.products.edit'))->where(array("id" => "[0-9]+"));
	Route::post('mon-produit/{id}', array('uses' => 'ProductsController@postAdminAdd'))->where(array("id" => "[0-9]+"));
	Route::get('produit-del/{id}', array('uses' => 'ProductsController@getAdminAdd', 'as' => 'admin.products.delete'))->where(array("id" => "[0-9]+"));
	Route::get('produit-info/{id}', array('uses' => 'ProductsController@getAdmininfo', 'as' => 'admin.products.info'))->where(array("id" => "[0-9]+"));

	Route::get('/logs/{page}', array('uses' => 'MylogController@getAdminListe', 'as' => 'admin.logs'))->where(["page" => "[0-9]+"]);
	Route::get('/reservations/{page}', array('uses' => 'GiftsController@getAdminListe', 'as' => 'admin.gifts'))->where(["page" => "[0-9]+"]);
	Route::get('/offres/{page}', array('uses' => 'FinancementsController@getAdminListe', 'as' => 'admin.financements'))->where(["page" => "[0-9]+"]);
	Route::get('/users/{page}', array('uses' => 'UserController@getAdminListe', 'as' => 'admin.users'))->where(["page" => "[0-9]+"]);
	Route::get('/users/fiche/{id}', array('uses' => 'UserController@getAdminEdit', 'as' => 'admin.users.fiche'))->where(["id" => "[0-9]+"]);
	Route::post('/users/fiche', array('uses' => 'UserController@postAdminEdit', 'as' => 'admin.users.fiche.post'))->where(["id" => "[0-9]+"]);

	Route::post('/mylogs/{name}', array('uses' => 'MylogController@postAdminRead'));

});

/* Routes pour l'upload d'image du backoffice */
Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');