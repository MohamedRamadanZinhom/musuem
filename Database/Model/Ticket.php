<?php

class Ticket
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Create a new ticket
    public function createTicket($userId, $ticketTypeId, $quantity)
    {
        if (!$this->isValidTicketType($ticketTypeId)) {
            return 'Invalid ticket type';
        }

        $ticketType = $this->getTicketType($ticketTypeId);

        $totalCost = $this->calculateTotalCost($ticketType['cost'], $quantity);

        $sql = "INSERT INTO ticket (user_id, ticket_type_id, quantity, total_cost, booking_date)
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $ticketTypeId, $quantity, $totalCost]);

        return 'Ticket booked successfully';
    }

    // Check if a ticket type is valid
    private function isValidTicketType($ticketTypeId)
    {
        $sql = "SELECT COUNT(*) FROM ticket_type WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ticketTypeId]);

        return $stmt->fetchColumn() > 0;
    }

    // Get ticket type by ID
    private function getTicketType($ticketTypeId)
    {
        $sql = "SELECT * FROM ticket_type WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ticketTypeId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Calculate the total cost based on the ticket type cost and quantity
    private function calculateTotalCost($ticketTypeCost, $quantity)
    {
        return $ticketTypeCost * $quantity;
    }

    // Get all tickets for a user
    public function getUserTickets($userId)
    {
        $sql = "SELECT * FROM ticket WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTicketType($name, $price)
    {
        if ($this->isTicketTypeExists($name)) {
            return 'Ticket type already exists';
        }

        $sql = "INSERT INTO ticket_type (name, cost) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $price]);

        return 'Ticket type added successfully';
    }

    // Update an existing ticket type
    public function updateTicketType($ticketTypeId, $name, $cost)
    {
        if (!$this->isValidTicketType($ticketTypeId)) {
            return 'Invalid ticket type';
        }

        $sql = "UPDATE ticket_type SET name = ?, cost = ?, available_tickets = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $cost, $ticketTypeId]);

        return 'Ticket type updated successfully';
    }

    // Check if a ticket type with the same name already exists
    private function isTicketTypeExists($name)
    {
        $sql = "SELECT COUNT(*) FROM ticket_type WHERE name = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name]);

        return $stmt->fetchColumn() > 0;
    }

    // Get all details of a ticket by ID with user information
    public function getTicketDetailsById($ticketId)
    {
        $sql = "SELECT ticket.*, user.first_name AS user_first_name, user.last_name AS user_last_name
                FROM ticket
                INNER JOIN user ON ticket.user_id = user.id
                WHERE ticket.id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ticketId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
