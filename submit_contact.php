<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);

        // Send confirmation email to the user
        $to = $email;
        $email_subject = "Thank you for contacting us - Real Estate Management";
        $email_body = "Hello $name,\n\nThank you for reaching out to us. We have received your inquiry regarding \"$subject\" and our team will get back to you as soon as possible.\n\nBest Regards,\nReal Estate Management Team";
        $headers = "From: noreply@dreamhomes.com";
        
        // Use @ to suppress warnings on localhost if mail server is not configured
        @mail($to, $email_subject, $email_body, $headers);

        echo json_encode(["status" => "success", "message" => "Message saved successfully."]);
    } catch(PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error saving message: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
