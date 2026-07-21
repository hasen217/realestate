<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'auth_check.php';
require_once 'db_connect.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $type = $_POST['type'] ?? '';
    $status = $_POST['status'] ?? '';
    $price = !empty($_POST['price']) ? floatval($_POST['price']) : 0;
    $area = !empty($_POST['area']) ? intval($_POST['area']) : 0;
    $description = $_POST['description'] ?? '';
    $city = $_POST['city'] ?? '';
    $address = $_POST['address'] ?? '';

    // Handle image uploads
    $uploaded_images = [];
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        foreach ($_FILES['images']['name'] as $key => $image_name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            // Sanitize filename and add timestamp to avoid duplicates
            $sanitized_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($image_name));
            $target_file = $upload_dir . $sanitized_name;
            
            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploaded_images[] = $target_file;
            }
        }
    }
    $images_json = json_encode($uploaded_images);

    // Insert into database
    try {
        $sql = "INSERT INTO properties (title, type, status, price, area, description, city, address, images, bedrooms, bathrooms, amenities) 
                VALUES (:title, :type, :status, :price, :area, :description, :city, :address, :images, NULL, NULL, NULL)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':type' => $type,
            ':status' => $status,
            ':price' => $price,
            ':area' => $area,
            ':description' => $description,
            ':city' => $city,
            ':address' => $address,
            ':images' => $images_json
        ]);
        $message = ["success", "Property '$title' successfully added!"];
    } catch (PDOException $e) {
        $message = ["danger", "Database Error: " . $e->getMessage()];
    } catch (Exception $e) {
        $message = ["danger", "System Error: " . $e->getMessage()];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property - Real Estate Admin</title>
    <!-- Modern Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for premium icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-hover: #3a53d0;
            --primary-light: rgba(67, 97, 238, 0.1);
            --bg-color: #f8fafc;
            --surface: #ffffff;
            --surface-border: #e2e8f0;
            --text: #1e293b;
            --text-muted: #64748b;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 0% 0%, rgba(67, 97, 238, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(247, 37, 133, 0.05) 0%, transparent 50%);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem;
            background-attachment: fixed;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .header h1 span {
            color: var(--primary);
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-btn:hover {
            color: var(--primary);
        }

        .form-container {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--surface);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--surface-border);
            border-radius: 20px;
            padding: clamp(1.5rem, 5vw, 2.5rem);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-msg {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            border: 1px solid rgba(16, 185, 129, 0.2);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--surface-border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: color 0.3s ease;
        }

        .form-group:focus-within label {
            color: var(--primary);
        }

        .form-control {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            color: var(--text);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: var(--surface);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.25rem center;
            background-size: 1.2rem;
            padding-right: 3rem;
            cursor: pointer;
        }

        select.form-control option {
            background: var(--surface);
            color: var(--text);
            padding: 0.5rem;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Styling Number Inputs */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Checkboxes for amenities */
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .amenity-cb {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.875rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--surface-border);
            transition: all 0.2s ease;
        }

        .amenity-cb:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .amenity-cb input {
            accent-color: var(--primary);
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
        }

        .file-upload-wrapper {
            position: relative;
            grid-column: 1 / -1;
            border: 2px dashed var(--surface-border);
            border-radius: 16px;
            padding: 4rem 2rem;
            text-align: center;
            background: var(--surface);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-wrapper:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .file-upload-icon {
            font-size: 3rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }

        .file-upload-wrapper:hover .file-upload-icon {
            color: var(--primary);
        }

        .file-upload-text {
            color: var(--text);
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .file-upload-hint {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .file-upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        /* Image Preview Styling */
        #image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
            width: 100%;
        }

        .preview-item {
            position: relative;
            aspect-ratio: 1/1;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid var(--primary-light);
            box-shadow: var(--shadow-sm);
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .preview-item .remove-btn:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        /* Submit Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--surface-border);
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-cancel {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--surface-border);
        }

        .btn-cancel:hover {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.3);
        }

        .btn-submit {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Live Preview Card Styling */
        .preview-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (max-width: 992px) {
            .preview-section {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .card-preview-container {
                position: static;
                order: -1; /* Move preview above form on tablets/mobile */
                margin-bottom: 2rem;
            }
        }

        .card-preview-container {
            position: sticky;
            top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(67, 97, 238, 0.03);
            padding: 2rem;
            border-radius: 20px;
            border: 2px dashed var(--primary-light);
        }

        .card {
            background: var(--surface);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--surface-border);
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 350px;
            text-align: left;
            transition: all 0.3s ease;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card h3 {
            color: var(--text);
            font-size: 1.25rem;
            margin: 1.25rem 1.25rem 0.5rem;
        }

        .card p {
            color: var(--text-muted);
            margin: 0 1.25rem 0.5rem;
            font-size: 0.9rem;
        }

        .card p.price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.25rem;
        }

        .card button {
            margin: auto 1.25rem 1.25rem;
            width: calc(100% - 2.5rem);
            padding: 0.75rem;
            border: none;
            background: var(--text);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body { padding: 1rem; }
            .header { margin-bottom: 1.5rem; }
            .header h1 { font-size: 1.5rem; }
            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .form-container {
                padding: 1.25rem;
            }
            .file-upload-wrapper {
                padding: 2rem 1rem;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .dropdown-content {
                right: auto;
                left: 0;
                width: 100%;
                min-width: 250px;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Add <span>Property</span></h1>
        <div style="display:flex; gap:1rem;">
            <div class="dropdown" style="position:relative;">
                <button class="back-btn" style="cursor:pointer; border:none; background:none;">
                    <i class="fa-solid fa-location-dot"></i> Ballari Areas <i class="fa-solid fa-chevron-down" style="font-size:0.7rem;"></i>
                </button>
                <div class="dropdown-content" style="display:none; position:absolute; top:100%; right:0; background:white; min-width:180px; box-shadow:0 8px 16px rgba(0,0,0,0.2); z-index:1; border-radius:8px; overflow:hidden;">
                    <div style="background:#f1f5f9; padding:5px 15px; font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Ballari Hub</div>
                    <a href="ballarip/add_cowlbazaar.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Cowl Bazaar</a>
                    <a href="ballarip/add_cantonment.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Cantonment</a>
                    <a href="ballarip/add_gandinagar.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Gandhi Nagar</a>
                    <a href="ballarip/add_vidyanagar.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Vidya Nagar</a>
                    
                    <div style="background:#f1f5f9; padding:5px 15px; font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; border-top:1px solid #e2e8f0;">Sandur Hub</div>
                    <a href="sandur/add_ballariroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Ballari Road</a>
                    <a href="sandur/add_hospetroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Hospet Road</a>
                    <a href="sandur/add_kampliroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Kampli Road</a>
                    <a href="sandur/add_kudligiroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Kudligi Road</a>
                    <a href="sandur/add_torangalroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Toranagallu Road</a>

                    <div style="background:#f1f5f9; padding:5px 15px; font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; border-top:1px solid #e2e8f0;">Siruguppa Hub</div>
                    <a href="siruguppa/add_adoniroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Adoni Road</a>
                    <a href="siruguppa/add_ballariroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Ballari Road</a>
                    <a href="siruguppa/add_deshnurroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Deshnur Road</a>
                    <a href="siruguppa/add_moulan_azad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Moulana Azad School</a>
                    <a href="siruguppa/add_sindhanurroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Sindhanur Road</a>

                    <div style="background:#f1f5f9; padding:5px 15px; font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; border-top:1px solid #e2e8f0;">Kampli Hub</div>
                    <a href="kampli/add_ballariroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Ballari Road</a>
                    <a href="kampli/add_busstand.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Bus Stand Area</a>
                    <a href="kampli/add_gangavatiroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Gangavati Road</a>
                    <a href="kampli/add_hospetroad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Hospet Road</a>
                    <a href="kampli/add_sirugupparoad.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Siruguppa Road</a>

                    <div style="background:#f1f5f9; padding:5px 15px; font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase; border-top:1px solid #e2e8f0;">Kurugodu Hub</div>
                    <a href="kurugodu/add_badanahatti.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Badanahatti Road</a>
                    <a href="kurugodu/add_basapura.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Basapura Road</a>
                    <a href="kurugodu/add_genekehal.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Genekehal Road</a>
                    <a href="kurugodu/add_sindigeri.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Sindigeri Road</a>
                    <a href="kurugodu/add_ujjalpet.php" style="display:block; padding:10px 15px; text-decoration:none; color:var(--text); font-size:0.9rem;">Ujjalpet</a>
                </div>
            </div>
            <a href="admin_dashboard.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <script>
        document.querySelector('.dropdown .back-btn').onclick = function(e) {
            e.stopPropagation();
            const content = document.querySelector('.dropdown-content');
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        };
        window.onclick = function() {
            document.querySelector('.dropdown-content').style.display = 'none';
        };
    </script>

    <div class="form-container">
        <?php if (!empty($message)): ?>
            <div class="<?php echo $message[0] == 'success' ? 'success-msg' : 'error-msg'; ?>" style="margin-bottom: 2rem; padding: 1rem; border-radius: 12px; border: 1px solid; <?php echo $message[0] == 'success' ? 'background: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.2);' : 'background: rgba(239, 68, 68, 0.1); color: #ef4444; border-color: rgba(239, 68, 68, 0.2);'; ?>">
                <i class="fa-solid <?php echo $message[0] == 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
                <?php echo htmlspecialchars($message[1]); ?>
            </div>
        <?php endif; ?>

        <div class="preview-section">
            <form method="POST" action="addproperti.php" enctype="multipart/form-data">
            
            <!-- Basic Information Section -->
            <div class="section-title">
                <i class="fa-solid fa-house"></i> Basic Information
            </div>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="title">Property Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Modern Luxury Villa in Gandhinagar" required>
                </div>

                <div class="form-group">
                    <label for="type">Property Type</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="" disabled selected>Select property type</option>
                        <option value="house">House / Villa</option>
                        <option value="home">Home Sale</option>
                        <option value="house">House Rent</option>

                        <option value="apartment">Apartment</option>
                        <option value="commercial">Commercial Space</option>
                        <option value="land/plot">Land / Plot</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Listing Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price (₹)</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="e.g. 15000000" required>
                </div>

                <div class="form-group">
                    <label for="area">Property Size (Sq. Ft.)</label>
                    <input type="number" id="area" name="area" class="form-control" placeholder="e.g. 2500" required>
                </div>

                <div class="form-group full-width">
                    <label for="description">Detailed Description</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Highlight the best features of this property..."></textarea>
                </div>
            </div>

            <!-- Location & details -->
            <div class="section-title">
                <i class="fa-solid fa-map-location-dot"></i> Location & Features
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="city">City / Region</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="e.g. Ballari, Kampli" required>
                </div>

                <div class="form-group">
                    <label for="address">Full Street Address</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Street name, landmark...">
                </div>

            </div>

            <!-- Media Upload -->
            <div class="section-title">
                <i class="fa-solid fa-images"></i> Media Gallery
            </div>
            <div class="form-grid">
                <div class="file-upload-wrapper">
                    <div class="file-upload-icon">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <div class="file-upload-text">Drag & drop high-quality property images here</div>
                    <div class="file-upload-hint">Supports: JPG, PNG, WEBP (Max 5MB each)</div>
                    <input type="file" name="images[]" multiple class="file-upload-input" accept="image/*" id="propertyImages">
                </div>
                <div id="image-preview-container"></div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="reset" class="btn btn-cancel">Reset Form</button>
                <button type="submit" class="btn btn-submit">
                    <i class="fa-solid fa-check"></i> Publish Property
                </button>
            </div>

        </form>

        <div class="card-preview-container">
            <div class="section-title" style="border:none; margin-bottom: 1rem;">
                <i class="fa-solid fa-wand-magic-sparkles"></i> Live Preview
            </div>
            <div class="card" id="live-card">
                <img id="card-img" src="https://via.placeholder.com/400x300?text=Property+Image" alt="Property">
                <h3 id="card-title">Modern Luxury Villa</h3>
                <p id="card-location">Location: Gandhi Nagar, Ballari</p>
                <p class="price" id="card-price">Price: ₹ 0.00</p>
                <button>Book Now</button>
            </div>
            <p style="margin-top: 1rem; font-size: 0.85rem; color: var(--text-muted);">
                <i class="fa-solid fa-info-circle"></i> This is how it will appear on your website.
            </p>
            
        </div>
    </div>
</div>

    <script>
        const imageInput = document.getElementById('propertyImages');
        const previewContainer = document.getElementById('image-preview-container');

        imageInput.addEventListener('change', function() {
            previewContainer.innerHTML = '';
            
            if (this.files) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'preview-item';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-btn"><i class="fa-solid fa-xmark"></i></button>
                        `;
                        previewContainer.appendChild(div);
                        
                        // Update the card preview with the first image
                        if (previewContainer.children.length === 1) {
                            document.getElementById('card-img').src = e.target.result;
                        }
                    }
                    
                    reader.readAsDataURL(file);
                });
            }
        });

        // Live Text Update Logic
        const titleInput = document.getElementById('title');
        const priceInput = document.getElementById('price');
        const cityInput = document.getElementById('city');
        const addressInput = document.getElementById('address');

        function updateCard() {
            document.getElementById('card-title').innerText = titleInput.value || 'Property Title';
            
            const price = parseFloat(priceInput.value) || 0;
            document.getElementById('card-price').innerText = 'Price: ₹ ' + price.toLocaleString('en-IN');
            
            const location = (addressInput.value ? addressInput.value + ', ' : '') + (cityInput.value || 'City');
            document.getElementById('card-location').innerText = 'Location: ' + location;
        }

        titleInput.addEventListener('input', updateCard);
        priceInput.addEventListener('input', updateCard);
        cityInput.addEventListener('input', updateCard);
        addressInput.addEventListener('input', updateCard);
    </script>
</body>
</html>
