<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Simple',
            'last_name' => 'Support',
            'email' => 'support@simplesupport.com',
            'password' => bcrypt('support')
        ]);

        factory(User::class, 6)->create([
            'password' => bcrypt('support')
        ]);
    }
}
