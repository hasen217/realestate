<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

$message = '';
if (isset($_GET['delete_id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
        $stmt->execute([$_GET['delete_id']]);
        $message = "Property deleted successfully!";
    } catch (PDOException $e) {
        $message = "Error deleting property: " . $e->getMessage();
    }
}

try {
    $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
    $properties = $stmt->fetchAll();
} catch (PDOException $e) {
    $properties = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Properties - EstateAdmin</title>
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
            --danger: #ef4444;
            --success: #10b981;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg-dark); color: var(--text-main); display: flex; min-height: 100vh; }

        /* Sidebar Copy from Dashboard */
        .sidebar { width: 280px; background: var(--sidebar-bg); border-right: 1px solid var(--surface-border); display: flex; flex-direction: column; padding: 2rem 1.5rem; position: fixed; height: 100vh; }
        .logo { display: flex; align-items: center; gap: 0.75rem; font-size: 1.5rem; font-weight: 700; margin-bottom: 3rem; color: var(--text-main); text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-links { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; }
        .nav-item a { display: flex; align-items: center; gap: 1rem; padding: 1rem; color: var(--text-muted); text-decoration: none; border-radius: 12px; transition: var(--transition); font-weight: 500; }
        .nav-item.active a, .nav-item a:hover { background: var(--surface); color: var(--text-main); }
        .nav-item.active a { border-left: 4px solid var(--primary); background: rgba(99, 102, 241, 0.1); }
        .logout-btn { margin-top: auto; color: var(--danger); padding: 1rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; font-weight: 600; }

        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; }
        
        .table-container {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 1.25rem 1.5rem; background: rgba(255,255,255,0.02); color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
        td { padding: 1.25rem 1.5rem; border-top: 1px solid var(--surface-border); vertical-align: middle; }
        tr:hover { background: rgba(255,255,255,0.02); }

        .prop-info { display: flex; align-items: center; gap: 1rem; }
        .prop-img { width: 50px; height: 50px; border-radius: 10px; object-fit: cover; }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-sale { background: rgba(99, 102, 241, 0.1); color: var(--primary); }
        .status-rent { background: rgba(236, 72, 153, 0.1); color: #ec4899; }

        .actions { display: flex; gap: 0.75rem; }
        .btn-action {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }
        .btn-edit { background: rgba(99, 102, 241, 0.1); color: var(--primary); }
        .btn-edit:hover { background: var(--primary); color: white; }
        .btn-delete { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: white; }

        .message {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        @media (max-width: 1024px) {
            .sidebar { width: 80px; padding: 2rem 0.75rem; }
            .sidebar span { display: none; }
            .main-content { margin-left: 80px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="admin_dashboard.php" class="logo">
            <i class="fa-solid fa-house-chimney-window"></i>
            <span> Real Estate<span>Admin</span></span>
        </a>
        <ul class="nav-links">
            <li class="nav-item">
                <a href="admin_dashboard.php">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="addproperti.php">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Add Property</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="admin_properties.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Manage Properties</span>
                </a>
            </li>
        </ul>
        <a href="admin_logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Manage Properties</h1>
            <a href="addproperti.php" style="background: var(--primary); color: white; padding: 0.75rem 1.5rem; border-radius: 12px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-plus"></i> Add New
            </a>
        </div>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($properties)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 3rem; color: var(--text-muted);">No properties found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($properties as $prop): 
                            $images = json_decode($prop['images'], true);
                            $img = (!empty($images)) ? $images[0] : 'https://via.placeholder.com/100';
                        ?>
                        <tr>
                            <td>
                                <div class="prop-info">
                                    <img src="<?php echo htmlspecialchars($img); ?>" class="prop-img">
                                    <div style="font-weight:600;"><?php echo htmlspecialchars($prop['title']); ?></div>
                                </div>
                            </td>
                            <td style="text-transform: capitalize;"><?php echo $prop['type']; ?></td>
                            <td><span class="status-badge status-<?php echo $prop['status']; ?>"><?php echo $prop['status']; ?></span></td>
                            <td style="font-weight: 600;">₹<?php echo number_format($prop['price']); ?></td>
                            <td>
                                <?php if (!empty($prop['address'])): ?>
                                    <div style="font-size:0.8rem; color: var(--text-muted); margin-bottom:2px;"><?php echo htmlspecialchars($prop['address']); ?></div>
                                <?php endif; ?>
                                <div style="font-weight:600;"><?php echo htmlspecialchars($prop['city']); ?></div>
                            </td>
                            <td class="actions">
                                <a href="edit_property.php?id=<?php echo $prop['id']; ?>" class="btn-action btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="?delete_id=<?php echo $prop['id']; ?>" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this property?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
