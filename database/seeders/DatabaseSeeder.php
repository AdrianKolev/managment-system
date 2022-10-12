<?php

namespace Database\Seeders;

use App\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create(
            [
                'name' => 'Admin',

            ]
        );

        Role::factory()->create(
            [
                'name' => 'Editor',

            ]
        );

        Role::factory()->create(
            [
                'name' => 'Viewer',

            ]
        );

        \App\Models\User::factory(20)->create();


        \App\Models\User::factory()->create(
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.bg',
                'role_id' => 1,
            ]
        );


        \App\Models\User::factory()->create(
            [
                'first_name' => 'Editor',
                'last_name' => 'Editor',
                'email' => 'editoreditor.bg',
                'role_id' => 2,
            ]
        );


        \App\Models\User::factory()->create(
            [
                'first_name' => 'Viewer',
                'last_name' => 'Viewer',
                'email' => 'viewer@viewer.bg',
                'role_id' => 3,
            ]
        );
    }
}
