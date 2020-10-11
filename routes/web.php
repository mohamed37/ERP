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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Auth::routes();



        Route::get('/', function () {
                    return view('welcome');
        });





       Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Backend'], function () {
        //ROUTE HOMECONTROLLER
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('Dashboard', 'HomeController@indexDashboard')->name('dashboardHome');

           //ROUTE USERS
         Route::get('rows', 'UsersController@rows')->name('rows');

         Route::get('multi-delete', 'UsersController@multidelete')->name('multidelete');

         Route::resource('users', 'UsersController');



       });

       //ROUTE FOR FORNTEND

       Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'Forntend'], function () {


       });


    });


