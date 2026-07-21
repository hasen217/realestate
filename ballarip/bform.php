<!DOCTYPE html><html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refer a Friend - Real Estate</title><style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.container {
    max-width: 500px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    color: #f4a000;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
}

input, select, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea {
    height: 100px;
}

.btn {
    margin-top: 20px;
    background: #f4a000;
    color: #fff;
    border: none;
    padding: 12px;
    width: 100%;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

/* Floating Buttons */
.whatsapp {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #25D366;
    color: white;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    text-decoration: none;
}

.call {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: #2c3e94;
    color: white;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    text-decoration: none;
}

.success {
    color: green;
    margin-top: 10px;
    display: none;
}
</style></head>
<body><div class="container">
    <h2>REFER A FRIEND</h2>
    <form id="refForm" method="POST" action="POST" >

<label>Full Name *</label>
<input type="text" name="name" required>

<label>Email *</label>
<input type="email" name="email" required>

<label>Phone Number *</label>
<input type="tel" name="phone" required>

<label>Select Property</label>
<select name="property">
    <option>Apartment</option>
    <option>Villa</option>
    <option>Plot</option>
</select>

<label>How did you know about us?</label>
<input type="text" name="source">

<label>Message</label>
<textarea name="message"></textarea>

<button type="submit" class="btn">Submit</button>

</form>

</div><!-- WhatsApp Button --><a href="https://wa.me/919999999999" class="whatsapp" target="_blank">💬</a>

<!-- Call Button --><a href="tel:+919999999999" class="call">📞</a>


</script><!-- CONTACT INFO --><div class="container">
    <h2>CONTACT INFO</h2>
    <p>📞 +91 </p>
    <p>📞 Office: +91</p>
    <p>📍 address <br>Bellary, Karnataka - 583101</p>
    <p>📧 @gmail.com</p>
    <p>📧 .com</p><h2>SOCIAL MEDIA</h2>
<div style="display:flex; gap:10px; margin-top:10px;">
    <a href="#" style="padding:10px; background:#eee; border-radius:5px;">f</a>
    <a href="#" style="padding:10px; background:#eee; border-radius:5px;">t</a>
    <a href="#" style="padding:10px; background:#eee; border-radius:5px;">✉</a>
    <a href="#" style="padding:10px; background:#eee; border-radius:5px;">📷</a>
</div>

</div><!-- GOOGLE MAP --><div style="margin:20px;">
    <iframe 
        src="https://maps.google.com/maps?q=Bellary%20Karnataka&t=&z=13&ie=UTF8&iwloc=&output=embed" 
        width="100%" 
        height="250" 
        style="border:0; border-radius:10px;" 
        allowfullscreen="" 
        loading="lazy">
    </iframe>
</div>


</body>


    
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




</html>
