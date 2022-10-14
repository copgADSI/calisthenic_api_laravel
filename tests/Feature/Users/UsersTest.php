<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * Inactivar usuario con 3 días sin iniciar sesión
     *
     * @return void
     */
    public function test_inactive_users()
    {
        $this->artisan('command:InactivateUsers');
    }

    public function test_a_user_create_from_api()
    {
        $user_data = [
            'name' => 'Cristia Parada Gualteros',
            'email' => 'Crispex2356@outlook.com',
            'password' => '123456123aza',
            'phone' =>  "123456123aza"
        ];
        $response = $this->post(route('user.create', $user_data));
        $response_data = $response->json();
        //$this->assertDatabaseHas('users', $response_data['user']);
        $response->assertStatus(200);
    }
}
