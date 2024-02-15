<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class TourTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    public function test_tour_triggers_error_with_wrong_role(): void
    {
        $user = User::query()
            ->where('name', 'Editor')
            ->first();

        $response = $this->actingAs($user)
            ->postJson(route('tour.store'));

        $response->assertStatus(403);
    }

    public function test_tour_created_properly(): void
    {
        $user = User::query()
            ->where('name', 'Admin')
            ->first();

        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)
            ->postJson(route('tour.store'), [
            'name' => 'Tokio summer 2024',
            'travelId' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now(),
            'price' => 1799.99,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('tour.name', 'Tokio summer 2024');
    }

    public function test_fails_with_validation(): void
    {
        $user = User::query()
            ->where('name', 'Admin')
            ->first();

        // @todo igor: add dataProvider
        $response = $this->actingAs($user)
            ->postJson(route('tour.store'), [
                'name' => 'Tokio summer 2024',
                'travelId' => 0,
                'startingDate' => '2024-04-24',
                'endingDate' => '2024-04-30',
                'price' => 1799.99,
            ]);

        $response->assertStatus(422)
            ->assertJsonPath('message', 'The selected travel id is invalid.');
    }

    public function test_tour_updates_properly_by_editor(): void
    {
        $user = User::query()
            ->where('name', 'Editor')
            ->first();

        $travel = Travel::factory()->create();
        $tour = Tour::factory()->create([
            'travelId' => $travel->id,
        ]);

        $response = $this->actingAs($user)
            ->putJson(route('tour.update', [$tour->id]), [
                'name' => 'Tokio summer 2024',
                'travelId' => $travel->id,
                'startingDate' => now(),
                'endingDate' => now(),
                'price' => 1799.99,
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('tour.name', 'Tokio summer 2024')
            ->assertJsonPath('tour.price', 1799.99);
    }
}
