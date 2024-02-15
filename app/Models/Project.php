<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
