<?php
require_once 'auth_check.php';
require_once 'db_connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll();
} catch (PDOException $e) {
    $messages = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Inquiries - EstateAdmin</title>
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

        .message-content {
            font-size: 0.9rem;
            color: var(--text-muted);
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
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
            <li class="nav-item">
                <a href="admin_referrals.php">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Referrals</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="admin_contacts.php">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Contact Inquiries</span>
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
            <h1>Contact Inquiries</h1>
            <div style="color: var(--text-muted);"><?php echo count($messages); ?> Total Inquiries</div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Contact</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($messages)): ?>
                        <tr><td colspan="4" style="text-align:center; padding: 3rem; color: var(--text-muted);">No contact inquiries found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td>
                                <div class="customer-info">
                                    <span class="customer-name"><?php echo htmlspecialchars($msg['name']); ?></span>
                                    <span class="customer-email"><?php echo htmlspecialchars($msg['email']); ?></span>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500; color: var(--text-main);"><?php echo htmlspecialchars($msg['subject']); ?></div>
                            </td>
                            <td>
                                <div class="message-content" title="<?php echo htmlspecialchars($msg['message']); ?>">
                                    <?php echo htmlspecialchars($msg['message']); ?>
                                </div>
                            </td>
                            <td><span style="font-size:0.85rem;"><?php echo date('M d, Y g:i A', strtotime($msg['created_at'])); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
