<?php

use App\Generators\TicketNumberGenerator;
use App\TicketPriority;
use App\TicketStatus;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        while ($i < 10) {
            factory(App\Ticket::class)->create([
                'ticket_number' => app(TicketNumberGenerator::class)->generate(),
                'subject' => 'Support Ticket number ' . rand(1, 100),
                'content' => 'This is the content for this support ticket',
            ]);
            $i++;
        }
    }
}
