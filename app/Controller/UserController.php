<?php

include 'Database/Model/Connection.php';

class UserController
{
    private $pdo;

    public function __construct()
    {
        // Initialize the $pdo property with the global PDO object created in the included file
        global $pdo;
        $this->pdo = $pdo;
    }

    public function profile()
    {
        // Your profile logic here
    }

    public function buySouvenir($userId, $souvenirId, $quantity)
    {
        $souvenir = new Souvenir($this->pdo);
        $souvenir->buySouvenir($userId, $souvenirId, $quantity);
    }

    public function Souvenir()
    {
        header("Location: index.php");
        
    }
}

?>

