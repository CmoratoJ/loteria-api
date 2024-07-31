<?php

namespace tests\unit\app\services;

use app\services\TicketGenerator;
use Exception;
use PHPUnit\Framework\TestCase;

class TicketGeneratorTest extends TestCase
{
    public function test_generate_ticket_no_parameter()
    {
        $ticketGenerator = new TicketGenerator();
        $generate = $ticketGenerator->generateTicket();

        $this->assertCount(6, $generate, 'Array does not have 6 positions');
    }

    public function test_generate_ticket_with_parameter()
    {
        $ticketGenerator = new TicketGenerator();
        $generate = $ticketGenerator->generateTicket(10);

        $this->assertCount(10, $generate, 'Array does not have 10 positions');
    }

    public function test_generate_ticket_with_parameter_exception()
    {
        $ticketGenerator = new TicketGenerator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Número de dezenas deve estar entre 6 e 10.");

        $ticketGenerator->generateTicket(11);
    }
}
