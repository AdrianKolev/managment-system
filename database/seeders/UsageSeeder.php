<?php

namespace Database\Seeders;

use App\Models\Usage;
use App\Models\UsageItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usage::factory(30)->create()
        ->each(function (Usage $usage) {
            UsageItem::factory(random_int(1,5))->create([
                'usage_id' => $usage->id
            ]);
        });
    }
}
