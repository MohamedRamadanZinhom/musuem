<?php

$host = 'localhost';
$dbname = 'EgyptionMusuem';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to create the User table
    $sqlUser = "
    CREATE TABLE IF NOT EXISTS User (
        id INT PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        username VARCHAR(255) UNIQUE NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        isblocked BOOLEAN DEFAULT 0,
        deleted BOOLEAN DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    // Execute the query to create User table
    $pdo->exec($sqlUser);

    // SQL query to create the user_role table
    $sqlUserRole = "
    CREATE TABLE IF NOT EXISTS user_role (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        role VARCHAR(255) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES User(id)
    )";

    // Execute the query to create user_role table
    $pdo->exec($sqlUserRole);

    // SQL query to create the ticket_type table
    $sqlTicketType = "
    CREATE TABLE IF NOT EXISTS ticket_type (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        cost DECIMAL(10, 2) NOT NULL
    )";

    // Execute the query to create ticket_type table
    $pdo->exec($sqlTicketType);



    // SQL query to create the ticket table
    $sqlTicket = "
    CREATE TABLE IF NOT EXISTS ticket (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        ticket_type_id INT,
        quantity INT NOT NULL,
        total_cost DECIMAL(10, 2) NOT NULL,
        booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES User(id),
        FOREIGN KEY (ticket_type_id) REFERENCES ticket_type(id)
    )";

    // Execute the query to create ticket table
    $pdo->exec($sqlTicket);

     // SQL query to create the souvenir table
     $sqlSouvenir = "
     CREATE TABLE IF NOT EXISTS souvenir (
         id INT PRIMARY KEY AUTO_INCREMENT,
         name VARCHAR(255) NOT NULL,
         description TEXT,
         image VARCHAR(255) DEFAULT NULL,
         price DECIMAL(10, 2) NOT NULL,
         available_items INT NOT NULL
     )";
 
     // Execute the query to create souvenir table
     $pdo->exec($sqlSouvenir);
 
     // SQL query to create the order table
     $sqlOrder = "
     CREATE TABLE IF NOT EXISTS orders (
         id INT PRIMARY KEY AUTO_INCREMENT,
         user_id INT,
         souvenir_id INT,
         quantity INT NOT NULL,
         total_cost DECIMAL(10, 2) NOT NULL,
         status VARCHAR(255) DEFAULT 'pending',
         order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
         FOREIGN KEY (user_id) REFERENCES User(id),
         FOREIGN KEY (souvenir_id) REFERENCES souvenir(id)
     )";
 
     // Execute the query to create orders table
     $pdo->exec($sqlOrder);

     $sqlContent = "
     CREATE TABLE IF NOT EXISTS content (
         id INT PRIMARY KEY AUTO_INCREMENT,
         name VARCHAR(255) NOT NULL,
         description TEXT,
         image VARCHAR(255) DEFAULT NULL,
         user_id INT,
         FOREIGN KEY (user_id) REFERENCES User(id)
     )";
 
 
     // Execute the query to create content table
     $pdo->exec($sqlContent);
 

    echo "Database tables created successfully";

} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}


?>
