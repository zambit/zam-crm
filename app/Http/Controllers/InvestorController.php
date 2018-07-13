<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\AddToWlRequest;
use App\Models\Investors;

//TODO Fix custom request

class InvestorController extends Controller
{
    /**
     *
     * Add investor to whitelist
     *
     * @param AddToWlRequest $request
     */
//    public function addToWl(AddToWlRequest $request)
    public function addToWl(Request $request)
    {
        //TODO do it with collection way
        $data = $request->all();
//        var_dump($data);
//        return $data;
        $json = collect(json_decode($data['data']))->forget('code');
        $phone = $json->get('phoneFull');
        $json->put('phone', $phone);
        $json->put('ip', $request->ip());
//        return $json->all();
        $investor = $json->toArray();
//        return $investor;
//        var_dump($json);
//        return $json->all();
        /*var_dump($json->toArray());
        return $json;
        $json->phone = $json->phoneFull;
        $json->ip = $request->ip();*/

//        var_dump($json);
//        return $request->all();
//        $data['ip'] = $request->ip();
//        $data['phone'] = $data['phoneFull'];
//        return $data->phone;
        Investors::create($investor);
    }
}
