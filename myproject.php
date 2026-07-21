<?php require_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Real Estate Management</title>
<link rel="stylesheet" href="myproject.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #4f46e5;
    --primary-hover: #4338ca;
    --secondary: #ec4899;
    --accent: #06b6d4;
    --bg-dark: #0f172a;
    --bg-light: #f8fafc;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --white: #ffffff;
    --glass-bg: rgba(255, 255, 255, 0.7);
    --glass-border: rgba(255, 255, 255, 0.5);
    --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --shadow-hover: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    --radius-sm: 12px;
    --radius-md: 20px;
    --radius-lg: 30px;
    --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
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
}

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-up {
    animation: fadeInUp 0.8s ease-out forwards;
}

/* HEADER */
header {
    background: var(--bg-dark);
    color: var(--white);
    text-align: center;
    padding: 15px 20px;
    font-size: 0.9rem;
    font-weight: 500;
    letter-spacing: 1px;
    display: none; /* Hidden to prefer the sleek nav */
}

/* NAVBAR */
nav {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    padding: 15px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 15px;
    font-weight: 700;
    font-size: 1.5rem;
    color: var(--bg-dark);
    text-decoration: none;
}

.nav-brand img {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: var(--shadow-md);
}

.nav-links {
    display: flex;
    gap: 30px;
    align-items: center;
}

.nav-links a {
    color: var(--text-main);
    text-decoration: none;
    font-weight: 600;
    font-size: 1.05rem;
    position: relative;
    padding: 5px 0;
    transition: var(--transition);
}

.nav-links a::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    bottom: -2px;
    left: 0;
    border-radius: 2px;
    transition: var(--transition);
}

.nav-links a:hover {
    color: var(--primary);
}

.nav-links a:hover::after {
    width: 100%;
}

.nav-actions {
    display: flex;
    gap: 15px;
    align-items: center;
}

/* WELCOME MARQUEE */
.welcomel {
    background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
    background-size: 200% auto;
    color: var(--white);
    padding: 12px 0;
    overflow: hidden;
    white-space: nowrap;
    position: relative;
    box-shadow: inset 0 -2px 10px rgba(0,0,0,0.1);
    animation: gradientShift 5s ease infinite;
}
@keyframes gradientShift { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }

.welcomel h2 {
    display: inline-block;
    padding-left: 100%;
    animation: scroll-left 30s linear infinite;
    font-size: 1.05rem;
    font-weight: 500;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

@keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* HERO SECTION */
.section-image {
    position: relative;
    height: 85vh;
    min-height: 600px;
    background-image: url("bodymain.jpg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: var(--white);
    padding: 0 20px;
}

.section-image::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.9));
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    animation: fadeInUp 1s ease-out;
}

.hero-content h2 {
    font-size: 4.5rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 20px;
    text-shadow: 0 10px 30px rgba(0,0,0,0.3);
    background: linear-gradient(to right, #ffffff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-content p {
    font-size: 1.5rem;
    font-weight: 300;
    margin-bottom: 40px;
    color: #cbd5e1;
}

/* SEARCH BAR */
.search-container {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 15px;
    border-radius: 50px;
    display: flex;
    gap: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
}

.search-container input, .search-container select {
    background: var(--white);
    border: none;
    padding: 18px 25px;
    border-radius: 30px;
    font-size: 1.1rem;
    color: var(--text-main);
    outline: none;
    flex: 1;
    font-weight: 500;
    box-shadow: inner 0 2px 4px rgba(0,0,0,0.05);
}

.search-container button {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: var(--white);
    border: none;
    padding: 18px 40px;
    border-radius: 30px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
}

.search-container button:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4);
}

/* SECTIONS */
.section {
    padding: 100px 20px;
    max-width: 1250px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    font-size: 3rem;
    font-weight: 800;
    color: var(--bg-dark);
    margin-bottom: 60px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 6px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 3px;
}

/* ABOUT */
.slideshow-container {
    max-width: 1000px;
    margin: 0 auto 50px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-hover);
    position: relative;
    aspect-ratio: 16/7;
}

.slide {
    display: none;
    width: 100%;
    height: 100%;
    object-fit: cover;
    animation: fade 1.5s;
}

.about-description {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 60px 50px;
    margin: -80px auto 0;
    max-width: 900px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.08);
    position: relative;
    z-index: 10;
    text-align: center;
}

.about-description p {
    font-size: 1.25rem;
    color: var(--text-muted);
    line-height: 1.8;
}

/* PROPERTIES GRID */
.properties {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 40px;
    padding: 20px 0;
}

.card {
    background: var(--white);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    border: 1px solid rgba(0,0,0,0.03);
    display: flex;
    flex-direction: column;
    position: relative;
}

.card:hover {
    transform: translateY(-15px);
    box-shadow: var(--shadow-hover);
}

.card-img-wrapper {
    position: relative;
    overflow: hidden;
}

.card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.card:hover img {
    transform: scale(1.1);
}

.price-tag {
    position: absolute;
    bottom: -15px;
    right: 20px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: var(--white);
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 10px 20px rgba(236, 72, 153, 0.3);
    z-index: 2;
}

.card-body {
    padding: 30px 20px 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.card h3 {
    color: var(--bg-dark);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.card p.location {
    color: var(--text-muted);
    font-size: 1rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.card button {
    margin-top: auto;
    width: 100%;
    padding: 14px;
    border: none;
    background: var(--bg-dark);
    color: var(--white);
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: var(--transition);
}

.card button:hover {
    background: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
}

/* LOCATIONS GRID */
.locations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.location-card {
    background: var(--white);
    padding: 30px 20px;
    border-radius: var(--radius-md);
    text-align: center;
    text-decoration: none;
    color: var(--bg-dark);
    font-weight: 700;
    font-size: 1.25rem;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    border: 2px solid transparent;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.location-card i {
    font-size: 2.5rem;
    color: var(--primary);
    transition: var(--transition);
}

.location-card:hover {
    transform: translateY(-10px);
    border-color: var(--primary);
    box-shadow: var(--shadow-hover);
    color: var(--primary);
}

.location-card:hover i {
    transform: scale(1.2);
}

/* FEATURES */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.feature-item {
    background: var(--white);
    padding: 40px 30px;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.feature-icon {
    font-size: 2.5rem;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.feature-text h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--bg-dark);
    margin-bottom: 10px;
}

.feature-text p {
    color: var(--text-muted);
    line-height: 1.6;
}

/* MAP */
.map-container {
    width: 100%;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    border: 8px solid var(--white);
    margin-top: 40px;
}

/* FOOTER */
footer {
    background: var(--bg-dark);
    color: var(--text-muted);
    text-align: center;
    padding: 60px 20px;
    margin-top: 100px;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .hero-content h2 { font-size: 3.5rem; }
    .section-title { font-size: 2.5rem; }
    .search-container { flex-direction: column; border-radius: 20px; }
    .search-container input, .search-container select, .search-container button { border-radius: 12px; }
}

@media (max-width: 768px) {
    nav { padding: 15px 20px; flex-direction: column; gap: 15px; }
    .nav-links { flex-wrap: wrap; justify-content: center; gap: 15px; }
    .hero-content h2 { font-size: 2.5rem; }
    .hero-content p { font-size: 1.2rem; }
    .about-description { margin-top: 20px; padding: 30px 20px; box-shadow: none; }
}

</style>
</head>

<body>

<header>
<h1>Real Estate Management System</h1>
<p>Find Your Dream Property</p>
</header>

<nav>
<a href="#" class="nav-brand">
    <img src="icon.jpg" onerror="this.src='https://via.placeholder.com/45'" alt="Logo">
    Dream Homes
</a>
<div class="nav-links">
    <a href="#">Home</a>
    <a href="#about">About</a>
    <a href="#properties">Properties</a>
    <a href="#location">Location</a>
    <a href="#contact">Contact</a>
</div>
</nav>

<!-- welcome line -->
 <div class="welcomel">
    <h2>
    “Simplifying Real Estate Management Across Ballari’s Five Taluks. Connecting the buyer and seller of properties.”
    </h2>
 </div>

<!-- HOME -->
<section class="section-image">
    <div class="hero-content">
        <h2>Find Your Perfect Property</h2>
        <p>Discover luxury villas, affordable homes, and premium plots across Ballari with trusted agents.</p>
        
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search by property title...">
            <select id="locationSelect">
                <option value="">All Locations</option>
                <option value="Ballari">Ballari</option>
                <option value="Kurugodu">Kurugodu</option>
                <option value="Kampli">Kampli</option>
                <option value="Sandur">Sandur</option>
                <option value="Siruguppa">Siruguppa</option>
            </select>
            <button onclick="searchProperty()">Search</button>
        </div>
    </div>
</section>

<!-- ABOUT -->

<section id="about" class="section">
<h2>About Us</h2>
<div class="slideshow-container">
<img class="slide" src="main.jpg">
<img class="slide" src="main2.jpg">
<img class="slide" src="body.jpj.jpg">
</div>

<div class="about-description">
<p>Welcome to Real Estate Management, your most trusted partner in finding the perfect property. We are dedicated to simplifying real estate management across Ballari’s five taluks: Ballari, Kurugodu, Kampli, Sandur, and Siruguppa. Whether you are looking to buy a luxury villa, rent a comfortable home, or invest in a lucrative plot, our platform connects buyers and sellers seamlessly. With a strong commitment to transparency, security, and exceptional service, we strive to help you locate your dream property effortlessly while efficiently tracking your real estate business growth.</p>
</div>

</section>

<!-- PROPERTIES -->

<section id="properties" class="section">

<h2 class="section-title">Available Properties</h2>

<div class="properties">
<?php
try {
    $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
    $properties = $stmt->fetchAll();

    if (count($properties) > 0) {
        foreach ($properties as $prop) {
            $images = json_decode($prop['images'], true);
            $main_image = (!empty($images) && isset($images[0])) ? $images[0] : 'https://via.placeholder.com/300x200';
            
            // Generate link based on location or default
            $loc = strtolower($prop['city']);
            $link = "#";
            if (strpos($loc, 'ballari') !== false) {
                $link = "ballarip/ballariform.php";
            } else if (strpos($loc, 'siruguppa') !== false) {
                $link = "siruguppa/formsirguguppa.php";
            } else if (strpos($loc, 'sandur') !== false) {
                $link = "sandur/sandurform.php";
            } else if (strpos($loc, 'kampli') !== false) {
                $link = "kampli/kampliform.php";
            } else if (strpos($loc, 'kurugodu') !== false) {
                $link = "kurugodu/kurugoduform.php";
            }

            if ($link !== "#") {
                $full_location = !empty($prop['address']) ? $prop['address'] . ', ' . $prop['city'] : $prop['city'];
                $link .= "?property_title=" . urlencode($prop['title']) . "&property_image=" . urlencode($main_image) . "&property_location=" . urlencode($full_location);
            }

            echo '<div class="card animate-up">';
            echo '<div class="card-img-wrapper">';
            echo '<img src="' . htmlspecialchars($main_image) . '" alt="' . htmlspecialchars($prop['title']) . '">';
            echo '<div class="price-tag">₹' . number_format($prop['price']) . '</div>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h3>' . htmlspecialchars($prop['title']) . '</h3>';
            $display_location = !empty($prop['address']) ? htmlspecialchars($prop['address']) . ', ' . htmlspecialchars($prop['city']) : htmlspecialchars($prop['city']);
            echo '<p class="location"><i class="fa-solid fa-location-dot"></i> ' . $display_location . '</p>';
            echo '<button onclick="window.location.href=\'' . htmlspecialchars($link) . '\'">Book Now</button>';
            echo '</div>';
            echo '</div>';
        }
    }
} catch (PDOException $e) {
    echo "<p>Error loading properties.</p>";
}
?>

<?php if (empty($properties)): ?>
<div class="card animate-up">
    <div class="card-img-wrapper">
        <img src="luxury.jpg" onerror="this.src='https://via.placeholder.com/300x200'">
        <div class="price-tag">₹1,50,00,000</div>
    </div>
    <div class="card-body">
        <h3>Luxury Villa</h3>
        <p class="location"><i class="fa-solid fa-location-dot"></i> Ballari</p>
        <button onclick="window.location.href='ballarip/ballariform.php?property_title=Luxury+Villa&property_image=luxury.jpg&property_location=Ballari'">Book Now</button>
    </div>
</div>

<div class="card animate-up">
    <div class="card-img-wrapper">
        <img src="https://via.placeholder.com/300x200">
        <div class="price-tag">₹10,00,000</div>
    </div>
    <div class="card-body">
        <h3>Premium Plot</h3>
        <p class="location"><i class="fa-solid fa-location-dot"></i> Ballari</p>
        <button onclick="bookProperty(' Plot')">Book Now</button>
    </div>
</div>
<?php endif; ?>

</div>

</section>


<!-- LOCATIONS -->
<section id="location" class="section">
    <h2 class="section-title">Explore by Taluk</h2>
    <div class="locations-grid">
        <a href="ballarip/ballari.php" class="location-card animate-up">
            <i class="fa-solid fa-city"></i>
            Ballari
        </a>
        <a href="kurugodu/kurugodu.php" class="location-card animate-up">
            <i class="fa-solid fa-map-location-dot"></i>
            Kurugodu
        </a>
        <a href="kampli/kampli.php" class="location-card animate-up">
            <i class="fa-solid fa-building"></i>
            Kampli
        </a>
        <a href="sandur/sandur.php" class="location-card animate-up">
            <i class="fa-solid fa-tree-city"></i>
            Sandur
        </a>
        <a href="siruguppa/Siruguppa.php" class="location-card animate-up">
            <i class="fa-solid fa-house-chimney"></i>
            Siruguppa
        </a>
    </div>
</section>

<!-- FEATURES -->
<div class="section">
    <h2 class="section-title">Why Choose Us?</h2>
    <div class="features-grid">
        <div class="feature-item animate-up">
            <div class="feature-icon"><i class="fa-solid fa-building-circle-check"></i></div>
            <div class="feature-text">
                <h4>Property Management Made Easy</h4>
                <p>Track rent, expenses, and manage multiple properties seamlessly in one centralized dashboard.</p>
            </div>
        </div>
        <div class="feature-item animate-up">
            <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <div class="feature-text">
                <h4>Secure Data & Documents</h4>
                <p>Digital lease agreements and document storage kept highly secure and accessible 24/7.</p>
            </div>
        </div>
        <div class="feature-item animate-up">
            <div class="feature-icon"><i class="fa-solid fa-chart-line"></i></div>
            <div class="feature-text">
                <h4>Grow Your Business</h4>
                <p>Monitor property performance with detailed reports and foster easy tenant communication.</p>
            </div>
        </div>
    </div>
</div>

<!-- MAP -->
<div class="section" style="padding-top: 0;">
    <div class="map-container animate-up">
        <iframe 
        src="https://maps.google.com/maps?q=Ballari%20Karnataka&t=&z=13&ie=UTF8&iwloc=&output=embed"
        frameborder="0"
        scrolling="no"
        marginheight="0"
        marginwidth="0">
        </iframe>
    </div>
</div>


<!-- CONTACT -->
<section id="contact" class="section">
    <h2 class="section-title">Our Team & Contacts</h2>
    <div class="properties" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
        
        <div class="card animate-up">
            <img src="sharuk.jpg" onerror="this.src='https://via.placeholder.com/300x300'" alt="Sharuk" style="height: 250px; object-fit: cover;">
            <h3>Sharuk</h3>
            <p style="color: var(--primary); font-weight: bold; font-size: 1rem; margin-bottom: 5px;">Ballari Area Manager</p>
            <p style="margin-bottom: 5px;"><strong>Phone:</strong> +91 9876543210</p>
            <p style="margin-bottom: 15px;"><strong>Email:</strong> sharuk@dreamhomes.com</p>
            <button onclick="openContactForm('Sharuk')">Contact Sharuk</button>
        </div>

        <div class="card animate-up">
            <img src="salman.webp" onerror="this.src='https://via.placeholder.com/300x300'" alt="Salman" style="height: 250px; object-fit: cover;">
            <h3>Salman</h3>
            <p style="color: var(--primary); font-weight: bold; font-size: 1rem; margin-bottom: 5px;">Sandur Area Manager</p>
            <p style="margin-bottom: 5px;"><strong>Phone:</strong> +91 9876543211</p>
            <p style="margin-bottom: 15px;"><strong>Email:</strong> salman@dreamhomes.com</p>
            <button onclick="openContactForm('Salman')">Contact Salman</button>
        </div>

        <div class="card animate-up">
            <img src="images/vinutha.jpg" onerror="this.src='https://via.placeholder.com/300x300'" alt="Vinutha" style="height: 250px; object-fit: cover;">
            <h3>Vinutha</h3>
            <p style="color: var(--primary); font-weight: bold; font-size: 1rem; margin-bottom: 5px;">Siruguppa Area Manager</p>
            <p style="margin-bottom: 5px;"><strong>Phone:</strong> +91 9876543212</p>
            <p style="margin-bottom: 15px;"><strong>Email:</strong> vinutha@dreamhomes.com</p>
            <button onclick="openContactForm('Vinutha')">Contact Vinutha</button>
        </div>

        <div class="card animate-up">
            <img src="images/poonam.jpg" onerror="this.src='https://via.placeholder.com/300x300'" alt="Poonam" style="height: 250px; object-fit: cover;">
            <h3>Poonam</h3>
            <p style="color: var(--primary); font-weight: bold; font-size: 1rem; margin-bottom: 5px;">Kampli Area Manager</p>
            <p style="margin-bottom: 5px;"><strong>Phone:</strong> +91 9876543213</p>
            <p style="margin-bottom: 15px;"><strong>Email:</strong> poonam@dreamhomes.com</p>
            <button onclick="openContactForm('Poonam')">Contact Poonam</button>
        </div>

        <div class="card animate-up">
            <img src="https://via.placeholder.com/300x300" onerror="this.src='https://via.placeholder.com/300x300'" alt="Manjunatha" style="height: 250px; object-fit: cover;">
            <h3>Manjunatha</h3>
            <p style="color: var(--primary); font-weight: bold; font-size: 1rem; margin-bottom: 5px;">Kurugodu Area Manager</p>
            <p style="margin-bottom: 5px;"><strong>Phone:</strong> +91 9876543214</p>
            <p style="margin-bottom: 15px;"><strong>Email:</strong> manjunatha@dreamhomes.com</p>
            <button onclick="openContactForm('Manjunatha')">Contact Manjunatha</button>
        </div>
        
    </div>

    <!-- MAIN CONTACT FORM -->
    <div id="mainContactForm" style="display: none; max-width: 600px; margin: 50px auto 0; background: var(--white); padding: 40px; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); border: 1px solid rgba(0,0,0,0.05); transition: transform 0.3s ease;">
        <h3 style="text-align: center; color: var(--bg-dark); margin-bottom: 25px; font-size: 1.8rem;">Send Us a Message</h3>
        <form onsubmit="handleContactSubmit(event)" action="#" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <input type="text" name="name" id="contactName" placeholder="Full Name" required style="flex: 1; min-width: 200px; padding: 15px; border: 2px solid #e2e8f0; border-radius: var(--radius-sm); font-size: 1rem; outline: none; transition: var(--transition);">
                <input type="email" name="email" id="contactEmail" placeholder="Email Address" required style="flex: 1; min-width: 200px; padding: 15px; border: 2px solid #e2e8f0; border-radius: var(--radius-sm); font-size: 1rem; outline: none; transition: var(--transition);">
            </div>
            <input type="text" name="subject" id="contactSubject" placeholder="Subject" required style="padding: 15px; border: 2px solid #e2e8f0; border-radius: var(--radius-sm); font-size: 1rem; outline: none; transition: var(--transition);">
            <textarea name="message" placeholder="Your Message..." rows="6" required style="padding: 15px; border: 2px solid #e2e8f0; border-radius: var(--radius-sm); font-size: 1rem; outline: none; resize: vertical; transition: var(--transition);"></textarea>
            <button type="submit" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: var(--white); padding: 15px; border: none; border-radius: var(--radius-sm); font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: var(--transition); box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);">Submit Message</button>
        </form>
    </div>
</section>


<footer>

<p>“© 2026 Real Estate Management | Helping you find the right property in Ballari Five Taluk.”
</p>

</footer>

<script>

/* CONTACT FORM HANDLER */
function openContactForm(managerName) {
    const formContainer = document.getElementById("mainContactForm");
    const subjectInput = document.getElementById("contactSubject");
    
    // Show the form
    formContainer.style.display = 'block';
    
    // Pre-fill the subject line
    subjectInput.value = "Inquiry for " + managerName;
    
    // Scroll smoothly to the form
    formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    // Add a slight emphasis effect to draw attention
    formContainer.style.transform = "scale(1.02)";
    formContainer.style.boxShadow = "0 10px 25px rgba(67, 97, 238, 0.4)";
    
    setTimeout(() => {
        formContainer.style.transform = "scale(1)";
        formContainer.style.boxShadow = "var(--shadow-lg)";
        // Focus the first input field
        document.getElementById("contactName").focus();
    }, 400);
}

function handleContactSubmit(event) {
    event.preventDefault(); // Prevent page reload
    
    const formData = new FormData(event.target);
    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerText;
    submitBtn.innerText = "Sending...";
    submitBtn.disabled = true;

    fetch('submit_contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Thank you! Your message has been sent successfully.");
            event.target.reset(); // Clear the form
            document.getElementById("mainContactForm").style.display = 'none'; // Hide the form again
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        alert("An error occurred while sending your message. Please try again.");
        console.error('Error:', error);
    })
    .finally(() => {
        submitBtn.innerText = originalBtnText;
        submitBtn.disabled = false;
    });
}

/* SEARCH */

function searchProperty(){

let text=document.getElementById("searchInput").value.toLowerCase()

let location=document.getElementById("locationSelect").value.toLowerCase()

let cards=document.querySelectorAll(".card")

cards.forEach(function(card){

let title=card.querySelector("h3").innerText.toLowerCase()

let place=card.querySelector("p").innerText.toLowerCase()

if((title.includes(text)||text=="")&&(place.includes(location)||location=="")){

card.style.display="block"

}
else{

card.style.display="none"

}

})

}

/* SLIDER */

let slideIndex=0

showSlides()

function showSlides(){

let slides=document.getElementsByClassName("slide")

for(let i=0;i<slides.length;i++){

slides[i].style.display="none"

}

slideIndex++

if(slideIndex>slides.length){

slideIndex=1

}

slides[slideIndex-1].style.display="block"

setTimeout(showSlides,2000)

}

</script>

</body>
</html>