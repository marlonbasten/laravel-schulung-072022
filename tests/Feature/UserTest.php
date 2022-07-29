<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private const EMAIL = 'max.mustermann123@test.de';
    private const PASSWORD = 'Test1234567!';

    public function test_can_see_register_form()
    {
        $response = $this->get('/register');

        $response->assertOk();
        $response->assertSee('Register');
    }

    public function test_new_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Max Mustermann',
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
            'password_confirmation' => self::PASSWORD
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_can_logout()
    {
        $response = $this->post('/logout');

        $response->assertRedirect('/');
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
