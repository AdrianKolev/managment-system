<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        User::factory(20)->create();


        User::factory()->create(
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.bg',
                'role_id' => 1,
            ]
        );


        User::factory()->create(
            [
                'first_name' => 'Editor',
                'last_name' => 'Editor',
                'email' => 'editoreditor.bg',
                'role_id' => 2,
            ]
        );


        User::factory()->create(
            [
                'first_name' => 'Viewer',
                'last_name' => 'Viewer',
                'email' => 'viewer@viewer.bg',
                'role_id' => 3,
            ]
        );
    }
}
