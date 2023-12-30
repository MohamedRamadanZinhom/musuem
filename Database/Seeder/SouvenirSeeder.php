<?php

$host = 'localhost';
$dbname = 'egyptionmusuem';
$dbname = 'EgyptionMusuem';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Seed the User table with an admin user
    $souvenirs = [
        ['anubis', 'statue', 'anubis.jpg', 15.99, 100],
        ['gold blue scarab', 'gold blue scarab', 'gold_blue_scarab.jpg', 9.99, 150],
        ['golden-scarab', 'golden scarab', 'golden-scarab.jpg', 5.99, 200],
        ['hippopotamus', 'hippopotamus', 'hippopotamus.jpg', 5.99, 300],
        ['king tut sandal', 'king-tut-sandal', 'king-tut-sandal.jpg', 15.99, 100],
        ['maat', 'maat', 'maat.jpg', 9.99, 150],
        ['painted solar boat', 'painted solar boat', 'painted-solar-boat.jpg', 5.99, 200],
        ['the key to life', 'the-key-to-life', 'the-key-to-life.jpg', 5.99, 300],
        // Add more souvenir data as needed
    ];

        // Prepare the SQL statement for insertion
        $stmt = $pdo->prepare("INSERT INTO souvenir (name, description, image, price, available_items) VALUES (?, ?, ?, ?, ?)");

        // Iterate through the souvenirs and insert them into the table
        foreach ($souvenirs as $souvenir) {
            $stmt->execute($souvenir);
        }

        echo "Souvenir table seeded successfully.\n";
    } 
    catch (PDOException $e)
     {
        echo "Error: " . $e->getMessage() . "\n";
    }

?>
