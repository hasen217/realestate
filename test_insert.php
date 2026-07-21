<?php
include 'db_connect.php';
try {
    $sql = "INSERT INTO properties (title, type, status, price, area, description, city, address, images, bedrooms, bathrooms, amenities) 
            VALUES ('Test Title', 'house', 'sale', 1000, 100, 'Test Desc', 'Test City', 'Test Address', '[]', NULL, NULL, NULL)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo "Insert successful. ID: " . $pdo->lastInsertId();
    // Delete the test row
    $pdo->query("DELETE FROM properties WHERE id = " . $pdo->lastInsertId());
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
