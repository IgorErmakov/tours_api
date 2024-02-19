<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_travel_triggers_error_with_wrong_role(): void
    {
        $response = $this->actingAs($this->getUser('Editor'))
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
        $response = $this->actingAs($this->getUser('Admin'))
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

    public function test_tour_updates_properly_by_editor(): void
    {
        $travel = Travel::factory()->create([
            'name' => 'Tokio summer 2024',
            'slug' => 'Tokio_summer_2024',
            'public' => false,
            'description' => '-',
            'numberOfDays' => 10,
        ]);

        $response = $this->actingAs($this->getUser('Editor'))
            ->putJson(route('travel.update', [$travel->id]), [
                'name' => 'Tokio summer 2025',
                'slug' => 'tokio_summer_2025',
                'public' => false,
                'description' => 'Descr',
                'numberOfDays' => 5,
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('travel.name', 'Tokio summer 2025')
            ->assertJsonPath('travel.slug', 'tokio_summer_2025')
            ->assertJsonPath('travel.public', false)
            ->assertJsonPath('travel.description', 'Descr')
            ->assertJsonPath('travel.numberOfDays', 5)
            ->assertJsonPath('travel.numberOfNights', 4);
    }

    public function test_fails_with_validation(): void
    {
        $response = $this->actingAs($this->getUser('Admin'))
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
