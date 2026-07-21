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
    background: linear-gradient(135deg,#74ebd5,#acb6e5);
    text-align:center;
}

/* HEADING */
h1{
    background: linear-gradient(90deg,#11998e,#38ef7d);
    color:white;
    padding:15px;
    letter-spacing:1px;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

/* NAVBAR */
nav{
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(10px);
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    align-items:center;
    gap:15px;
    padding:15px;
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
    width:0%;
    height:2px;
    background:yellow;
    bottom:-5px;
    left:0;
    transition:0.3s;
}

nav a:hover::after{
    width:100%;
}

nav select, nav button{
    padding:10px 15px;
    border:none;
    border-radius:10px;
    font-size:16px;
}

nav select{
    background:#ffffff;
}

nav button{
    background:#ff9f1c;
    cursor:pointer;
    transition:0.3s;
}

nav button:hover{
    background:#ffbf69;
    transform:scale(1.05);
}

/* BOX SECTION */
.box{
    background: rgba(255,255,255,0.3);
    backdrop-filter: blur(10px);
    margin:20px auto;
    width:80%;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    transition:0.3s;
}

.box:hover{
    transform:translateY(-5px);
}

.box h2 a{
    text-decoration:none;
    color:#1d3557;
}

.box p{
    margin-top:10px;
}

/* MAP */
.map-container{
    width:85%;
    margin:30px auto;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.4);
}

.map-container iframe{
    width:100%;
    height:450px;
}

/* TEAM */
.teamm{
    display:flex;
    justify-content:center;
    margin-top:20px;
}

.team1{
    width:300px;
    background:white;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.3);
    padding:10px;
    transition:0.3s;
}

.team1:hover{
    transform:scale(1.05);
}

.team1 img{
    width:100%;
    height:250px;
    object-fit:cover;
    border-radius:10px;
}

.t{
    line-height:25px;
}

/* BUTTONS */
.bh{
    display:flex;
    justify-content:center;
    gap:20px;
}

.bbutton, .hbbutton{
    padding:10px 20px;
    border:none;
    border-radius:20px;
    font-size:16px;
    cursor:pointer;
    background:#00b4d8;
    transition:0.3s;
}

.bbutton:hover, .hbbutton:hover{
    background:#0077b6;
    color:white;
}

/* FOOTER */
footer{
    background:#023047;
    color:white;
    padding:15px;
    margin-top:20px;
}

/* MOBILE */
@media(max-width:768px){

    nav{
        flex-direction:column;
    }

    .box{
        width:95%;
    }

    .bh{
        flex-direction:column;
    }
}



    </style>
</head>
<body>
    <h1>this is the belong to the ballari real estate management</h1>

    <nav>
       
        <a href="myproject.php">Home</a>
        <a href="#contect">contect</a>
        <a href="#map">Map</a>

        <select id="locationSelect"  onchange="searchProperty()">
<option value="">Location</option>
<option value="gandi nager">Gandi Nager</option>
<option value="redio park">Redio Park</option>
<option value="suda cross">Suda Cross</option>
<option value="opd road">OPD Road</option>
<option value="s n pet">S N Pet</option>
<option value="cowl bazar">Cowl Bazar</option>
</select>

<button onclick="searchProperty()">Search</button>
    </nav>

  
<br>
    <section class="box" data-location="cowl bazar" >
        <h2> <a href="ballarip/cowlbazar.php">  <strong>Cowl Bazar</strong> </a></h2>
        <p>ballari cowl bazar main road, jagrutinagar , kunitana masjid</p>
    </section>

    <section class="box"  data-location="gandi nager">
        <h2><a href="ballarip/gandinagar.php"> <strong>Gandi Nagar</strong>  </a></h2>
        <p>Royel cercle gandi nagar and ploicestation and SN pet, MG Rode available</p>
    </section>

    <section class="box"  data-location="gandi nager">
        <h2><a href="ballarip/gandinagar.php"> <strong>Gandi Nagar</strong>  </a></h2>
        <p>Royel cercle gandi nagar and ploicestation and SN pet, MG Rode available</p>
    </section>


    <section class="box"  data-location="gandi nager">
        <h2><a href="ballarip/gandinagar.php"> <strong>Gandi Nagar</strong>  </a></h2>
        <p>Royel cercle gandi nagar and ploicestation and SN pet, MG Rode available</p>
    </section>

    





    
    

<h2 class="title">Ballari Karnataka Map</h2>

<div id="map" class="map-container">
<iframe 
src="https://maps.google.com/maps?q=Ballari%20Karnataka&t=&z=13&ie=UTF8&iwloc=&output=embed"
frameborder="0"
scrolling="no"
marginheight="0"
marginwidth="0">
</iframe>
</div>

<!-- this is the contect in formation and the incharge of the department -->
 <br>
 <div  id="contect" class="teamm"  >

<div class="team1">
    <img src="sharuk.jpg" alt="sharuk">
    <p>incharge</p>
    <h2 class="t">Name:Name of the team member</h1>
    <h2 class="t">gmail:gmail of the team membeer</h1>
    <h2 class="t">location: incharge place location</h1>
    <h2 class="t">qalification:Education of the meber</h1>
</div>
 </div>




<br><br>
<!-- this is the button of the back and home -->
 <div class="bh">

     <a href="myproject.php"> <button class="bbutton">back</button></a>
     <a href="myproject.php"> <button  class="hbbutton">home</button></a>
    </div><br>
    


<footer>this is the foter of the Ballari real estate this is the most and good and trusted department in
    in ballri it is the best platform im the Ballari
</footer>



<script>
function searchProperty() {
    console.log("Button clicked"); // check in browser console

    let selected = document.getElementById("locationSelect").value;
    let sections = document.querySelectorAll(".box");

    sections.forEach(function(section) {
        let location = section.getAttribute("data-location");

        if (selected === "") {
            section.style.display = "block";
        } 
        else if (location === selected) {
            section.style.display = "block";
        } 
        else {
            section.style.display = "none";
        }
    });
}
</script>

</body>
</html>
</body>
</html>