<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "real_estate";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";

// ✅ FORM SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $property = $_POST['property'];
    $source = $_POST['source'];
    $message = $_POST['message'];

    $sql = "INSERT INTO referrals (name, email, phone, property, source, message)
            VALUES ('$name','$email','$phone','$property','$source','$message')";

    if ($conn->query($sql) === TRUE) {
        // ✅ REDIRECT (VERY IMPORTANT)
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refer a Friend - Real Estate</title>
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; }
.container { max-width: 500px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
h2 { color: #f4a000; }
label { display: block; margin-top: 15px; font-weight: bold; }
input, select, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
textarea { height: 100px; }
.btn { margin-top: 20px; background: #f4a000; color: #fff; border: none; padding: 12px; width: 100%; font-size: 16px; border-radius: 5px; cursor: pointer; }
.success { color: green; margin-top: 10px; text-align:center; }

.back{
    text-align: center;
    text-decoration: none;
    margin-left: 50%;
    width: 300px;
    height: 200px;
    border: 2px solid black;
    font-size: 25px;
    border-radius: 5px;
    background-color: lightblue;
    color: black;

    
}

.back a{
    width: 290px;
    height: 120px;
    background-color: lightblue;
    font-size: 30px;
    color: white;
}

.back a:hover{
    background-color: orangered;
}
</style>
</head>
<body>

<div class="container">
    <h2>REFER A FRIEND</h2>

    <?php if($success != ""): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form id="refForm" method="POST">
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
            <option>Rent Home</option>
            <option>land</option>
            <option>home</option>
        </select>

        <label>How did you know about us?</label>
        <input type="text" name="source">

        <label>Message</label>
        <textarea name="message"></textarea>

        <button type="submit" class="btn">Submit</button>
    </form>
</div>






<!-- SUCCESS POPUP -->
<div id="successPopup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">

  <div style="background:white; width:300px; margin:150px auto; padding:20px; text-align:center; border-radius:10px;">
    
    <h3 style="color:green;">✅ Success</h3>
    <p>Thank you! Your referral has been submitted.</p>

    <button onclick="closePopup()" style="padding:10px; background:green; color:white; border:none; border-radius:5px;">
        OK
    </button>

  </div>

</div>



<script>
function closePopup() {
    document.getElementById("successPopup").style.display = "none";
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('success') === '1') {
        document.getElementById("successPopup").style.display = "block";

        // clean URL (remove ?success=1)
        window.history.replaceState({}, document.title, window.location.pathname);
    }
};
</script>


 <a href="../Ballari.php" class="back">Back</a>
</body>
</html>