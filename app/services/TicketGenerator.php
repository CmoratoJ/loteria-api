<?php

namespace app\services;
use app\services\interface\ITicketGenerator;
use Exception;

class TicketGenerator implements ITicketGenerator
{
    public function generateTicket(int $numDezenas = 6): array
    {
        if ($numDezenas < 6 || $numDezenas > 10) {
            throw new Exception("Número de dezenas deve estar entre 6 e 10.");
        }

        $numbers = range(1, 60);
        shuffle($numbers);
        $ticket = array_slice($numbers, 0, $numDezenas);
        sort($ticket);

        return array_map(function($number) {
            return str_pad($number, 2, '0', STR_PAD_LEFT);
        }, $ticket);
    }
}
