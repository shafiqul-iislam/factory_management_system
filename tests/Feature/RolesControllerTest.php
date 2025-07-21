<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_user_can_create_roles(): void
    {
        // create user       
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // login user
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/home'); // or wherever you redirect after login

        $this->assertAuthenticated(); // ✅ Correct: called on $this
        $this->assertAuthenticatedAs($user);


        // create role
        $this->post('/roles/add', [
            'name' => 'staff',
            'guard_name' => 'sanctum',
        ]);

        $this->assertEquals(1, Role::where('name', 'staff')->count());
    }
}
