<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandur Real Estate Management</title>
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

        .search-container {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        nav select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 1rem;
            outline: none;
            cursor: pointer;
            transition: var(--transition);
            appearance: none;
            min-width: 200px;
        }

        nav select option {
            background: var(--bg-dark);
            color: var(--white);
        }

        nav select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.3);
        }

        nav button {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        nav button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }

        /* LOCATIONS GRID */
        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
        }

        .box {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid #e2e8f0;
            border-left: 5px solid var(--primary);
            position: relative;
            overflow: hidden;
            display: block; /* Important since it acts as container */
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-left-color: var(--secondary);
        }

        .box::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(67, 97, 238, 0.05) 100%);
        }

        .box a {
            text-decoration: none;
            display: block;
        }

        .box h2 {
            color: var(--bg-dark);
            font-size: 1.5rem;
            margin-bottom: 15px;
            transition: var(--transition);
        }

        .box:hover h2 {
            color: var(--primary);
        }

        .box p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* MAP SECTION */
        .title {
            color: var(--bg-dark);
            font-size: 2rem;
            margin: 40px 0 20px;
            position: relative;
            display: inline-block;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .map-container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            border: 5px solid var(--white);
        }

        .map-container iframe {
            width: 100%;
            height: 450px;
            display: block;
        }

        

        /* ACTION BUTTONS */
        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin: 40px 0 60px;
        }

        .action-buttons a {
            text-decoration: none;
        }

        .bbutton, .hbbutton {
            background: var(--white);
            color: var(--bg-dark);
            border: 2px solid #e2e8f0;
            padding: 12px 40px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-transform: capitalize;
            box-shadow: var(--shadow-sm);
        }

        .bbutton:hover, .hbbutton:hover {
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
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.05);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                justify-content: center;
            }
            .search-container {
                flex-direction: column;
                width: 100%;
            }
            nav select, nav button {
                width: 100%;
            }
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
    <h1>This is the Sandur Real Estate Management</h1>

    <nav>
        <div class="nav-links">
            <a href="../myproject.php">Home</a>
            <a href="../sandur/sandurform.php">Contact</a>
            <a href="#map">Map</a>
        </div>

        <div class="search-container">
            <select id="locationSelect" onchange="searchProperty()">
                <option value="">Location</option>
                <option value="Hospet Road">Hospet Road</option>
                <option value="Kampli Road">Kampli Road</option>
                <option value="Kudligi Road">Kudligi Road</option>
                <option value="Torangal Road">Torangal Road</option>
                <option value="Ballari Road">Ballari Road</option>
            </select>
            <button onclick="searchProperty()">Search</button>
        </div>
    </nav>

    <div class="locations-grid">
        <section class="box" data-location="Hospet Road">
            <a href="../sandur/hospetroad.php">
                <h2><strong>Hospet Road</strong></h2>
                <p>Rajaji Nagar, main road available.</p>
            </a>
        </section>

        <section class="box" data-location="Kampli Road">
            <a href="../sandur/kampliroad.php">
                <h2><strong>Kampli Road</strong></h2>
                <p>Ilahi masjid near available.</p>
            </a>
        </section>

        <section class="box" data-location="Kudligi Road">
            <a href="../sandur/kudligiroad.php">
                <h2><strong>Kudligi Road</strong></h2>
                <p>Government High School road available.</p>
            </a>
        </section>

        <section class="box" data-location="Torangal Road">
            <a href="../sandur/torangalroad.php">
                <h2><strong>Torangal Road</strong></h2>
                <p>Taranagar Road available.</p>
            </a>
        </section>

        <section class="box" data-location="Ballari Road">
            <a href="../sandur/ballariroad.php">
                <h2><strong>Ballari Road</strong></h2>
                <p>Bustan Road available.</p>
            </a>
        </section>
    </div>

    <!-- MAP SECTION -->
    <h2 class="title">Sandur Karnataka Map</h2>
    <div id="map" class="map-container">
        <iframe 
            src="https://maps.google.com/maps?q=Sandur%20Karnataka&t=&z=13&ie=UTF8&iwloc=&output=embed"
            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0">
        </iframe>
    </div>

   

    <!-- action buttons -->
    <div class="action-buttons">
        <a href="../myproject.php"><button class="bbutton">Back</button></a>
        <a href="../myproject.php"><button class="hbbutton">Home</button></a>
    </div>

    <footer>
        This is the footer of the Ballari real estate. This is the most reliable, trusted department in Ballari. It is the best platform in the region.
    </footer>

    <script>
        function searchProperty() {
            let selected = document.getElementById("locationSelect").value;
            let sections = document.querySelectorAll(".box");

            sections.forEach(function(section) {
                let location = section.getAttribute("data-location");

                if (selected === "" || location === selected) {
                    section.style.display = "block";
                } else {
                    section.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>