<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'auth_check.php';
require_once 'db_connect.php';

// Fetch some basic stats
try {
    $prop_count = $pdo->query("SELECT COUNT(*) FROM properties")->fetchColumn();
    $referral_count = $pdo->query("SELECT COUNT(*) FROM referrals")->fetchColumn();
    $contact_count = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
} catch (PDOException $e) {
    $prop_count = 0;
    $referral_count = 0;
    $contact_count = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Real Estate Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --secondary: #ec4899;
            --bg-dark: #0f172a;
            --sidebar-bg: #1e293b;
            --surface: rgba(255, 255, 255, 0.05);
            --surface-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--surface-border);
            display: flex;
            flex-direction: column;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: var(--transition);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--text-main);
        }

        .logo span {
            color: var(--primary);
        }

        .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 12px;
            transition: var(--transition);
            font-weight: 500;
        }

        .nav-item.active a, .nav-item a:hover {
            background: var(--surface);
            color: var(--text-main);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .nav-item.active a {
            border-left: 4px solid var(--primary);
            background: rgba(99, 102, 241, 0.1);
        }

        .nav-item a i {
            font-size: 1.25rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2.5rem;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.05), transparent);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .welcome h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome p {
            color: var(--text-muted);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            padding: 2rem;
            border-radius: 24px;
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(99, 102, 241, 0.15);
            color: var(--primary);
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
        }

        .stat-info h3 {
            font-size: 0.875rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.25rem;
        }

        .stat-info .value {
            font-size: 2.25rem;
            font-weight: 700;
        }

        /* Action Grid */
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.01));
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            padding: 2rem;
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .action-card:hover {
            background: var(--surface);
            border-color: var(--primary-light);
            transform: scale(1.02);
        }

        .action-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .action-card h2 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .action-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .logout-btn {
            margin-top: auto;
            color: #ef4444;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            border-radius: 12px;
            transition: var(--transition);
            font-weight: 600;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 2rem 0.75rem;
            }
            .sidebar .logo span, .sidebar .nav-item a span, .sidebar .logout-btn span {
                display: none;
            }
            .main-content {
                margin-left: 80px;
            }
            .logo {
                justify-content: center;
            }
            .nav-item a {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.5rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-house-chimney-window"></i>
            <span> Real Estate<span>Admin</span></span>
        </div>
        
        <ul class="nav-links">
            <li class="nav-item active">
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
            <li class="nav-item">
                <a href="admin_contacts.php">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Contact Inquiries</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="myproject.php" target="_blank">
                    <i class="fa-solid fa-globe"></i>
                    <span>Public Site</span>
                </a>
            </li>
        </ul>

        <a href="admin_logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="welcome">
                <h1>Dashboard Overview</h1>
                <p>Welcome back, Admin! Here's what's happening today.</p>
            </div>
            <div class="user-profile" style="display: flex; align-items: center; gap: 1rem;">
                <span style="color: var(--text-muted);">Admin Account</span>
                <div style="width: 45px; height: 45px; border-radius: 50%; background: var(--primary); display: flex; justify-content: center; align-items: center; font-weight: 700;">A</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-city"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Properties</h3>
                    <div class="value"><?php echo $prop_count; ?></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(236, 72, 153, 0.15); color: var(--secondary);">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Leads</h3>
                    <div class="value"><?php echo $referral_count; ?></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
                    <i class="fa-solid fa-comment-dots"></i>
                </div>
                <div class="stat-info">
                    <h3>Contact Inquiries</h3>
                    <div class="value"><?php echo $contact_count; ?></div>
                </div>
            </div>
        </div>

        <h2 class="section-title">Quick Actions</h2>
        <div class="action-grid">
            <a href="addproperti.php" class="action-card">
                <i class="fa-solid fa-plus-circle"></i>
                <h2>Add New Property</h2>
                <p>List a new residential or commercial property across any of the 5 taluks.</p>
            </a>
            <a href="admin_properties.php" class="action-card">
                <i class="fa-solid fa-list-check"></i>
                <h2>Manage Properties</h2>
                <p>Edit or delete existing property listings and update their availability status.</p>
            </a>
            <a href="admin_referrals.php" class="action-card">
                <i class="fa-solid fa-envelope-open-text"></i>
                <h2>View Referrals</h2>
                <p>Check messages and booking requests from potential buyers and sellers.</p>
            </a>
            <a href="admin_contacts.php" class="action-card">
                <i class="fa-solid fa-comment-dots"></i>
                <h2>View Contacts</h2>
                <p>Check general inquiries and messages submitted via the contact form.</p>
            </a>
        </div>

        <h2 class="section-title" style="margin-top: 3rem;">Property Locations</h2>
        <div class="action-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            <a href="ballarip/add_cowlbazaar.php" class="action-card" style="padding: 1.5rem; text-align: center;">
                <h3>Ballari</h3>
                <p>Manage areas in Ballari Hub</p>
            </a>
            <a href="sandur/add_ballariroad.php" class="action-card" style="padding: 1.5rem; text-align: center;">
                <h3>Sandur</h3>
                <p>Manage areas in Sandur Hub</p>
            </a>
            <a href="kampli/add_ballariroad.php" class="action-card" style="padding: 1.5rem; text-align: center;">
                <h3>Kampli</h3>
                <p>Manage areas in Kampli Hub</p>
            </a>
            <a href="siruguppa/add_adoniroad.php" class="action-card" style="padding: 1.5rem; text-align: center;">
                <h3>Siruguppa</h3>
                <p>Manage areas in Siruguppa Hub</p>
            </a>
            <a href="kurugodu/add_badanahatti.php" class="action-card" style="padding: 1.5rem; text-align: center;">
                <h3>Kurugodu</h3>
                <p>Manage areas in Kurugodu Hub</p>
            </a>
        </div>
    </div>

</body>
</html>
