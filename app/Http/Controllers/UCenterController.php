<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class UCenterController extends Controller
{

    public function callback()
    {
        $response = app(Client::class)->post(config('ucenter.root') . '/api/oauth/accessToken', [
            'form_params' => [
                'client_id' => config('ucenter.client_id'),
                'client_secret' => config('ucenter.client_secret'),
                'grant_type' => 'authorization_code',
                'redirect_uri' => config('ucenter.redirect_uri'),
                'code' => request('code'),
            ],
        ])->getBody();

        $token = json_decode($response, true)['data'];

        session()->put('ucenter', $token);

        return redirect('/');
    }

}
