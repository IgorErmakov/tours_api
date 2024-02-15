<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@localhost.local',
        ]);

        $adminUser->assignRole(Role::findByName(Role::ADMIN));

        $editorUser = User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@localhost.local',
        ]);
        $editorUser->assignRole(Role::findByName(Role::EDITOR));

        $adminToken = $adminUser->createToken('Default');

        $editorToken = $adminUser->createToken('Default');

        echo "Admin token: {$adminToken->plainTextToken}\n";
        echo "Editor token: {$editorToken->plainTextToken}\n";
    }
}
