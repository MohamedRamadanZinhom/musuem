<?php



class Product {
    private $conn;

    public function __construct() {
        include('Connection.php');
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createProduct($name, $price, $image) {
        $sql = "INSERT INTO products (name, price, image) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sds", $name, $price, $image);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getProduct($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();

        return $result;
    }

    public function updateProduct($id, $name, $price, $image) {
        $sql = "UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdsi", $name, $price, $image, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Example usage:
// $productManager = new Product($host, $username, $password, $database);
// $productManager->createProduct("Sample Product", 19.99, "sample.jpg");
// $productData = $productManager->getProduct(1);
// $productManager->updateProduct(1, "Updated Product", 29.99, "updated.jpg");
// $productManager->deleteProduct(1);
// $allProducts = $productManager->getAllProducts();
// $productManager->closeConnection();
