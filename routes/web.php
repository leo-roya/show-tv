<?php

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

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('shows', 'ShowController');

//Authenticated Users
Route::group(['middleware'=>'auth'], function() {

    /********************
     * TV Episodes Routes (under construction)
     *******************/
    /*1*/ Route::get('shows/{show}/episodes',['uses'=>'EpisodeController@index']);


    /******************
     * TV Shows Routes
     *****************/

    //All users
    /*1*/ Route::get('shows',['uses'=>'ShowController@index']);

    /********
     * Admin
     ********/
    /*3*/ Route::post('shows',['middleware'=>'check-permission:admin|superadmin','as'=>'shows.store','uses'=>'ShowController@store']);
    /*2*/ Route::get('shows/create',['middleware'=>'check-permission:admin|superadmin','uses'=>'ShowController@create']);
    /*5*/ Route::get('shows/{show}/edit',['middleware'=>'check-permission:admin|superadmin','uses'=>'ShowController@edit']);
    /*6*/ Route::put('shows/{show}',['middleware'=>'check-permission:admin|superadmin','as'=>'shows.update', 'uses'=>'ShowController@update']);
    /*7*/ Route::patch('shows/{show}',['middleware'=>'check-permission:admin|superadmin','uses'=>'ShowController@update']);
    /*4*/ Route::get('shows/{show}',['uses'=>'ShowController@show']);

//    /*8*/ Route::delete('shows/{show}',['middleware'=>'check-permission:user|admin|superadmin','uses'=>'ShowController@destroy']);
});


/*
 * For testing purposes
 */
Route::group(['middleware'=>'auth'], function() {
    Route::get('permissions-all-users',['middleware'=>'check-permission:user|admin|superadmin','uses'=>'HomeController@allUsers']);
    Route::get('permissions-admin-superadmin',['middleware'=>'check-permission:admin|superadmin','uses'=>'HomeController@adminSuperadmin']);
    Route::get('permissions-superadmin',['middleware'=>'check-permission:superadmin','uses'=>'HomeController@superadmin']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
