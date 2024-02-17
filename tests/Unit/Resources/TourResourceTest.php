<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\TourResource;
use App\Models\Tour;
use Carbon\Carbon;
use Tests\TestCase;

class TourResourceTest extends TestCase
{
    public function test_that_resource_returns_proper_data(): void
    {
        Carbon::setTestNow('2024-04-04 04:04:04');

        $tourA = new Tour;
        $tourA->id = 'id1';
        $tourA->name = 'Tour A';
        $tourA->price = 1150.00;
        $tourA->startingDate = now();
        $tourA->endingDate = now()->addDay();

        $tourB = new Tour;
        $tourB->id = 'id2';
        $tourB->name = 'Tour B';
        $tourB->price = 1160.00;
        $tourB->startingDate = now()->addDay();
        $tourB->endingDate = now()->addDays(2);

        $data = collect([$tourA, $tourB]);
        $result = TourResource::collection($data)->toArray(request());

        $this->assertSame(
            [
                [
                    'id' => 'id1',
                    'name' => 'Tour A',
                    'price' => '1.150,00',
                    'startingDate' => '04.04.2024',
                    'endingDate' => '05.04.2024',
                ],
                [
                    'id' => 'id2',
                    'name' => 'Tour B',
                    'price' => '1.160,00',
                    'startingDate' => '05.04.2024',
                    'endingDate' => '06.04.2024',
                ],
            ],
            $result
        );
    }
}
