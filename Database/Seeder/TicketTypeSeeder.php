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

    // Seed the User table with an admin user
    $ticket_tpes = [
        ["Student Ticket",25],
        ["Visitor Ticket",50],
        // Add more souvenir data as needed
    ];

        // Prepare the SQL statement for insertion
        $stmt = $pdo->prepare("INSERT INTO ticket_type (name,cost) VALUES (?, ?)");

        // Iterate through the souvenirs and insert them into the table
        foreach ($ticket_tpes as $type) {
            $stmt->execute($type);
        }

        echo "Ticket Types table seeded successfully.\n";
    } 
    catch (PDOException $e)
     {
        echo "Error: " . $e->getMessage() . "\n";
    }

?>
