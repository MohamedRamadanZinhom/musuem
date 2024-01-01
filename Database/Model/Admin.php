<?php



class Admin {

    private $conn;

    // Constructor to initialize the database connection
    public function __construct() {
     
        include('Connection.php');
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to create a new admin
    public function createAdmin($name ,$email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin_db (name ,$email, password) VALUES ('$name', '$email','$hashedPassword')";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    // Method to get admin by ID
    public function getAdmin($id) {
        $sql = "SELECT * FROM admin_db WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Method to update admin information
    public function updateAdmin($id, $name, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE admin_db SET name = '$name', password = '$hashedPassword' WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    // Method to delete admin by ID
    public function deleteAdmin($id) {
        $sql = "DELETE FROM admin_db WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function Login($username ,$password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM admin_db WHERE name=$username and password= $hashedPassword";
        $result = $this->conn->query($sql);
        session_start();
        $_SESSION['admin_name'] = $result['name'];
        return $result;
    }

    public function Logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: Login.php");
    }

    // Destructor to close the database connection when the object is destroyed
    public function __destruct() {
        $this->conn->close();
    }
}


