<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: sans-serif;
            padding: 0;
            margin: 0;
        }
        h1{
            text-align: center;
            text-transform: capitalize;
            background-color: lightgreen;
            line-height: 50px;
        }

        body{
    font-family: Arial;
    background:#f4f4f4;
    text-align:center;
}

.title{
    margin-top:20px;
    color:#333;
}

.map-container{
    width:80%;
    margin:auto;
    margin-top:30px;
    border:4px solid #333;
    border-radius:10px;
    overflow:hidden;
}

.map-container iframe{
    width:100%;
    height:450px;
}

nav{
   background-color: lightblue;
   
   padding:0;
   font-size: 40px;
   line-height: 40px;
}


nav p{
    margin-left: 20px;
}
nav a{
    margin-left: 50px;
}

nav select{
    margin-left: 600px;
}

nav a , select{
     /* margin-left: 250px;  */
    text-decoration: none;
    text-transform: capitalize;

}


nav select, button{
    font-size: 40px;
    border-radius: 20px;
    background-color: lightcoral;

}

 nav button:hover{
    background-color: yellow;
}




footer{
    background: green;
    color: white;
    text-align: center;
    padding: 10px;
    
    bottom: 0;
    line-height: 49px;
}

/* this is the two button */
.bbutton{
    width: 200px;
    text-decoration: none;
    color: wheat;
    text-transform: capitalize;
    background-color: lightblue;
    padding-left: 30px;
    color: black;
    text-align: center;

}

.bbutton a{
    text-decoration: none;
    text-align: center;
    padding-right: 20px;
    
    
    
}

.hbbutton a{
    text-decoration: none;
    text-align: center;
    padding-left: 20px;
    
}

.hbbutton{
    width: 200px;
    text-decoration: none;
    color: wheat;
    text-transform: capitalize;
    background-color: lightblue;
    color: black;
    text-align: center;


}
.bh{
    margin-left: 9%;
}


/* this is the contect and incharge of the departement */

.team1{
    width: 400px;
    height: 480px;
    font-size: 10px;
    background-color: lightblue;
    border-radius: 15px;
    line-height: 20px;
}
.team1 img{
width:100%;
height:350px;
object-fit:cover;
border-radius: 15px;
background-image: cover;

}
.teamm{
    margin-left: 40%;
}
.t{
    font-size: normal;
    line-height: 25px;
}


/* Sections */
.box {
    background-color: #42b6f5;
    color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 12px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}




    </style>
</head>
<body>
    <h1>this is the belong to the ballari real estate management</h1>

    <nav>
       
        <a href="myproject.php">Home</a>
        <a href="#contect">contect</a>

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

    





    
    

<h2 class="title">Kurugodu Karnataka Map</h2>

<div class="map-container">
<iframe 
src="https://maps.google.com/maps?q=Kurugodu%20Karnataka&t=&z=13&ie=UTF8&iwloc=&output=embed"
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