<?php
require_once '../db_connect.php';
$area_filter = "Ballari Road";
$stmt = $pdo->prepare("SELECT * FROM properties WHERE address LIKE ? OR description LIKE ? ORDER BY id DESC");
$stmt->execute(["%$area_filter%", "%$area_filter%"]);
$db_properties = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ballari Road Properties</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #4361ee;
            --primary-hover: #3a53d0;
            --secondary: #7209b7;
            --accent: #f72585;
            --bg-dark: #0f172a;
            --bg-light: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-main);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            text-transform: capitalize;
            background: linear-gradient(135deg, var(--bg-dark), #1e293b);
            color: var(--white);
            padding: 40px 20px;
            width: 100%;
            font-size: 2.2rem;
            font-weight: 700;
            box-shadow: var(--shadow-md);
        }

        /* NAVIGATION BAR */
        nav {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            width: 100%;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        nav a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            position: relative;
            padding: 5px 0;
            transition: var(--transition);
            text-transform: capitalize;
        }

        nav a::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            background: var(--accent);
            bottom: 0;
            left: 0;
            transition: var(--transition);
        }

        nav a:hover {
            color: var(--accent);
        }

        nav a:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        nav .serch {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 0.95rem;
            outline: none;
            transition: var(--transition);
            width: 300px;
        }

        nav .serch::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        nav .serch:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.3);
        }

        nav .button {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        nav .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }

        /* PROPERTIES GRID */
        .properties {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
        }

        .card {
            background: var(--white);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: var(--transition);
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card h3 {
            color: var(--bg-dark);
            font-size: 1.4rem;
            margin: 20px 20px 10px;
        }

        .card p {
            color: var(--text-muted);
            margin: 0 20px 8px;
            font-size: 0.95rem;
        }

        .card p:nth-of-type(2) {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .card button {
            margin: auto 20px 20px;
            width: calc(100% - 40px);
            padding: 12px;
            border: none;
            background: var(--bg-dark);
            color: var(--white);
            font-size: 1rem;
            font-weight: 600;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .card button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            z-index: -1;
            transition: opacity 0.3s ease;
            opacity: 0;
        }

        .card button:hover::before {
            opacity: 1;
        }

        .card a {
            color: var(--white);
            text-decoration: none;
            display: block;
        }

        /* ACTIONS */
        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin: 20px 0 60px;
        }

        .action-buttons a {
            text-decoration: none;
        }

        .a, .b {
            background: var(--white);
            color: var(--bg-dark);
            border: 2px solid #e2e8f0;
            padding: 12px 35px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-transform: capitalize;
            min-width: 150px;
            display: inline-block;
        }

        .a:hover, .b:hover {
            background: var(--bg-dark);
            color: var(--white);
            border-color: var(--bg-dark);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        /* FOOTER */
        footer {
            background: linear-gradient(135deg, var(--bg-dark), #1e293b);
            color: var(--text-muted);
            text-align: center;
            padding: 40px 20px;
            width: 100%;
            border-top: 1px solid rgba(255,255,255,0.05);
            margin-top: auto;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                justify-content: center;
            }
            .nav-actions {
                flex-direction: column;
                width: 100%;
            }
            nav .serch, nav .button {
                width: 100%;
            }
        }
    
        @media (max-width: 992px) {
            .properties { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
            h1 { font-size: 2rem; }
        }
        @media (max-width: 768px) {
            nav { flex-direction: column; height: auto; padding: 20px 15px; gap: 15px; }
            .nav-links { gap: 15px; width: 100%; justify-content: center; }
            .nav-actions { width: 100%; gap: 10px; }
            .serch { flex: 1; margin: 0; }
            .button { width: auto; min-width: 100px; }
            h1 { font-size: 1.75rem; margin: 20px 0; }
        }
        @media (max-width: 480px) {
            .nav-links { flex-wrap: wrap; }
            .properties { grid-template-columns: 1fr; padding: 10px; }
            .card { margin: 0; }
        }

        @media (max-width: 992px) {
            .properties, .teamm { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
            h1, .section-image h2 { font-size: 2.2rem; }
        }
        @media (max-width: 768px) {
            nav { flex-direction: column; height: auto; padding: 20px 15px; gap: 15px; }
            .nav-links, .nav-actions { width: 100%; gap: 15px; justify-content: center; flex-direction: column; }
            .nav-links a { width: 100%; text-align: center; }
            .serch, .button { width: 100% !important; margin: 0; }
            h1 { font-size: 1.8rem; text-align: center; }
            .section-image { height: 50vh; min-height: 350px; }
            .section-image h2 { font-size: 2rem; }
            .map-container iframe { height: 300px; }
            .teamm { flex-direction: column; align-items: center; }
            .team1 { width: 90% !important; }
        }
</style>
</head>
<body>
    <h1>This is the Ballari Road Properties</h1>

    <nav>
        <div class="nav-links">
            <a href="../kampli/kampli.php">Home</a>
            <a href="../kampli/kampliform.php">Contact</a>
        </div>
        <div class="nav-actions">
            <input class="serch" type="text" id="searchInput" placeholder="Search property">
            <button class="button" onclick="searchProperty()">Search</button>
        </div>
    </nav>

    <!-- PROPERTIES -->
    <div class="properties">
        <div class="card">
            <img src="../kampli/homerent1.jpg" alt="Home Rent">
            <h3>Home Rent</h3>
            <p>Location: Government Hospital near</p>
            <p>Price: ₹5,000 /mo</p>
            <a href="../kampli/kampliform.php?property_title=Home+Rent&property_image=../kampli/homerent1.jpg&property_location=Government Hospital near"><button>Book Now</button></a>
        </div>
        
        <div class="card">
            <img src="../kampli/plot.jpg" alt="Plot">
            <h3>Plot</h3>
            <p>Location: Jamiya masjid near</p>
            <p>Price: ₹40,00,000</p>
            <a href="../kampli/kampliform.php?property_title=Plot&property_image=../kampli/plot.jpg&property_location=Jamiya masjid near"><button>Book Now</button></a>
        </div>
        
        <div class="card">
            <img src="../kampli/homesale.jpg" alt="Home Sale">
            <h3>Home Sale</h3>
            <p>Location: Gangotri Kalyana Mantapa near</p>
            <p>Price: ₹20,00,000</p>
            <a href="../kampli/kampliform.php?property_title=Home+Sale&property_image=../kampli/homesale.jpg&property_location=Gangotri Kalyana Mantapa near"><button>Book Now</button></a>
        </div>
        
        <div class="card">
            <img src="../kampli/landsale.jpg" alt="Land Sale">
            <h3>Land Sale</h3>
            <p>Location: Reliance Petroleum near</p>
            <p>Price: ₹10,00,000</p>
            <a href="../kampli/kampliform.php?property_title=Land+Sale&property_image=../kampli/landsale.jpg&property_location=Reliance Petroleum near"><button>Book Now</button></a>
        </div>

        <div class="card">
            <img src="../kampli/homerent2.jpg" alt="Home Rent">
            <h3>Home Rent</h3>
            <p>Location: Kampli APMC near</p>
            <p>Price: ₹5,000 /mo</p>
            <a href="../kampli/kampliform.php?property_title=Home+Rent&property_image=../kampli/homerent2.jpg&property_location=Kampli APMC near"><button>Book Now</button></a>
        </div>
        
        <?php foreach ($db_properties as $property): 
            $images = json_decode($property['images'], true);
            $first_image = !empty($images) ? '../' . $images[0] : '../kampli/homerent1.jpg';
            $booking_url = "../kampli/kampliform.php?" . http_build_query([
                'property_title' => $property['title'],
                'property_image' => $first_image,
                'property_location' => $property['address'] . ', ' . $property['city']
            ]);
        ?>
        <div class="card">
            <img src="<?php echo htmlspecialchars($first_image); ?>" alt="<?php echo htmlspecialchars($property['title']); ?>">
            <h3><?php echo htmlspecialchars($property['title']); ?></h3>
            <p>Location: <?php echo htmlspecialchars($property['address'] . ', ' . $property['city']); ?></p>
            <p>Price: ₹<?php echo number_format($property['price']); ?><?php echo ($property['status'] == 'rent') ? ' /mo' : ''; ?></p>
            <a href="<?php echo $booking_url; ?>"><button>Book Now</button></a>
        </div>
        <?php endforeach; ?>
    </div>
  
    <!-- BACK/HOME BUTTONS -->
    <div class="action-buttons">
        <a href="../kampli/kampli.php"><button class="a">Back</button></a>
        <a href="../myproject.php"><button class="b">Home</button></a>
    </div>

    <!-- FOOTER -->
    <footer>
        © 2026 All Rights Reserved. These properties belong to the Ballari Road side, including houses, plots, apartments, and rental buildings. Please contact our department for details.
    </footer>

    <script>
        // 🔍 SEARCH FUNCTION
        function searchProperty() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let cards = document.querySelectorAll(".card");

            cards.forEach(function(card) {
                let text = card.innerText.toLowerCase();

                if (text.includes(input)) {
                    card.style.display = "flex";
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
            window.location.href = "kampli/kampli.php"; 
        };

        // 🔙 BACK BUTTON
        document.querySelector(".b").onclick = function() {
            window.history.back();
        };

        // ⌨️ ENTER KEY
        document.getElementById("searchInput").addEventListener("keyup", function(e){
            if(e.key === "Enter"){
                searchProperty();
            }
        });
    </script>
</body>
</html>