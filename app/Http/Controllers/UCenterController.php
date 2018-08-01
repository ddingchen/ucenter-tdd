<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Thinker\Facades\UCenter;

class UCenterController extends Controller
{

    public function callback()
    {
        $token = UCenter::webAuth()->token(request('code'));

        session()->put('ucenter', (array) $token);

        return redirect('/');
    }

}
