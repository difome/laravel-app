<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_user_can_register()
    {
        $userData = [
            'username' => $this->faker->userName,
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
        $this->assertAuthenticated();
    }


    public function test_registration_requires_name_email_and_password()
    {
        $response = $this->post(route('register'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_password_confirmation_must_match()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password456',
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertSessionHasErrors('password');
    }

}
