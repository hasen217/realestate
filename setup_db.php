<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';

try {
    // Connect without database first to create it
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS real_estate_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database created or already exists.<br>";

    // Connect to the created database
    $pdo->exec("USE real_estate_db");

    // Create properties table
    $sql = "CREATE TABLE IF NOT EXISTS properties (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        type VARCHAR(100) NOT NULL,
        status VARCHAR(100) NOT NULL,
        price DECIMAL(15,2) NOT NULL,
        area INT NOT NULL,
        description TEXT,
        city VARCHAR(100) NOT NULL,
        address VARCHAR(255),
        bedrooms INT,
        bathrooms INT,
        amenities TEXT,
        images TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Table 'properties' created successfully.<br>";

    // Create a unified referrals table
    $sql_referrals = "CREATE TABLE IF NOT EXISTS referrals (
        id INT AUTO_INCREMENT PRIMARY KEY,
        location_source VARCHAR(100) NOT NULL,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        address VARCHAR(255),
        property VARCHAR(255) NOT NULL,
        property_location VARCHAR(255),
        source VARCHAR(255),
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_referrals);
    echo "Table 'referrals' created successfully.<br>";

    // Create a messages table for general contact inquiries
    $sql_messages = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_messages);
    echo "Table 'messages' created successfully.<br>";

    echo "Setup is complete. You can now use the application.";

} catch(PDOException $e) {
    echo "Setup failed: " . $e->getMessage();
}
?>
