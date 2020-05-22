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

Route::group([
    // 'middleware' => 'api'
], function ($router) {

    //Auth routes
    Route::post('login', 'api\AuthController@login');
    Route::post('signup', 'api\AuthController@signup');
    Route::get('logout', 'api\AuthController@logout');
    Route::get('refresh', 'api\AuthController@refresh');
    Route::get('me', 'api\AuthController@me');

    // Password reset routes
    Route::post('password/create', 'api\PasswordResetController@create');

    Route::get('find/{token}', 'api\PasswordResetController@find');
    
    Route::post('reset', 'api\PasswordResetController@reset');

    //Users routes
    Route::apiResource('users','api\UserController');

    //General information routes
    Route::get('general','api\GeneralInformationController@getGeneralInfo');

    //Dependencies routes
    Route::apiResource('dependencies','api\DependencyController');

    //Roles routes
    Route::get('/roles','api\AuthController@getRoles');

    //Documents routes
    Route::get('documents/dependency','api\DocumentController@getForDependency');
    Route::get('documents/toasign','api\DocumentController@getWithOutDependency');
    Route::get('documents/file/{name}','api\DocumentController@getFileFromStorage');
    Route::put('documents/asignDependency','api\DocumentController@asignDependency');
    Route::apiResource('documents','api\DocumentController');

    //Response documents routes
    Route::get('responses/download/{name}','api\ResponseDocumentController@getFileFromStorage');
    Route::apiResource('responses','api\ResponseDocumentController');

    //Voucher routes
    Route::get('voucher/generate/{id}','api\DocumentController@generateVoucher');
});
