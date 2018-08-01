<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    public function test_it_redirects_ucenter_if_a_user_accesses_in_without_login_status()
    {
        $this->get('/')
            ->assertRedirect(sprintf(
            '%s/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code',
            config('ucenter.root'),
            config('ucenter.client_id'),
            config('ucenter.redirect_uri')
        ));
    }

}
