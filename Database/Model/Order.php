<?php



class Order {
    private $conn;

    public function __construct() {
        include('Connection.php');
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createOrder($id_visitor, $id_image, $number_ticket,$cost) {
        $sql = "INSERT INTO orders (id_visitor, id_image, number_ticket,cost) VALUES (?, ?,?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $id_visitor, $id_image, $number_ticket,$cost);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getOrder($id) {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();

        return $result;
    }

    public function updateOrder($id, $id_visitor, $id_image, $number_ticket) {
        $sql = "UPDATE orders SET id_visitor = ?, id_image = ?, number_ticket = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $id_visitor, $id_image, $number_ticket, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function deleteOrder($id) {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getOrderDetails($order_id) {
        $sql = "SELECT orders.id AS order_id, orders.order_date, orders.quantity, 
                       visitor.first_name AS visitor_first_name, visitor.last_name AS visitor_last_name,
                       product.name AS product_name, product.price AS product_price
                FROM orders
                INNER JOIN visitor ON orders.visitor_id = visitor.id
                INNER JOIN product ON orders.product_id = product.id
                WHERE orders.id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        
        $result = $stmt->get_result()->fetch_assoc();
    
        $stmt->close();
    
        return $result;
    }
    

    public function closeConnection() {
        $this->conn->close();
    }
}
