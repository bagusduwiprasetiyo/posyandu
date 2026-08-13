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

Route::post('auth', 'AuthController@postlogin');
Route::get('rujukan/bayi-gizi-buruk', 'RujukanController@apiBayiGiziBuruk');
Route::get('rujukan/bayi-stunting', 'RujukanController@apiBayiStunting');
Route::get('rujukan/bumil-risiko-tinggi', 'RujukanController@apiBumilRisikoTinggi');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/', function(){
//     return 'oke';
// });
