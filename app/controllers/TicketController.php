<?php

namespace app\controllers;

use app\services\TicketGenerator;
use app\services\TicketService;
use Exception;

class TicketController
{
    private TicketService $service;
    public function __construct()
    {
        $this->service = new TicketService(
            new TicketGenerator()
        );
    }

    public function generate($quantity, $numDezenas)
    {
        try {
            $tickets = $this->service->generateMultipleTickets($quantity, $numDezenas);
            return json_encode([
                    'tickets' => $tickets
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function compareWithWinningTicket($quantity, $numDezenas) {
        try {
            $tickets = $this->service->generateMultipleTickets($quantity, $numDezenas);
            $winningTicket =  $this->service->getWinningTicket();
            return $this->service->compareTickets($tickets, $winningTicket);
        } catch (Exception $e) {
            http_response_code(400);
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
