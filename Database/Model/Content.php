<?php

include('../connection.php');

class Content {
    private $conn;
    

    public function __construct() {
        include('Connection.php');
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createContent($name, $content, $image) {
        $sql = "INSERT INTO content (name, content, image) VALUES ('$name', '$content', '$image')";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function getContent($id) {
        $sql = "SELECT * FROM content WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function updateContent($id, $name, $content, $image) {
        $sql = "UPDATE content SET name = '$name', content = '$content', image = '$image' WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function deleteContent($id) {
        $sql = "DELETE FROM content WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result ? true : false;
    }

    public function getAllContents() {
        $sql = "SELECT * FROM content";
        $result = $this->conn->query($sql);

        $contents = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $contents[] = $row;
            }
        }

        return $contents;
    }

    public function __destruct() {
        $this->conn->close();
    }
}

