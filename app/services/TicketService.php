<?php

namespace app\services;

use app\services\interface\ITicketGenerator;
use Exception;

class TicketService
{
    private $ticketGenerator;

    public function __construct(ITicketGenerator $iTicketGenerator)
    {
        $this->ticketGenerator = $iTicketGenerator;
    }

    public function generateMultipleTickets(int $quantity, int $numDezenas): array
    {
        if ($quantity < 1 || $quantity > 50) {
            throw new Exception("Quantidade de bilhetes deve estar entre 1 e 50.");
        }

        $tickets = [];
        for ($i = 0; $i < $quantity; $i++) {
            $tickets[] = $this->ticketGenerator->generateTicket($numDezenas);
        }

        return $tickets;
    }

    public function compareTickets(array $tickets, array $winningTicket): string
    {
        $winningNumbers = $winningTicket;
        $results = [];

        foreach ($tickets as $ticket) {
            $ticketNumbers = $ticket;
            $matches = array_intersect($ticketNumbers, $winningNumbers);
            $results[] = [
                'ticket' => $ticketNumbers,
                'matches' => $matches
            ];
        }

        return $this->generateHtmlTable($results);
    }

    private function generateHtmlTable(array $results): string
    {
        $html = '<table border="1"><tr><th>Bilhete</th><th>Dezenas Sorteadas</th></tr>';
        foreach ($results as $result) {
            $ticket = implode(', ', $result['ticket']);
            $matches = implode(', ', $result['matches']);
            $html .= "<tr><td>{$ticket}</td><td>{$matches}</td></tr>";
        }
        $html .= '</table>';

        return $html;
    }

    public function getWinningTicket(): array
    {
        return $this->ticketGenerator->generateTicket();
    }
}
