<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property int $numberOfDays
 * @property bool $public
 * @property array $moods
 * @property string $created_at
 * @property string $updated_at
 */
class Travel extends Model
{
    use HasFactory,
        HasUuids;

    protected $table = 'travels';

    /**
     * Eloquent's casts.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'numberOfDays' => 'integer',
        'public' => 'bool',
        'moods' => 'array',
    ];

    /**
     * Eloquent's fillable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'public',
        'description',
        'numberOfDays',
        'moods',
    ];

    protected $appends = [
        'numberOfNights',
    ];

    protected function getNumberOfNightsAttribute(): int
    {
        return $this->numberOfDays - 1;
    }
}
