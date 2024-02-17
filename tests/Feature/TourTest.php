<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
                'endingDate' => now()->addDay(),
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

    public function test_retrieves_the_data_properly(): void
    {
        Carbon::setTestNow('2024-04-04 04:04:04');
        $travel = Travel::factory()->create([
            'slug' => 'tokio_2024',
            'public' => true,
        ]);

        $travelB = Travel::factory()->create([
            'slug' => 'tokio_2025',
            'public' => true,
        ]);

        // good
        Tour::factory()->create([
            'id' => 'tour1-id',
            'travelId' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now()->addDays(10),
            'price' => 1200.00,
            'name' => 'Tour 1',
        ]);

        // good
        Tour::factory()->create([
            'id' => 'tour2-id',
            'travelId' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now()->addDays(10),
            'price' => 1500.00,
            'name' => 'Tour 2',
        ]);

        // good
        Tour::factory()->create([
            'id' => 'tour3-id',
            'travelId' => $travel->id,
            'startingDate' => now()->addDays(10),
            'endingDate' => now()->addDays(20),
            'price' => 1600.00,
            'name' => 'Tour 3',
        ]);

        // out of price
        Tour::factory()->create([
            'travelId' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now()->addDays(10),
            'price' => 2500.00,
        ]);

        // another travelId
        Tour::factory()->create([
            'travelId' => $travelB->id,
            'startingDate' => now(),
            'endingDate' => now()->addDays(10),
        ]);

        $response = $this->getJson(route('tour.index', [
            'page' => 1,
            'slug' => 'tokio_2024',
            'dateFrom' => now()->toDateString(),
            'dateTo' => now()->addDays(20)->toDateString(),
            'priceFrom' => 1000,
            'priceTo' => 2000,
            'sort' => 'price',
            'sortDir' => 'desc',
        ]));

        $response->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'id' => 'tour2-id',
                        'name' => 'Tour 2',
                        'price' => '1.500,00',
                        'startingDate' => '04.04.2024',
                        'endingDate' => '14.04.2024',
                    ],
                    [
                        'id' => 'tour1-id',
                        'name' => 'Tour 1',
                        'price' => '1.200,00',
                        'startingDate' => '04.04.2024',
                        'endingDate' => '14.04.2024',
                    ],
                    [
                        'id' => 'tour3-id',
                        'name' => 'Tour 3',
                        'price' => '1.600,00',
                        'startingDate' => '14.04.2024',
                        'endingDate' => '24.04.2024',
                    ],
                ],
            ]);
    }
}
