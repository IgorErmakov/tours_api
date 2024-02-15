<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property integer $project_id
 * @property integer $priority
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'priority',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
