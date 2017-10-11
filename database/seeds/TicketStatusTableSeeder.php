<?php

use App\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TicketStatus::class)->create([
            'name' => 'Open',
            'color' => '#3cb371'
        ]);

        factory(TicketStatus::class)->create([
            'name' => 'Closed',
            'color' => '#ff0000'
        ]);
    }
}
