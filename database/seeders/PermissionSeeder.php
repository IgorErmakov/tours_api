<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $createTravel = Permission::create([
            'name' => Permission::CREATE_TRAVEL,
        ]);
        $createTour = Permission::create([
            'name' => Permission::CREATE_TOUR,
        ]);
        $editTour = Permission::create([
            'name' => Permission::EDIT_TOUR,
        ]);

        $admin = Role::create([
            'name' => Role::ADMIN,
        ]);
        $editor = Role::create([
            'name' => Role::EDITOR,
        ]);

        $admin->givePermissionTo([
            $createTravel,
            $createTour,
            $editTour,
        ]);
        $editor->givePermissionTo($editTour);
    }
}
