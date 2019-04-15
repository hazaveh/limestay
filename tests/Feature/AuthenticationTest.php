<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthenticationTest extends TestCase
{

    public function test_register_page_works() {
        
        $response = $this->get('/register');

        $response->assertSuccessful();

        $response->assertViewIs('auth.register');

    }

    public function test_user_can_authenticate() {
        $u = factory(User::class)->create([
            'password' => bcrypt($password = 'limehome'),
        ]);
        $response = $this->post('/login', [
            'email' => $u->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($u);
    }

    public function test_login_page_works() {
        
        $response = $this->get('/login');

        $response->assertSuccessful();

        $response->assertViewIs('auth.login');

    }
}
