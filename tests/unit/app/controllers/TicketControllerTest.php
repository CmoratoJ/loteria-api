<?php

namespace tests\unit\app\controllers;
use app\controllers\TicketController;
use PHPUnit\Framework\TestCase;

class TicketControllerTest extends TestCase
{
    protected TicketController $controller;
    public function setUp(): void
    {
        $this->controller = new TicketController();
    }
    public function test_generate_tickets()
    {
        $generate = $this->controller->generate(2, 7);
        $data = json_decode($generate, true);
        $this->assertNotNull($data, 'JSON response is not valid');
        $this->assertArrayHasKey('tickets', $data, 'Access key is not present in the JSON response');
    }

    public function test_generate_tickets_quantity_exception()
    {
        $generate = $this->controller->generate(51, 7);
        $data = json_decode($generate, true);
        $this->assertArrayHasKey('error', $data);
    }

    public function test_generate_tickets_num_dezenas_exception()
    {
        $generate = $this->controller->generate(1, 11);
        $data = json_decode($generate, true);
        $this->assertArrayHasKey('error', $data);
    }

    public function test_generate_tickets_quantity_not_defined_exception()
    {
        $generate = $this->controller->generate(0, 6);
        $data = json_decode($generate, true);
        $this->assertArrayHasKey('error', $data);
    }

    public function test_generate_tickets_num_dezenas_not_defined_exception()
    {
        $generate = $this->controller->generate(1, 0);
        $data = json_decode($generate, true);
        $this->assertArrayHasKey('error', $data);
    }

    public function test_compare_with_winning_ticket()
    {
        $compare = $this->controller->compareWithWinningTicket(1,6);
        $this->assertIsString($compare);
        $this->assertStringContainsString('<table', $compare, 'Response does not contain <table> tag');
        $this->assertStringContainsString('</table>', $compare, 'Response does not contain </table> tag');
    }

    public function test_compare_with_winning_ticket_quantity_exception()
    {
        $compare = $this->controller->compareWithWinningTicket(51,6);
        $data = json_decode($compare, true);
        $this->assertArrayHasKey('error', $data);
    }

    public function test_compare_with_winning_ticket_num_dezenas_exception()
    {
        $compare = $this->controller->compareWithWinningTicket(1,11);
        $data = json_decode($compare, true);
        $this->assertArrayHasKey('error', $data);
    }
}
