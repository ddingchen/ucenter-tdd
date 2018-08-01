<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Thinker\Facades\UCenterApi;

class LoginTest extends TestCase
{

    public function test_it_redirects_ucenter_if_a_user_accesses_in_without_login_status()
    {
        $this->get('/')
            ->assertRedirect(UCenterApi::urlOfAuthorizePage());
    }

    public function test_it_shouldnt_redirect_ucenter_if_a_user_accesses_in_with_login_status()
    {
        session()->put('ucenter', 'login status');

        $this->get('/')
            ->assertSee('login status');
    }

    public function test_it_redirects_home_with_login_status_if_a_user_successfully_login()
    {
        UCenterApi::fake()
            ->mockResponse('getAccessTokenByCode', 'ok', $fakeToken = [
                "access_token" => "AynyRZKKskMBs4ONjOHUecgAyM2rqpvToo0QTXPA",
                "token_type" => "Bearer",
                "expires_in" => 7200,
                "refresh_token" => "mcQNthVcEJpn09MObyxXerv4tiQq9I2z85NAe2ye"
            ]);

        $this->get(config('ucenter.redirect_uri') . '?code=123')
            ->assertRedirect('/')
            ->assertSessionHas('ucenter', $fakeToken);
    }

}
