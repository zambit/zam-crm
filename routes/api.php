<?php

use Illuminate\Http\Request;
use Dotzero\LaravelAmoCrm\AmoCrmManager;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'investors'], function() {
    Route::post('/', 'InvestorController@addToWl');
});

/*Route::get('test', function (AmoCrmManager $amocrm) {

        $account = $amocrm->account;

        dd($account->apiCurrent());
        print_r($account->apiCurrent());

        return;
});*/