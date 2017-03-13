<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*
 * Grupo API que no requiere api:auth
 */
Route::group(['middleware' => ['api']], function() {

    Route::post('authenticate', [
        'uses' => 'AuthenticateController@authenticate'
    ]);

});

Route::group(['middleware' => ['jwt.auth']], function() {

    include_once 'Routes/Api/CarreraRoute.php';
    include_once 'Routes/Api/RamoRoute.php';
    include_once 'Routes/Api/FileRoute.php';
    include_once 'Routes/Api/FileUserRoute.php';


    include_once 'Routes/ApiUserRoutes.php';
    include_once 'Routes/ApiMessageRoutes.php';

});