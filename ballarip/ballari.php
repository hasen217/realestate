<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ballari Real Estate Management</title>
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
        }

        .main-title {
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

        nav select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 0.95rem;
            outline: none;
            transition: var(--transition);
            cursor: pointer;
        }

        nav select option {
            background: var(--bg-dark);
            color: var(--white);
        }

        nav select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary);
        }

        nav button {
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

        nav button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }

        /* Locations Grid */
        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .box {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 25px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
        }

        .box:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .box h2 {
            margin-bottom: 15px;
            font-size: 1.5rem;
        }
        
        .box h2 a {
            text-decoration: none;
            color: var(--bg-dark);
            transition: var(--transition);
        }

        .box:hover h2 a {
            color: var(--primary);
        }

        .box p {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 1rem;
        }

        /* Title Sections */
        .title {
            margin: 50px 0 20px;
            color: var(--bg-dark);
            font-size: 2.2rem;
            position: relative;
            text-align: center;
        }
        
        .title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
        }

        /* Map */
        .map-container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto 60px;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            border: 5px solid var(--white);
            background: var(--white);
            padding: 5px;
        }

        .map-container iframe {
            width: 100%;
            height: 450px;
            border-radius: calc(var(--radius-md) - 5px);
            filter: grayscale(15%) contrast(1.1);
            transition: var(--transition);
            display: block;
        }

        .map-container:hover iframe {
            filter: none;
        }

        
        /* Team / Incharge Section */
        .teamm {
            display: flex;
            justify-content: center;
            width: 100%;
            margin: 40px 0 60px;
            padding: 0 20px;
        }

        .team1 {
            background: var(--white);
            width: 100%;
            max-width: 420px;
            border-radius: var(--radius-md);
            padding: 35px 30px;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .team1:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg), 0 10px 30px rgba(67, 97, 238, 0.1);
        }

        .team1 img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 4px solid var(--white);
            box-shadow: 0 0 0 4px var(--primary);
            transition: var(--transition);
        }

        .team1:hover img {
            transform: scale(1.05) rotate(3deg);
        }

        .team1 p {
            color: var(--accent);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        .t {
            font-size: 0.95rem;
            color: var(--text-main);
            line-height: 1.6;
            font-weight: 400;
            margin-bottom: 10px;
            text-align: left;
            background: #f8fafc;
            padding: 12px 18px;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
            transition: var(--transition);
        }

        .t:first-of-type {
            font-weight: 600;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.08), rgba(114, 9, 183, 0.08));
            border-color: rgba(67, 97, 238, 0.15);
        }

        .t:hover {
            background: #f1f5f9;
            transform: translateX(4px);
        }

        .team1 button.contact-btn {
            margin-top: 25px;
            width: 100%;
            padding: 14px 20px;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .team1 button.contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.45);
        }

        .team1 button.contact-btn a {
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        /* Buttons Row */
        .bh {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin: 20px 0 60px;
        }

        .bbutton, .hbbutton {
            background: var(--white);
            color: var(--bg-dark);
            border: 2px solid #e2e8f0;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-transform: capitalize;
            min-width: 150px;
        }

        .bbutton:hover, .hbbutton:hover {
            background: var(--bg-dark);
            color: var(--white);
            border-color: var(--bg-dark);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }
        
        .bh a {
            text-decoration: none;
        }

        /* Footer */
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
    <h1 class="main-title">This belongs to the Ballari Real Estate Management</h1>

    <nav>
        <div class="nav-links">
            <a href="../myproject.php">Home</a>
            <a href="../ballarip/ballariform.php">Contact</a>
            <a href="#map">Map</a>
        </div>
        <div class="nav-actions">
            <select id="locationSelect" onchange="searchProperty()">
                <option value="">Location</option>
                <option value="Gandhi Nagar">Gandhi Nagar</option>
                <option value="Cowl Bazaar">Cowl Bazaar</option>
                <option value="Contonment">Contonment</option>
                <option value="Vidya Nagar">Vidya Nagar</option>
                <option value="gandi nager">Gandi Nager</option>
            </select>
            <button onclick="searchProperty()">Search</button>
        </div>
    </nav>

    <div class="locations-grid">
        <section class="box" data-location="Gandhi Nagar">
            <h2><a href="../ballarip/gandinagar.php"><strong>Gandhi Nagar</strong></a></h2>
            <p>Royal circle gandhi nagar and policestation and SN pet, MG Road available</p>
        </section>

        <section class="box" data-location="Cowl Bazaar">
            <h2><a href="../ballarip/cowlbazaar.php"><strong>Cowl Bazaar</strong></a></h2>
            <p>Ballari cowl bazar main road, jagrutinagar, kunitana masjid</p>
        </section>

        <section class="box" data-location="Contonment">
            <h2><a href="../ballarip/cantonment.php"><strong>Cantonment</strong></a></h2>
            <p>Yasmin masjid, souda cross alipur Road available</p>
        </section>

        <section class="box" data-location="Vidya Nagar">
            <h2><a href="../ballarip/vidyanagar.php"><strong>Vidya Nagar</strong></a></h2>
            <p>ramesh hotel kiran pan shop near available</p>
        </section>
    </div>

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

    <!-- Contact & Incharge -->
    <h2 class="title">Area Incharge</h2>
    <div id="contect" class="teamm">
        <div class="team1">
            <img src="../sharuk.jpg" alt="sharuk">
            <p>Incharge</p>
            <div class="t">Name: Sharuk</div>
            <div class="t">Gmail: sharuk@dreamhomes.com</div>
            <div class="t">Location: Ballari Area Manager</div>
            <div class="t">Qualification: Professional Property Advisor</div>
            <button class="contact-btn"><a href="ballariform.php">Contact</a></button>
        </div>
    </div>

    <!-- Back and Home Buttons -->
    <div class="bh">
        <a href="../myproject.php"><button class="bbutton">Back</button></a>
        <a href="../myproject.php"><button class="hbbutton">Home</button></a>
    </div>

    <footer>
        This is the footer of the Ballari real estate. This is the most reliable, trusted department in Ballari, and the best platform in the region.
    </footer>

    <script>
    function searchProperty() {
        console.log("Button clicked"); // check in browser console

        let selected = document.getElementById("locationSelect").value;
        let sections = document.querySelectorAll(".box");

        sections.forEach(function(section) {
            let location = section.getAttribute("data-location");

            if (selected === "") {
                section.style.display = "flex";
            } 
            else if (location === selected) {
                section.style.display = "flex";
            } 
            else {
                section.style.display = "none";
            }
        });
    }
    </script>
</body>
</html>