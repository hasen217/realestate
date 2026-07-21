<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM referrals ORDER BY created_at DESC");
    $referrals = $stmt->fetchAll();
} catch (PDOException $e) {
    $referrals = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Referrals - EstateAdmin</title>
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
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background-color: var(--bg-dark); color: var(--text-main); display: flex; min-height: 100vh; }

        .sidebar { width: 280px; background: var(--sidebar-bg); border-right: 1px solid var(--surface-border); display: flex; flex-direction: column; padding: 2rem 1.5rem; position: fixed; height: 100vh; }
        .logo { display: flex; align-items: center; gap: 0.75rem; font-size: 1.5rem; font-weight: 700; margin-bottom: 3rem; color: var(--text-main); text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-links { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; }
        .nav-item a { display: flex; align-items: center; gap: 1rem; padding: 1rem; color: var(--text-muted); text-decoration: none; border-radius: 12px; transition: var(--transition); font-weight: 500; }
        .nav-item.active a, .nav-item a:hover { background: var(--surface); color: var(--text-main); }
        .nav-item.active a { border-left: 4px solid var(--primary); background: rgba(99, 102, 241, 0.1); }
        .logout-btn { margin-top: auto; color: #ef4444; padding: 1rem; display: flex; align-items: center; gap: 1rem; text-decoration: none; font-weight: 600; }

        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; }
        
        .table-container {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            overflow-x: auto;
            backdrop-filter: blur(10px);
        }

        table { width: 100%; border-collapse: collapse; text-align: left; min-width: 1000px; }
        th { padding: 1.25rem 1.5rem; background: rgba(255,255,255,0.02); color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
        td { padding: 1.25rem 1.5rem; border-top: 1px solid var(--surface-border); vertical-align: middle; }
        tr:hover { background: rgba(255,255,255,0.02); }

        .customer-info { display: flex; flex-direction: column; }
        .customer-name { font-weight: 600; color: var(--text-main); }
        .customer-email { font-size: 0.85rem; color: var(--text-muted); }

        .badge {
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
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
            <li class="nav-item">
                <a href="admin_properties.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Manage Properties</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="admin_referrals.php">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Referrals</span>
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
            <h1>Customer Referrals</h1>
            <div style="color: var(--text-muted);"><?php echo count($referrals); ?> Total Leads</div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Property Interested</th>
                        <th>Location</th>
                        <th>Source</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($referrals)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 3rem; color: var(--text-muted);">No referrals found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($referrals as $ref): ?>
                        <tr>
                            <td>
                                <div class="customer-info">
                                    <span class="customer-name"><?php echo htmlspecialchars($ref['name']); ?></span>
                                    <span class="customer-email"><?php echo htmlspecialchars($ref['email']); ?></span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($ref['phone']); ?></td>
                            <td>
                                <div style="font-weight:500;"><?php echo htmlspecialchars($ref['property']); ?></div>
                                <span class="badge"><?php echo htmlspecialchars($ref['property_location']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($ref['location_source']); ?></td>
                            <td><span style="font-size:0.9rem; color: var(--text-muted);"><?php echo htmlspecialchars($ref['source'] ?? 'N/A'); ?></span></td>
                            <td><span style="font-size:0.85rem;"><?php echo date('M d, Y', strtotime($ref['created_at'])); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
