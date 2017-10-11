<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TicketStatusTableSeeder::class);
        $this->call(TicketPriorityTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
    }
}
