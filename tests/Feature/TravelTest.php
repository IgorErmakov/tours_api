<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_travel_triggers_error_with_wrong_role(): void
    {
        $user = User::query()
            ->where('name', 'Editor')
            ->first();

        $response = $this->actingAs($user)
            ->post(route('travel.store'), [
                'name' => 'Tokio',
                'slug' => 'tokio2',
                'public' => true,
                'description' => 'Amazing experience',
                'numberOfDays' => 5,
                'moods' => [
                    'nature' => 100,
                    'relax' => 30,
                    'history' => 10,
                    'culture' => 20,
                    'party' => 10,
                ],
            ]);

        $response->assertStatus(403);
    }

    public function test_travel_created_properly(): void
    {
        $user = User::query()
            ->where('name', 'Admin')
            ->first();

        $response = $this->actingAs($user)
            ->postJson(route('travel.store'), [
                'name' => 'Tokio',
                'slug' => 'tokio2',
                'public' => true,
                'description' => 'Amazing experience',
                'numberOfDays' => 5,
                'moods' => [
                    'nature' => 100,
                    'relax' => 30,
                    'history' => 10,
                    'culture' => 20,
                    'party' => 10,
                ],
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('travel.name', 'Tokio');
    }

    public function test_fails_with_validation(): void
    {
        $user = User::query()
            ->where('name', 'Admin')
            ->first();

        $response = $this->actingAs($user)
            ->postJson(route('travel.store'), [
                'slug' => 'tokio2',
                'public' => true,
                'description' => 'Amazing experience',
                'numberOfDays' => 5,
                'moods' => [
                    'nature' => 100,
                    'relax' => 30,
                    'history' => 10,
                    'culture' => 20,
                    'party' => 10,
                ],
            ]);

        $response->assertStatus(422)
            ->assertJsonPath('message', 'The name field is required.');
    }
}
