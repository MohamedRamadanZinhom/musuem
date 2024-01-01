<?php

class Order
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Get all orders for a user
    public function getUserOrders($userId)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get an order by ID
    public function getOrderById($orderId)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cancel an order
    public function cancelOrder($orderId)
    {
        $order = $this->getOrderById($orderId);

        if (!$order) {
            return 'Invalid order';
        }

        // Assuming you have a souvenirs table to update available items
        $sql = "UPDATE souvenir SET available_items = available_items + ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order['quantity'], $order['souvenir_id']]);

        // Assuming you have a refund process if needed

        // Update the order status to canceled
        $this->updateOrderStatus($orderId, 'canceled');

        return 'Order canceled successfully';
    }

    // Update order status
    private function updateOrderStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$status, $orderId]);
    }

     // Get all details of an order by ID with user and souvenir information
     public function getOrderDetailsById($orderId)
     {
         $sql = "SELECT orders.*, user.first_name AS user_first_name, user.last_name AS user_last_name, 
                 souvenir.name AS souvenir_name, souvenir.price AS souvenir_price, souvenir.image AS souvenir_image
                 FROM orders
                 INNER JOIN user ON orders.user_id = user.id
                 INNER JOIN souvenir ON orders.souvenir_id = souvenir.id
                 WHERE orders.id = ?";
 
         $stmt = $this->pdo->prepare($sql);
         $stmt->execute([$orderId]);
 
         return $stmt->fetch(PDO::FETCH_ASSOC);
     }
}

?>
