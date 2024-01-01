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
    $contents = [
        ['Mask of Tutankhamun', 'Description for Item 1. Add more details here. This content is a little bit longer', 'Mask of Tutankhamun.jpg', 1],
        ['Narmer Palette', 'Description for Item 1. Add more details here. This content is a little bit longer', 'Narmer Palette.jpg', 1],
        ['king tut', 'Description for Item 1. Add more details here. This content is a little bit longer', 'king tut.jpg', 1],  
        // Add more souvenir data as needed
    ];

        // Prepare the SQL statement for insertion
        $stmt = $pdo->prepare("INSERT INTO content (name, description, image, user_id) VALUES (?, ?, ?, ?)");

        // Iterate through the souvenirs and insert them into the table
        foreach ($contents as $content) {
            $stmt->execute($content);
        }

        echo "Content table seeded successfully.\n";
    } 
    catch (PDOException $e)
     {
        echo "Error: " . $e->getMessage() . "\n";
    }

?>
