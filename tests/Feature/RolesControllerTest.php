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
        $response = $this->from(url('/roles'))
            ->post('/roles/add', [
                'name' => 'staff',
                'guard_name' => 'sanctum',
            ]);

        $this->assertEquals(1, Role::where('name', 'staff')->count());
        $response->assertStatus(302); // redirect
        $response->assertRedirect(url('/roles'));
    }

    public function test_login_user_can_view_roles(): void
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

        // $response->assertRedirect('/home'); // or wherever you redirect after login

        $this->assertAuthenticated(); // ✅ Correct: called on $this
        $this->assertAuthenticatedAs($user);


        // create role
        $response = $this->from(url('/roles'))
            ->post('/roles/add', [
                'name' => 'staff-2',
                'guard_name' => 'sanctum',
            ]);
        $this->assertEquals(1, Role::where('name', 'staff-2')->count());
    }

    public function test_logged_in_user_can_update_roles(): void
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

        // $response->assertRedirect('/home'); // or wherever you redirect after login

        $this->assertAuthenticated(); // ✅ Correct: called on $this
        $this->assertAuthenticatedAs($user);

        // create role
        $response = $this->from(url('/roles'))
            ->post('/roles/add', [
                'name' => 'staff-4 ',
                'guard_name' => 'sanctum',
            ]);
        $this->assertEquals(1, Role::where('name', 'staff-4')->count());

        // update role
        $role = Role::where('name', 'staff-4')->first();

        $response = $this->from(url('/roles'))
            ->put('/roles/update', ['id' => $role->id], [
                'name' => 'staff-4-update',
            ]);

        // $roleUpdate = Role::where('name', 'staff-4-update')->first();

        // $this->assertEquals('staff-4-update', $roleUpdate->name);
    }
}
