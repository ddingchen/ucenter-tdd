<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        if (session()->has('ucenter')) {
            return session('ucenter');
        }

        $url = sprintf(
            '%s/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code',
            config('ucenter.root'),
            config('ucenter.client_id'),
            config('ucenter.redirect_uri')
        );

        return redirect($url);
    }

}
