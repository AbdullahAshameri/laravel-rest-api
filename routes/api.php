<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// All Routes /  API hear must be authenticated
Route::group(['middleware' => ['api', 'checkpassword', 'changelanguage'], 'namespace' => 'Api'], function() {

    Route::post('get-main-categrories', 'categoriesController@index');
    Route::post('get-category-byId', 'CategoriesController@getCategoryById');
    Route::post('change-category-status', 'CategoriesController@changeStatus');
    Route::post('change-category-status', 'CategoriesController@changeStatus');

    //admin api
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout')->middleware('auth.guard:admin-api');

    });

    //user api
    Route::group(['prefix' => 'user', 'middleware' => 'auth.guard:user-api'], function () {
        Route::post('profile', function () {
            return 'Onlay Authenticated User Can Reach Me';
        });

    });
});

Route::group(['middleware' => ['api', 'checkpassword', 'changelanguage', 'checkAdminToken:admin-api'], 'namespace' => 'Api'], function() {
    Route::post('offers', 'categoriesController@index');
});