<!DOCTYPE html>
<html>
<head>
    <title>Faculty Members</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #1bcaa4;
        }

        header {
            background: #5a2d2d;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 40px;
        }

        .card {
            background: white;
            width: 280px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .designation {
            background: #107f83;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 12px;
            border: none;
            background: #5a2d2d;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background: #7a3d3d;
        }
    </style>
</head>

<body>

<header>
    <h2>SHREE MEDHA DEGREE COLLEGE</h2>
</header>

<div class="container">

    <!-- Faculty 1 -->
    <div class="card">
        <img src="sharuk.jpg" alt="Faculty Photo">
        <div class="card-content">
            <h3>Mr. Manjunatha Balluli</h3>
            <span class="designation">Professor & HOD</span>
            <p><strong>Qualification:</strong> MCA, M.Sc(CS), MBA</p>
            <p><strong>Experience:</strong> 19 Years</p>
            <p><strong>Email:</strong> jcmanju@outlook.com</p>
            <button onclick="showMessage('Mr. Manjunatha Balluli')">
                View Profile
            </button>
        </div>
    </div>

    <!-- Faculty 2 -->
    <div class="card">
        <img src="images/vinutha.jpg" alt="Faculty Photo">
        <div class="card-content">
            <h3>Mrs. Vinutha H M</h3>
            <span class="designation">Professor</span>
            <p><strong>Qualification:</strong> M.Sc(CS), B.Ed, KSET</p>
            <p><strong>Experience:</strong> 14 Years</p>
            <p><strong>Email:</strong> vinutha.hm88@gmail.com</p>
            <button onclick="showMessage('Mrs. Vinutha H M')">
                View Profile
            </button>
        </div>
    </div>

    <!-- Faculty 3 -->
    <div class="card">
        <img src="salman.webp" alt="Faculty Photo" style="height:400px;>
        <div class="card-content">
            <h3>Ms. Poonam Warnulkar</h3>
            <span class="designation">Associate Professor</span>
            <p><strong>Qualification:</strong> M.Sc(CS)</p>
            <p><strong>Experience:</strong> 10 Years</p>
            <p><strong>Email:</strong> poonamsmdc2016@gmail.com</p>
            <button onclick="showMessage('Ms. Poonam Warnulkar')">
                View Profile
            </button>
        </div>
    </div>




    <div class="card">
        <img src="images/poonam.jpg" alt="Faculty Photo">
        <div class="card-content">
            <h3>Ms. Poonam Warnulkar</h3>
            <span class="designation">Associate Professor</span>
            <p><strong>Qualification:</strong> M.Sc(CS)</p>
            <p><strong>Experience:</strong> 10 Years</p>
            <p><strong>Email:</strong> poonamsmdc2016@gmail.com</p>
            <button onclick="showMessage('Ms. Poonam Warnulkar')">
                View Profile
            </button>
        </div>
    </div>


</div>

<script>
    function showMessage(name) {
        alert("Welcome to " + name + "'s Profile Page");
    }
</script>

</body>
</html>