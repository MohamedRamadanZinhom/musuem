<?php

class Souvenir
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


       // Create new souvenir
       public function createSouvenir($name, $price, $availableItems, $image)
       {
           $sql = "INSERT INTO souvenir (name, price, available_items, image)
                   VALUES (?, ?, ?, ?)";
   
           $stmt = $this->pdo->prepare($sql);
           $stmt->execute([$name, $price, $availableItems, $image]);
   
           return 'Souvenir created successfully';
       }
   
       // Update souvenir
       public function updateSouvenir($souvenirId, $name, $price, $availableItems, $image)
       {
           $sql = "UPDATE souvenir SET name = ?, price = ?, available_items = ?, image = ? WHERE id = ?";
           $stmt = $this->pdo->prepare($sql);
           $stmt->execute([$name, $price, $availableItems, $image, $souvenirId]);
   
           return 'Souvenir updated successfully';
       }
   
       // Delete souvenir
       public function deleteSouvenir($souvenirId)
       {
           $sql = "DELETE FROM souvenir WHERE id = ?";
           $stmt = $this->pdo->prepare($sql);
           $stmt->execute([$souvenirId]);
   
           return 'Souvenir deleted successfully';
       }


    // Get all souvenirs
    public function getAllSouvenirs()
    {
        $sql = "SELECT * FROM souvenir";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a souvenir by ID
    public function getSouvenirById($souvenirId)
    {
        $sql = "SELECT * FROM souvenir WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$souvenirId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buy a souvenir
    public function buySouvenir($userId, $souvenirId, $quantity)
    {
        $souvenir = $this->getSouvenirById($souvenirId);

        if (!$souvenir) {
            return 'Invalid souvenir';
        }

        if ($souvenir['available_items'] < $quantity) {
            return 'Insufficient items available';
        }

        $totalCost = $souvenir['price'] * $quantity;

        // Assuming you have an orders table to store user orders
        $sql = "INSERT INTO orders (user_id, souvenir_id, quantity, total_cost, order_date)
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $souvenirId, $quantity, $totalCost]);

        // Update available items in the souvenir table
        $this->updateAvailableItems($souvenirId, $quantity);

        return 'Souvenir purchased successfully';
    }

    // Update available items in the souvenir table
    private function updateAvailableItems($souvenirId, $quantity)
    {
        $sql = "UPDATE souvenir SET available_items = available_items - ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$quantity, $souvenirId]);
    }
}

?>
