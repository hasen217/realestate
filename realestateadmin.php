<?php
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Dummy credentials for demonstration - Replace with real database check
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Real Estate Management</title>
    <!-- Modern Output Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1; /* Vibrant Indigo */
            --primary-hover: #4f46e5;
            --bg-color: #0f172a; /* Slate Dark Theme */
            --surface: rgba(255, 255, 255, 0.03);
            --surface-border: rgba(255, 255, 255, 0.08);
            --text: #ffffff;
            --text-muted: #94a3b8;
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
                radial-gradient(circle at 15% 50%, rgba(99, 102, 241, 0.08), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(236, 72, 153, 0.08), transparent 25%);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Animated Background Elements for dynamic feel */
        .decor-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 10s infinite ease-in-out alternate;
        }

        .dc-1 {
            width: 400px;
            height: 400px;
            background: rgba(99, 102, 241, 0.15);
            top: -100px;
            right: -100px;
        }

        .dc-2 {
            width: 300px;
            height: 300px;
            background: rgba(236, 72, 153, 0.1);
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-30px) scale(1.05); }
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            z-index: 10;
            perspective: 1000px; /* For 3D effects if needed */
        }

        /* Glassmorphism Panel */
        .glass-panel {
            background: var(--surface);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            border-radius: 16px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .logo-icon svg {
            width: 28px;
            height: 28px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .logo-text span {
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        /* Input Icons Setup */
        .input-icon-wrapper {
            position: relative;
        }
        
        .input-icon-wrapper svg {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            stroke: var(--text-muted);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke 0.3s ease;
            pointer-events: none; /* Let clicks pass through to input */
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem 1.25rem 1rem 3.25rem; /* Extra left padding for icon */
            color: var(--text);
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        /* Change SVG stroke when input is focused */
        .form-control:focus + svg {
            stroke: var(--primary);
        }

        /* Also change label color if desired, though CSS works better with focus-within on wrapper */
        .form-group:focus-within label {
            color: var(--primary);
        }

        .form-error {
            background: rgba(220, 53, 69, 0.1);
            color: #ff6b6b;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(220, 53, 69, 0.2);
            text-align: center;
            animation: shake 0.4s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(99, 102, 241, 0.25);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }
    
        @media (max-width: 768px) {
            body { padding: 15px; }
            .container, .login-container { padding: 30px 20px; width: 95%; }
            h2, h1 { font-size: 1.8rem; }
            .btn, .login-btn { padding: 12px; }
        }
</style>
</head>
<body>

    <!-- Animated background decorators -->
    <div class="decor-circle dc-1"></div>
    <div class="decor-circle dc-2"></div>

    <div class="login-container">
        <div class="glass-panel">
            <div class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <h1 class="logo-text"> Real Estate<span>Admin</span></h1>
            </div>

            <?php if (!empty($error)): ?>
                <div class="form-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon-wrapper">
                        <input type="text" id="username" name="username" class="form-control" required autocomplete="username" placeholder="Enter admin username">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon-wrapper">
                        <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Enter your password">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Secure Login</button>
            </form>
        </div>
        
        <div class="footer-text">
            &copy; <?php echo date('Y'); ?> Real Estate Management. All rights reserved.
        </div>
    </div>

</body>
</html>
