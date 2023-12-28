<?php



class Visitor {
    private $conn;

    public function __construct() {
        include('Connection.php');
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createVisitor($first_name, $last_name, $country,$mail, $mobile, $address, $type) {
        $sql = "INSERT INTO visitor (first_name, last_name,country,mail, mobile, address, type) 
                VALUES (?, ?, ?,?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $first_name, $last_name,$country, $mail, $mobile, $address, $type);

        $result = $stmt->execute();

        $stmt->close();

        return $result ? true : false;
    }

    public function getVisitor($id) {
        $sql = "SELECT * FROM visitor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();

        return $result;
    }

    public function getLastInsertedId() {
        $sql = "SELECT MAX(id) AS last_id FROM visitor";
        $result = $this->conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['last_id'];
        } else {
            return null;
        }
    }

    public function updateVisitor($id, $first_name, $last_name, $mail, $mobile, $address, $type) {
        $sql = "UPDATE visitor 
                SET first_name = ?, last_name = ?, mail = ?, mobile = ?, address = ?, type = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $first_name, $last_name, $mail, $mobile, $address, $type, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result ? true : false;
    }

    public function deleteVisitor($id) {
        $sql = "DELETE FROM visitor WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result ? true : false;
    }

    public function getVisitorWithTickets($visitor_id) {
        $sql = "SELECT visitor.id AS visitor_id, visitor.first_name, visitor.last_name, 
                       visitor.mail, visitor.mobile, visitor.address, visitor.type,
                       ticket.id AS ticket_id, ticket.date, ticket.cost
                FROM visitor
                INNER JOIN ticket ON visitor.id = ticket.visitor_id
                WHERE visitor.id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $visitor_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
    
        $visitorData = null;
    
        while ($row = $result->fetch_assoc()) {
            if (!$visitorData) {
                // Initialize visitor data only once
                $visitorData = [
                    'visitor_id' => $row['visitor_id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'mail' => $row['mail'],
                    'mobile' => $row['mobile'],
                    'address' => $row['address'],
                    'type' => $row['type'],
                    'tickets' => [],
                ];
            }
    
            // Add ticket data to the tickets array
            $visitorData['tickets'][] = [
                'ticket_id' => $row['ticket_id'],
                'date' => $row['date'],
                'cost' => $row['cost'],
            ];
        }
    
        $stmt->close();
    
        return $visitorData;
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}


