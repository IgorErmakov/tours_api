<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property string $name
 * @property string $travelId
 * @property Carbon $startingDate
 * @property Carbon $endingDate
 * @property integer $price
 */
class Tour extends Model
{
    use HasFactory,
        HasUuids;

    protected $table = 'tours';

    /**
     * Eloquent's casts.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'startingDate' => 'date',
        'endingDate' => 'date',
        'price' => 'integer',
    ];

    /**
     * Eloquent's fillable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'travelId',
        'startingDate',
        'endingDate',
        'price',
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }
}
