<?php

use Illuminate\Http\Request;
use Dotzero\LaravelAmoCrm\AmoCrmManager;
use GuzzleHttp\Client;

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

Route::get('test', function (AmoCrmManager $amocrm) {

//    try {
        $client = new GuzzleHttp\Client();

//        $data = json_encode('email: test@test.test');

        $response = $client->request('POST', 'https://hooks.zapier.com/hooks/catch/3624585/gf14c4/', [
            'form_params' => ['email' => 'a.skurlatov@gmail.com']
        ]);

//        return $response;
/*    } catch (\Exception $e) {
        return $e;
    }*/

});