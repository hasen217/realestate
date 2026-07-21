<?php
ob_start(); // Start output buffering

$host = "localhost";
$user = "root";
$password = "";
$dbname = "real_estate";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";

// FORM SUBMIT
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
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>




<script>
function closePopup() {
    document.getElementById("successPopup").style.display = "none";
}

// Show popup if URL has ?success=1
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        document.getElementById("successPopup").style.display = "block";
        window.history.replaceState({}, document.title, window.location.pathname); // remove query string
    }
};
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      


/* RESET */
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

/* BODY */
body{
background: linear-gradient(135deg,#667eea,#764ba2);
min-height:100vh;
}

/* HEADER */
h1{
text-align:center;
background: linear-gradient(90deg,#00c6ff,#0072ff);
color:white;
padding:15px;
letter-spacing:1px;
box-shadow:0 5px 20px rgba(0,0,0,0.3);
}

/* NAVBAR */
nav{
background: rgba(0,0,0,0.6);
backdrop-filter: blur(10px);
display:flex;
align-items:center;
gap:20px;
padding:15px;
flex-wrap:wrap;
}

nav a{
color:white;
text-decoration:none;
font-size:18px;
font-weight:600;
position:relative;
}

nav a::after{
content:"";
position:absolute;
left:0;
bottom:-5px;
width:0%;
height:2px;
background:#00f5d4;
transition:0.3s;
}

nav a:hover::after{
width:100%;
}

nav .serch{
margin-left:auto;
padding:10px;
border-radius:10px;
border:none;
width:250px;
outline:none;
}

nav .button{
padding:10px 15px;
border:none;
border-radius:10px;
background:#00c6ff;
color:white;
cursor:pointer;
transition:0.3s;
}

nav .button:hover{
background:#0072ff;
transform:scale(1.05);
}

/* CARDS CONTAINER */
.properties{
display:flex;
justify-content:center;
flex-wrap:wrap;
gap:25px;
padding:30px;
}

/* CARD DESIGN */
.card{
background: rgba(255,255,255,0.15);
backdrop-filter: blur(12px);
width:300px;
border-radius:15px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.4);
transition:0.4s;
}

.card:hover{
transform:translateY(-10px) scale(1.03);
}

.card img{
width:100%;
height:200px;
object-fit:cover;
}

.card h3{
color:#fff;
margin:10px;
}

.card p{
padding:5px 15px;
color:#f1f1f1;
}

/* BUTTON */
.card button{
margin:15px;
padding:10px;
width:90%;
border:none;
background:linear-gradient(45deg,#00c6ff,#0072ff);
color:white;
border-radius:8px;
cursor:pointer;
transition:0.3s;
font-weight:bold;
}

.card button:hover{
background:linear-gradient(45deg,#ff6a00,#ee0979);
transform:scale(1.05);
}

/* LINK INSIDE BUTTON */
.card a{
color:white;
text-decoration:none;
}

/* BACK + HOME BUTTON */
.a,.b{
padding:12px 20px;
border:none;
border-radius:25px;
background:linear-gradient(45deg,#00c6ff,#0072ff);
color:white;
font-size:18px;
font-weight:bold;
cursor:pointer;
transition:0.3s;
margin:10px;
}

.a{
display:block;
margin:20px auto;
}

.b{
display:block;
margin:10px auto;
}

.a:hover,.b:hover{
background:linear-gradient(45deg,#ff6a00,#ee0979);
transform:scale(1.05);
}

/* FOOTER */
footer{
background: rgba(0,0,0,0.7);
color:white;
text-align:center;
padding:15px;
font-size:14px;
}

/* RESPONSIVE */
@media(max-width:768px){

nav{
flex-direction:column;
align-items:flex-start;
}

nav .serch{
width:100%;
}

.properties{
flex-direction:column;
align-items:center;
}
}







    </style>
</head>
<body>
    <h1>

        this is the cowl bazar properties
    </h1>

    <nav>
        <a href="../Ballari.php">home</a>
        <a href="">contect</a>
        
        

            <input   class="serch" type="text" id="searchInput" placeholder="Search property">
            <button class="button" onclick="searchProperty()">Search</button>
        
        
    </nav>

    <!-- this is the cowl bazar properties -->

    <br>
<div class="properties">

    
    <div class="card">
        <img src="../ballarip/renthomeballari.jpg">
        <h3>home</h3>
        <p>Location: cowl bazar  near jagruti nagar</p>
        <p>Price: ₹20,00,000</p>
        <button onclick="bookProperty(' home')"> <a href="form.php">Book Now </a></button>
        
    </div>
    
    
    <!-- this is one properti -->
    <div class="card">
        <img src="">
        <h3>Plot</h3>
        <p>Location: cowl near police station</p>
        <p>Price: ₹40,00,000</p>
        <button onclick="bookProperty(' Plot')"><a href="form.php">Book Now </a></button>
    </div>
    
    
    <!-- this is the second properti -->
    <div class="card">
        <img src="https://via.placeholder.com/300x200">
        <h3>Plot</h3>
        <p>Location: cowl near mohammadiya collage</p>
        <p>Price: ₹30,00,000</p>
        <button onclick="bookProperty(' Plot')"> <a href="form.php">Book Now </a></button>
    </div>
    
    <!-- this is the thierd properties -->
     <div class="card">
        <img src="https://via.placeholder.com/300x200">
        <h3>home rent</h3>
        <p>Location: cowl near divane mastan darga</p>
        <p>Price: ₹10000</p>
        <button onclick="bookProperty(' home rent')"><a href="form.php"></a> Book Now </a>  </button>
    </div>


    
    <!-- this is the fourth properties -->
     <div class="card">
        <img src="https://via.placeholder.com/300x200">
        <h3>home rent</h3>
        <p>Location: cowl near divane mastan darga</p>
        <p>Price: ₹10000</p>
        <button onclick="bookProperty(' home rent')">Book Now</button>
    </div>
    </div>
  

    
    
    <br>



  <a href="../Ballari.php"><button class="a">back</button></a>
  <a href="../myproject.php"><button class="b">home</button></a>
  <br><br>
<footer>  © 2026  All Rights Reservedthis is the all the propertice 
        are belong to the cowl bazar side that is includin the 
        house and plot and apartment and also rent building are so availabe plece contect our 
        departmet
    </footer>










</body>


    <script>
// 🔍 SEARCH FUNCTION
function searchProperty() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let cards = document.querySelectorAll(".card");

    cards.forEach(function(card) {
        let text = card.innerText.toLowerCase();

        if (text.includes(input)) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

// // 🛒 BOOK BUTTON
// function bookProperty(name) {
//     alert(name + " booked successfully!");
// }

// 🏠 HOME BUTTON
document.querySelector(".a").onclick = function() {
    window.location.href = "ballarip/Ballari.php"; // yaha apna home page link daalna
};

// 🔙 BACK BUTTON
document.querySelector(".b").onclick = function() {
    window.history.back();
};

// ⌨️ ENTER KEY se search
document.getElementById("searchInput").addEventListener("keyup", function(e){
    if(e.key === "Enter"){
        searchProperty();
    }
});
</script>


</html>