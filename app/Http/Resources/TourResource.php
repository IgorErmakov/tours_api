<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Tour
 */
class TourResource extends JsonResource
{
    /**
     * @return array<string, string>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => number_format($this->price, 2, ',', '.'),
            'startingDate' => $this->startingDate->format('d.m.Y'),
            'endingDate' => $this->endingDate->format('d.m.Y'),
        ];
    }
}
