<?php

use App\TicketPriority;
use Illuminate\Database\Seeder;

class TicketPriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TicketPriority::class)->create([
            'name' => 'Low',
            'color' => '#ffa500'
        ]);

        factory(TicketPriority::class)->create([
            'name' => 'High',
            'color' => '#FF0000'
        ]);
    }
}
