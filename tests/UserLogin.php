<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait UserLogin
{
    public $user;

    public function setUp(): void
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

        $this->assertAuthenticated(); // ✅ Correct: called on $this
        $this->assertAuthenticatedAs($user);
    }
}
