<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserDisabledTest extends TestCase
{
    use RefreshDatabase;

    public function testEnabledUser()
    {
        $user = User::factory()->state([
            'name' => 'Enabled Test User',
            'disabled' => false,
        ])->create();

        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testDisabledUser()
    {
        $user = User::factory()->state([
            'name' => 'Disabled Test User',
            'disabled' => true,
        ])->create();

        $response = $this->actingAs($user)->get('/');
        $this->assertGuest();
    }
}
