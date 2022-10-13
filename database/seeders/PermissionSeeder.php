<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'view_users'],
            ['name' => 'edit_users'],
            ['name' => 'view_roles'],
            ['name' => 'edit_roles'],
            ['name' => 'view_items'],
            ['name' => 'edit_items'],
            ['name' => 'view_usages'],
            ['name' => 'edit_usages'],
        ]);
    }
}
