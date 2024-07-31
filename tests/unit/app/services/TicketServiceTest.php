<?php

namespace tests\unit\app\services;

use app\services\TicketGenerator;
use app\services\TicketService;
use Exception;
use PHPUnit\Framework\TestCase;

class TicketServiceTest extends TestCase
{
    protected TicketService $service;
    public function setUp(): void
    {
        $this->service = new TicketService(new TicketGenerator);
    }

    public function test_generate_multiple_tickets()
    {
        $generate = $this->service->generateMultipleTickets(2,6);

        $this->assertCount(2, $generate, 'Array does not have 2 positions');
        $this->assertCount(6, $generate[0], 'Array does not have 6 positions at key 0');
        $this->assertCount(6, $generate[1], 'Array does not have 6 positions at key 1');
    }

    public function test_generate_multiple_tickets_quantity_exeption()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Quantidade de bilhetes deve estar entre 1 e 50.");

        $this->service->generateMultipleTickets(51,6);
    }

    public function test_get_winning_ticket()
    {
        $winningTicket = $this->service->getWinningTicket();
        $this->assertCount(6, $winningTicket, 'Array does not have 6 positions');
    }

    public function test_compare_tickets()
    {
        $tickets = $this->service->generateMultipleTickets(1,6);
        $winningTicket = $this->service->getWinningTicket();
        $compare = $this->service->compareTickets($tickets, $winningTicket);

        $this->assertIsString($compare);
        $this->assertStringContainsString('<table', $compare, 'Response does not contain <table> tag');
        $this->assertStringContainsString('</table>', $compare, 'Response does not contain </table> tag');
    }
}
