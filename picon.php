<!DOCTYPE html>
<html>
<head>
  <title>Image Click Open</title>

  <style>
    body{
      margin:0;
      height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      background: linear-gradient(135deg, #667eea, #764ba2);
      font-family: Arial, sans-serif;
    }

    .card{
      text-align:center;
    }

    .card a{
      text-decoration:none;
      color:#333;
      display:inline-block;
      background:white;
      padding:25px;
      border-radius:15px;
      box-shadow:0 10px 25px rgba(0,0,0,0.2);
      transition:0.3s ease;
    }

    .card a:hover{
      transform:translateY(-8px);
      box-shadow:0 15px 35px rgba(0,0,0,0.3);
    }

    .card img{
      width:280px;   /* Image size increase */
      border-radius:12px;
      display:block;
      margin:0 auto 15px auto;
      transition:0.3s;
    }

    .card h2{
      margin:0;
      font-size:22px;
      color:#444;
    }

  </style>
</head>

<body>

  <div class="card">
    <a href="realestateadmin.php">
      <img src="icon.jpg" alt="Real Estate">
      <h2>Real Estate Management</h2>
    </a>
  </div>

</body>
</html>