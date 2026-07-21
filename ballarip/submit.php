
<html>
    <body>
        
    
<?php
// Database configuration
$host = "localhost";
$user = "root";        // Your DB username
$password = "";        // Your DB password
$dbname = "real_estate";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $property = $conn->real_escape_string($_POST['property']);
    $source = $conn->real_escape_string($_POST['source']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database
    $sql = "INSERT INTO referrals (name, email, phone, property, source, message) 
            VALUES ('$name', '$email', '$phone', '$property', '$source', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green; text-align:center;'>Thank you! Your referral has been submitted.</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

    
</body>
</html>