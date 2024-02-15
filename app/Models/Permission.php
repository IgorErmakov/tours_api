<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public const CREATE_TRAVEL = 'create travel';
    public const CREATE_TOUR = 'create tour';
    public const EDIT_TOUR = 'edit tour';

    use HasFactory;
    use HasUuids;
}
