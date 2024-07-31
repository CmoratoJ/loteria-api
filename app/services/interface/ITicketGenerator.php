<?php

namespace app\services\interface;

interface ITicketGenerator
{
    public function generateTicket(int $numDezenas = 6): array;
}
