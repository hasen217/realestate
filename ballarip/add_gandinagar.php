<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../auth_check.php";
require_once "../db_connect.php";

$message = "";
$area_name = "Gandhi Nagar";
$city = "Ballari";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"] ?? "";
    $type = $_POST["type"] ?? "";
    $status = $_POST["status"] ?? "sale";
    $price = $_POST["price"] ?? 0;
    $area_size = $_POST["area"] ?? 0;
    $description = $_POST["description"] ?? "";
    $address = $area_name . ", " . ($_POST["address_details"] ?? "");

    $uploaded_images = [];
    if (!empty($_FILES["images"]["name"][0])) {
        $upload_dir = "../uploads/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        foreach ($_FILES["images"]["name"] as $key => $image_name) {
            $tmp_name = $_FILES["images"]["tmp_name"][$key];
            $sanitized_name = time() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", basename($image_name));
            $target_file = $upload_dir . $sanitized_name;
            if (move_uploaded_file($tmp_name, $target_file)) $uploaded_images[] = "uploads/" . $sanitized_name;
        }
    }
    $images_json = json_encode($uploaded_images);

    try {
        $sql = "INSERT INTO properties (title, type, status, price, area, description, city, address, images, bedrooms, bathrooms, amenities) 
                VALUES (:title, :type, :status, :price, :area, :description, :city, :address, :images, NULL, NULL, NULL)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":title"=>$title, ":type"=>$type, ":status"=>$status, ":price"=>$price, ":area"=>$area_size, ":description"=>$description, ":city"=>$city, ":address"=>$address, ":images"=>$images_json]);
        $message = "Property successfully added to $area_name!";
    } catch (PDOException $e) { $message = "Error: " . $e->getMessage(); }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property - <?php echo $area_name; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #4361ee; --secondary: #7209b7; --bg-color: #f1f5f9; --surface: #ffffff; --text: #1e293b; --text-muted: #64748b; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: var(--bg-color); color: var(--text); font-family: "Outfit", sans-serif; padding: 1rem; min-height: 100vh; }
        .container { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 400px; gap: 1.5rem; padding-top: 1rem; }
        .form-card, .preview-card { background: var(--surface); padding: 2rem; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        h1 { margin-bottom: 1.5rem; color: var(--primary); font-size: clamp(1.5rem, 5vw, 2rem); }
        h2 { font-size: 1.25rem; margin-bottom: 1rem; color: var(--text); display: flex; align-items: center; gap: 0.5rem; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 500; color: var(--text); font-size: 0.9rem; }
        .form-control { width: 100%; padding: 0.85rem 1rem; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 1rem; outline: none; transition: all 0.3s; background: #fff; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(67,97,238,0.1); }
        .btn-submit { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; padding: 1.1rem; border-radius: 12px; font-weight: 600; cursor: pointer; width: 100%; margin-top: 1rem; transition: all 0.3s; font-size: 1rem; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(67,97,238,0.3); }
        .success-msg { background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border-left: 5px solid #10b981; animation: slideIn 0.5s ease-out; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .back-link { display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; text-decoration: none; color: var(--text-muted); font-weight: 500; font-size: 0.95rem; transition: color 0.3s; }
        .back-link:hover { color: var(--primary); }
        
        .card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; text-align: center; max-width: 350px; margin: 0 auto; }
        .card img { width: 100%; height: 200px; object-fit: cover; background: #f1f5f9; }
        .card h3 { padding: 15px 15px 5px; color: #0f172a; font-size: 1.3rem; }
        .card p { padding: 0 15px 5px; color: #64748b; font-size: 0.95rem; }
        .card .price { color: var(--primary); font-weight: 700; font-size: 1.2rem; padding-bottom: 15px; }
        .card button { margin: 0 15px 20px; width: calc(100% - 30px); padding: 12px; border: none; background: #0f172a; color: white; border-radius: 10px; font-weight: 600; font-size: 0.9rem; }

        @media (max-width: 1024px) { .container { grid-template-columns: 1fr; max-width: 700px; } .preview-card { position: static; margin-bottom: 2rem; order: -1; } }
        @media (max-width: 600px) { body { padding: 0.5rem; } .form-card, .preview-card { padding: 1.5rem; border-radius: 15px; } .form-grid-mobile { grid-template-columns: 1fr !important; } }
    </style>
</head>
<body>

<div class="container">
    <div class="form-side">
        <a href="gandinagar.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Listing</a>
        <div class="form-card">
            <h1>Add Property</h1>
            <p style="color:var(--text-muted); margin-bottom: 2rem; font-size: 0.95rem;">List your property in <strong><?php echo $area_name; ?>, <?php echo $city; ?></strong>.</p>
            <?php if ($message): ?>
                <?php if (strpos($message, "Error") !== false): ?>
                    <div style="background:rgba(239,68,68,0.1); color:#ef4444; padding:1rem; border-radius:12px; border:1px solid rgba(239,68,68,0.2); margin-bottom:1rem;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $message; ?>
                    </div>
                <?php else: ?>
                    <div class="success-msg"><i class="fas fa-check-circle"></i> <?php echo $message; ?></div>
                <?php endif; ?>
            <?php endif; ?>
            <form method="POST" action="add_gandinagar.php" enctype="multipart/form-data" id="addForm">
                <div class="form-group"><label>Property Title</label><input type="text" name="title" id="titleInput" class="form-control" placeholder="e.g. Modern Villa" required></div>
                <div class="form-grid-mobile" style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group"><label>Property Type</label><select name="type" class="form-control" required><option value="house">House</option><option value="plot">Plot</option><option value="apartment">Apartment</option><option value="commercial">Commercial</option></select></div>
                    <div class="form-group"><label>Listing Status</label><select name="status" id="statusInput" class="form-control" required><option value="sale">For Sale</option><option value="rent">For Rent</option></select></div>
                </div>
                <div class="form-grid-mobile" style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group"><label>Price (₹)</label><input type="number" name="price" id="priceInput" class="form-control" placeholder="Amount" required></div>
                    <div class="form-group"><label>Area (Sq. Ft.)</label><input type="number" name="area" class="form-control" placeholder="e.g. 1200" required></div>
                </div>
                <div class="form-group"><label>Landmark/Street Address</label><input type="text" name="address_details" id="addressInput" class="form-control" placeholder="e.g. Near Bus Stand"></div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="3" placeholder="Tell us more..."></textarea></div>
                <div class="form-group"><label>Images</label><input type="file" name="images[]" id="imageInput" multiple class="form-control" accept="image/*" style="padding: 0.5rem;"></div>
                <button type="submit" class="btn-submit">Publish Now</button>
            </form>
        </div>
    </div>
    <div class="preview-side">
        <div class="preview-card" style="position: sticky; top: 1rem;">
            <h2><i class="fas fa-eye"></i> Live Preview</h2>
            <div class="card">
                <img id="previewImg" src="https://via.placeholder.com/400x300?text=No+Image" alt="Preview">
                <h3 id="previewTitle">Modern Property</h3>
                <p id="previewLocation">Location: <?php echo $area_name; ?>, <?php echo $city; ?></p>
                <p class="price" id="previewPrice">Price: ₹ 0</p>
                <button>Book Now</button>
            </div>
        </div>
    </div>
</div>
<script>
    const titleInput = document.getElementById("titleInput");
    const priceInput = document.getElementById("priceInput");
    const statusInput = document.getElementById("statusInput");
    const addressInput = document.getElementById("addressInput");
    const imageInput = document.getElementById("imageInput");
    const previewTitle = document.getElementById("previewTitle");
    const previewPrice = document.getElementById("previewPrice");
    const previewLocation = document.getElementById("previewLocation");
    const previewImg = document.getElementById("previewImg");
    const areaName = "<?php echo $area_name; ?>";

    function updatePreview() {
        previewTitle.textContent = titleInput.value || "Modern Property";
        const price = (parseFloat(priceInput.value) || 0).toLocaleString("en-IN");
        const status = statusInput.value === "rent" ? " /mo" : "";
        previewPrice.textContent = "Price: ₹ " + price + status;
        previewLocation.textContent = "Location: " + areaName + (addressInput.value ? ", " + addressInput.value : "");
    }

    titleInput.addEventListener("input", updatePreview);
    priceInput.addEventListener("input", updatePreview);
    statusInput.addEventListener("change", updatePreview);
    addressInput.addEventListener("input", updatePreview);
    imageInput.addEventListener("change", function() { if (this.files && this.files[0]) { const reader = new FileReader(); reader.onload = (e) => previewImg.src = e.target.result; reader.readAsDataURL(this.files[0]); } });
</script>
</body>
</html>