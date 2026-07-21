<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

$message = '';
$property = null;

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $property = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'] ?? '';
    $type = $_POST['type'] ?? '';
    $status = $_POST['status'] ?? '';
    $price = $_POST['price'] ?? 0;
    $area = $_POST['area'] ?? 0;
    $description = $_POST['description'] ?? '';
    $city = $_POST['city'] ?? '';
    $address = $_POST['address'] ?? '';

    try {
        $sql = "UPDATE properties SET title = :title, type = :type, status = :status, price = :price, area = :area, description = :description, city = :city, address = :address WHERE id = :id";
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
            ':id' => $id
        ]);
        $message = "Property updated successfully!";
        // Refresh property data
        $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
        $stmt->execute([$id]);
        $property = $stmt->fetch();
    } catch (PDOException $e) {
        $message = "Error updating property: " . $e->getMessage();
    }
}

if (!$property) {
    header("Location: admin_properties.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property - EstateAdmin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --bg-dark: #0f172a;
            --sidebar-bg: #1e293b;
            --surface: rgba(255, 255, 255, 0.05);
            --surface-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg-dark); color: var(--text-main); display: flex; min-height: 100vh; }

        .sidebar { width: 280px; background: var(--sidebar-bg); border-right: 1px solid var(--surface-border); display: flex; flex-direction: column; padding: 2rem 1.5rem; position: fixed; height: 100vh; }
        .logo { display: flex; align-items: center; gap: 0.75rem; font-size: 1.5rem; font-weight: 700; margin-bottom: 3rem; color: var(--text-main); text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-links { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; }
        .nav-item a { display: flex; align-items: center; gap: 1rem; padding: 1rem; color: var(--text-muted); text-decoration: none; border-radius: 12px; transition: 0.3s; font-weight: 500; }
        .nav-item.active a, .nav-item a:hover { background: var(--surface); color: var(--text-main); }

        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem; }
        .form-container { max-width: 800px; background: var(--surface); border: 1px solid var(--surface-border); border-radius: 24px; padding: 2.5rem; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.5rem; color: var(--text-muted); font-size: 0.9rem; }
        .form-control { width: 100%; padding: 0.85rem 1rem; background: rgba(255,255,255,0.03); border: 1px solid var(--surface-border); border-radius: 12px; color: white; outline: none; }
        .form-control:focus { border-color: var(--primary); }
        
        .btn-submit { background: var(--primary); color: white; border: none; padding: 1rem 2rem; border-radius: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(99,102,241,0.3); }

        .message { padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="admin_dashboard.php" class="logo">
            <i class="fa-solid fa-house-chimney-window"></i>
            <span>Estate<span>Admin</span></span>
        </a>
        <ul class="nav-links">
            <li class="nav-item">
                <a href="admin_dashboard.php">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin_properties.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Manage Properties</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header" style="margin-bottom: 2rem;">
            <h1>Edit Property</h1>
            <a href="admin_properties.php" style="color: var(--text-muted); text-decoration: none;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
        </div>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $property['id']; ?>">
                
                <div class="form-group">
                    <label>Property Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($property['title']); ?>" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="house" <?php echo $property['type'] == 'house' ? 'selected' : ''; ?>>House</option>
                            <option value="apartment" <?php echo $property['type'] == 'apartment' ? 'selected' : ''; ?>>Apartment</option>
                            <option value="plot" <?php echo $property['type'] == 'plot' ? 'selected' : ''; ?>>Plot</option>
                            <option value="commercial" <?php echo $property['type'] == 'commercial' ? 'selected' : ''; ?>>Commercial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="sale" <?php echo $property['status'] == 'sale' ? 'selected' : ''; ?>>For Sale</option>
                            <option value="rent" <?php echo $property['status'] == 'rent' ? 'selected' : ''; ?>>For Rent</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Price (₹)</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $property['price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Area (Sq. Ft.)</label>
                        <input type="number" name="area" class="form-control" value="<?php echo $property['area']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>City / Region</label>
                    <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($property['city']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($property['description']); ?></textarea>
                </div>

                <button type="submit" class="btn-submit">Update Property</button>
            </form>
        </div>
    </div>

</body>
</html>
