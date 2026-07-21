<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "real_estate_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";

// ✅ FORM SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'] ?? '';
    $property = $_POST['property'];
    $property_location = $_POST['property_location'] ?? '';
    $property_image = $_POST['property_image'] ?? '';
    $source = $_POST['source'];
    $message = $_POST['message'];

    $sql = "INSERT INTO referrals (location_source, name, email, phone, address, property, property_location, source, message)
            VALUES ('Kurugodu', '$name','$email','$phone','$address','$property','$property_location','$source','$message')";

    if ($conn->query($sql) === TRUE) {
        // Send confirmation email to the user
        $to = $email;
        $email_subject = "Thank you for your property inquiry - Real Estate Management";
        $email_body = "Hello $name,\n\nThank you for reaching out to us. We have received your inquiry for the property \"$property\" and our team will get back to you as soon as possible.\n\nBest Regards,\nReal Estate Management Team";
        $headers = "From: noreply@dreamhomes.com";
        @mail($to, $email_subject, $email_body, $headers);

        // ✅ REDIRECT WITH PARAMS FOR PDF RECEIPT
        $redirect_url = $_SERVER['PHP_SELF'] . "?success=1" . 
            "&r_name=" . urlencode($name) . 
            "&r_email=" . urlencode($email) . 
            "&r_phone=" . urlencode($phone) . 
            "&r_addr=" . urlencode($address) .
            "&r_prop=" . urlencode($property) .
            "&r_loc=" . urlencode($property_location) .
            "&r_img=" . urlencode($property_image);
        header("Location: " . $redirect_url);
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refer a Friend - Kurugodu Real Estate</title>
<!-- HTML2PDF Library for generating PDF Receipts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #4361ee;
        --secondary: #7209b7;
        --accent: #f72585;
        --bg-dark: #0f172a;
        --text-main: #1e293b;
        --white: #ffffff;
        --success: #10b981;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Outfit', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        position: relative;
        overflow-x: hidden;
    }

    /* Background decorative elements */
    body::before {
        content: '';
        position: absolute;
        top: -100px;
        left: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(67, 97, 238, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }

    body::after {
        content: '';
        position: absolute;
        bottom: -100px;
        right: -100px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(114, 9, 183, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }

    .container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        max-width: 550px;
        width: 100%;
        margin: auto;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.05);
        position: relative;
        z-index: 1;
    }

    h2 {
        color: var(--bg-dark);
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
        font-weight: 700;
        position: relative;
        display: inline-block;
        width: 100%;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.95rem;
    }

    input, select, textarea {
        width: 100%;
        padding: 14px 18px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        color: var(--text-main);
        transition: var(--transition);
        outline: none;
    }

    input:focus, select:focus, textarea:focus {
        border-color: var(--primary);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
    }

    textarea {
        height: 120px;
        resize: vertical;
    }

    .btn {
        margin-top: 10px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--white);
        border: none;
        padding: 16px;
        width: 100%;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 12px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px rgba(67, 97, 238, 0.4);
    }

    .btn:active {
        transform: translateY(1px);
    }

    .back-container {
        text-align: center;
        margin-top: 30px;
        width: 100%;
    }

    .back {
        display: inline-block;
        text-decoration: none;
        padding: 12px 35px;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        background: var(--white);
        border: 2px solid #e2e8f0;
        border-radius: 30px;
        transition: var(--transition);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .back:hover {
        background: var(--bg-dark);
        color: var(--white);
        border-color: var(--bg-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }

    /* MODERN SUCCESS MODAL */
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.show {
        display: flex;
        opacity: 1;
    }

    .modal-content {
        background: var(--white);
        padding: 40px;
        border-radius: 24px;
        text-align: center;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        transform: scale(0.9);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .modal-overlay.show .modal-content {
        transform: scale(1);
    }

    .modal-icon {
        width: 80px;
        height: 80px;
        background: rgba(16, 185, 129, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .modal-icon svg {
        width: 40px;
        height: 40px;
        color: var(--success);
    }

    .modal-content h3 {
        color: var(--bg-dark);
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .modal-content p {
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .modal-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 20px;
    }

    .modal-btn {
        background: var(--success);
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 30px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        flex: 1;
    }

    .modal-btn.secondary {
        background: var(--primary);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }

    .modal-btn.home-btn {
        background: linear-gradient(135deg, #f72585, #b5179e);
        box-shadow: 0 4px 15px rgba(247, 37, 133, 0.35);
    }

    .modal-btn:hover {
        transform: translateY(-2px);
        filter: brightness(110%);
    }

    @media (max-width: 600px) {
        .container {
            padding: 30px 20px;
        }
        .modal-actions {
            flex-direction: column;
        }
    }

        @media (max-width: 768px) {
            body { padding: 10px; }
            .container { padding: 30px 20px; border-radius: 20px; }
            h2 { font-size: 1.75rem; }
            .input-group label { font-size: 0.9rem; }
            .btn { padding: 12px; }
        }
        @media (max-width: 480px) {
            .modal-actions { flex-direction: column; }
            .modal-btn { width: 100%; }
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

<div class="container">
    <h2>REFER A FRIEND</h2>

    <form id="refForm" method="POST">
        <div class="form-group">
            <label>Full Name *</label>
            <input type="text" name="name" required placeholder="Enter full name">
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" required placeholder="Enter email address">
        </div>

        <div class="form-group">
            <label>Phone Number *</label>
            <input type="tel" name="phone" required placeholder="Enter active phone number">
        </div>

        <div class="form-group">
            <label>Address *</label>
            <input type="text" name="address" required placeholder="Enter your full address">
        </div>

        <div class="form-group">
            <label>Property Interest *</label>
            <?php $prefilled_prop = isset($_GET['property_title']) ? htmlspecialchars($_GET['property_title']) : ''; ?>
            <?php $prefilled_img = isset($_GET['property_image']) ? htmlspecialchars($_GET['property_image']) : ''; ?>
            <?php $prefilled_loc = isset($_GET['property_location']) ? htmlspecialchars($_GET['property_location']) : ''; ?>
            <input type="text" name="property" value="<?php echo $prefilled_prop; ?>" required placeholder="Enter the property name">
            <input type="hidden" name="property_image" value="<?php echo $prefilled_img; ?>">
        </div>

        <div class="form-group">
            <label>Property Full Address *</label>
            <input type="text" name="property_location" value="<?php echo (!empty($prefilled_loc) ? "Kurugodu, " . $prefilled_loc : ''); ?>" required placeholder="Enter the full property address">
        </div>

        <div class="form-group">
            <label>How did you hear about us?</label>
            <input type="text" name="source" placeholder="E.g., Social Media, Friend, Advertisement">
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea name="message" placeholder="Additional details or specific requirements..."></textarea>
        </div>

        <button type="submit" class="btn">Submit Referral</button>
    </form>
</div>

<div class="back-container">
    <a href="../kurugodu/kurugodu.php" class="back">← Back to Kurugodu Hub</a>
    <a href="../myproject.php" class="back">🏠 Back to Home Page</a>
</div>

<!-- SUCCESS MODAL -->
<div id="successPopup" class="modal-overlay">
  <div class="modal-content">
    <div class="modal-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>
    <h3>Success!</h3>
    <p>Thank you! Your property referral has been submitted successfully.</p>
    
    <div class="modal-actions">
        <!-- Download PDF Button -->
        <button onclick="downloadReceipt()" class="modal-btn secondary">📄 Download PDF Receipt</button>
        <button onclick="closePopup()" class="modal-btn">Continue</button>
        <button onclick="goToHomePage()" class="modal-btn home-btn">🏠 Home Page</button>
    </div>
  </div>
</div>

<!-- HIDDEN RECEIPT TEMPLATE (Used only for PDF Generation) -->
<div id="receiptTemplate" style="display:none; padding:40px; background:white; color:black; font-family:'Outfit', sans-serif;">
    <h1 style="color:#4361ee; text-align:center; font-size:28px; margin-bottom:10px;">Kurugodu Real Estate</h1>
    <h2 style="text-align:center; border-bottom:2px solid #e2e8f0; padding-bottom:15px; color:#1e293b; font-size:20px;">Referral Submission Receipt</h2>
    
    <div style="margin-top:40px; font-size:16px; line-height:2.2; border:1px solid #e2e8f0; padding:25px; border-radius:12px; background:#f8fafc;">
        <div style="text-align:center; margin-bottom: 20px; display: none;" id="rec_img_container">
            <img id="rec_img" src="" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
        </div>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Name:</strong> <span id="rec_name" style="font-weight:600; color:#0f172a;"></span></p>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Email:</strong> <span id="rec_email" style="font-weight:600; color:#0f172a;"></span></p>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Phone:</strong> <span id="rec_phone" style="font-weight:600; color:#0f172a;"></span></p>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Address:</strong> <span id="rec_addr" style="font-weight:600; color:#0f172a;"></span></p>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Property Interest:</strong> <span id="rec_prop" style="font-weight:600; color:#0f172a;"></span></p>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Property Address:</strong> <span id="rec_prop_loc" style="font-weight:600; color:#0f172a;"></span></p>
        <p><strong style="color:#64748b; width:150px; display:inline-block;">Date Submitted:</strong> <span id="rec_date" style="font-weight:600; color:#0f172a;"></span></p>
    </div>
    
    <div style="margin-top:50px; text-align:center; font-size:14px; color:#64748b; padding-top:20px; border-top:1px dashed #e2e8f0;">
        Thank you for your referral! Our management team will contact you shortly regarding this submission.
    </div>
</div>

<script>
let receiptData = null;

function closePopup() {
    const modal = document.getElementById("successPopup");
    modal.classList.remove("show");
    setTimeout(() => {
        modal.style.display = "none";
        // Automatically return to the overview page
        window.location.href = "../kurugodu/kurugodu.php";
    }, 300);
}

function goToHomePage() {
    window.location.href = "../myproject.php";
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('success') === '1') {
        
        // Store data from URL parameters internally
        receiptData = {
            name: urlParams.get('r_name') || 'N/A',
            email: urlParams.get('r_email') || 'N/A',
            phone: urlParams.get('r_phone') || 'N/A',
            address: urlParams.get('r_addr') || 'N/A',
            prop: urlParams.get('r_prop') || 'N/A',
            loc: urlParams.get('r_loc') || 'N/A',
            img: urlParams.get('r_img') || ''
        };

        const imgEl = document.getElementById('rec_img');
        const imgContainer = document.getElementById('rec_img_container');
        if (receiptData.img) {
            let imgSrc = receiptData.img;
            if (!imgSrc.startsWith('http') && !imgSrc.startsWith('../')) { imgSrc = '../' + imgSrc; }
            imgEl.src = imgSrc;
            imgContainer.style.display = 'block';
        }

        const modal = document.getElementById("successPopup");
        modal.style.display = "flex";
        
        setTimeout(() => {
            modal.classList.add("show");
        }, 10);

        // Clean the URL to hide parameters from the user without refreshing
        window.history.replaceState({}, document.title, window.location.pathname);
    }
};

// Generate PDF using html2pdf.js
function downloadReceipt() {
    if (!receiptData) return;

    // Populate the hidden template with captured data
    document.getElementById('rec_name').innerText = receiptData.name;
    document.getElementById('rec_email').innerText = receiptData.email;
    document.getElementById('rec_phone').innerText = receiptData.phone;
    document.getElementById('rec_addr').innerText = receiptData.address;
    document.getElementById('rec_prop').innerText = receiptData.prop;
    document.getElementById('rec_prop_loc').innerText = receiptData.loc;
    document.getElementById('rec_date').innerText = new Date().toLocaleString();
    
    // Briefly display it for rendering
    const receiptElement = document.getElementById('receiptTemplate');
    receiptElement.style.display = 'block';
    
    // Configure PDF options
    const opt = {
      margin:       0.5,
      filename:     'Kurugodu_Referral_Receipt.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    
    // Generate and Download
    html2pdf().set(opt).from(receiptElement).save().then(() => {
        // Hide again after generation
        receiptElement.style.display = 'none';
        
        // Optional: close the modal automatically after download
        // closePopup();
    });
}
</script>

</body>
</html>