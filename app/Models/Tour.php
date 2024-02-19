<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property string $travelId
 * @property Carbon $startingDate
 * @property Carbon $endingDate
 * @property int $price
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

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }
}
