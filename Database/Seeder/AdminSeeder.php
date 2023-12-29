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
    $firstName = 'Mohamed';
    $lastName = 'Ramadan';
    $username = 'Admin';
    $email = 'admin@mail.com';
    $hashedPassword = password_hash('123', PASSWORD_DEFAULT);

    $sqlSeedAdmin = "
    INSERT INTO User (first_name, last_name, username, email, password)
    VALUES ('$firstName', '$lastName', '$username', '$email', '$hashedPassword')";

    // Execute the query to seed admin user
    $pdo->exec($sqlSeedAdmin);

    // Get the ID of the inserted admin user
    $adminUserId = $pdo->lastInsertId();

    // Seed the user_role table with the admin role for the admin user
    $sqlSeedAdminRole = "
    INSERT INTO user_role (user_id, role)
    VALUES ($adminUserId, 'admin')";

    // Execute the query to seed admin role
    $pdo->exec($sqlSeedAdminRole);

    echo "Admin user seeded successfully";

} catch (PDOException $e) {
    echo "Error seeding admin user: " . $e->getMessage();
}

?>
