<?php



class Ticket {
    private $conn;

    public function __construct() {
        include('Connection.php');
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createTicket($visitor_id, $date, $cost) {
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO ticket (visitor_id, date, cost, created_at) VALUES ('$visitor_id', '$date', '$cost', '$created_at')";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function getTicket($id) {
        $sql = "SELECT * FROM ticket WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function updateTicket($id, $visitor_id, $date, $cost) {
        $sql = "UPDATE ticket SET visitor_id = '$visitor_id', date = '$date', cost = '$cost' WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function deleteTicket($id) {
        $sql = "DELETE FROM ticket WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Example usage:
// $ticketManager = new TicketManager($host, $username, $password, $database);
// $ticketManager->createTicket(1, '2023-01-01', 20.00);
// $ticketData = $ticketManager->getTicket(1);
// $ticketManager->updateTicket(1, 2, '2023-02-01', 25.00);
// $ticketManager->deleteTicket(1);
// $ticketManager->closeConnection();
