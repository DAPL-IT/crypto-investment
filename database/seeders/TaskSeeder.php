<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['title'=>'Exclusive order', 'order_total'=>100, 'short_description'=>'Grab it now & get commission!', 'image' => 't1.png'],
            ['title'=>'Instant order', 'order_total'=>150, 'short_description'=>'Grab it now & get commission!', 'image' => 't2.png'],
            ['title'=>'Basic order', 'order_total'=>50, 'short_description'=>'Grab it now & get commission!', 'image' => 't3.png'],
            ['title'=>'High priority order', 'order_total'=>180, 'short_description'=>'Grab it now & get commission!', 'image' => 't4.png'],
        ];

        Task::insert($tasks);
    }
}
