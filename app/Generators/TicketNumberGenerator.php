<?php


namespace App\Generators;


class TicketNumberGenerator implements UniqueIDGeneration
{

    public function generate()
    {
        $pool = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        return substr(str_shuffle(str_repeat($pool, 16)), 0, 16);
    }
}