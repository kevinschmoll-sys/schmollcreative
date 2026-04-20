<?php
// ============================================================
// KSC CONTACT FORM HANDLER
// Uses PHPMailer + GoDaddy SMTP for reliable delivery
// PHPMailer installed via: composer require phpmailer/phpmailer
// OR drop PHPMailer src/ folder next to this file manually
// ============================================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://schmollcreative.com');
header('Access-Control-Allow-Methods: POST');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Load PHPMailer — try Composer autoload first, then manual src/ path
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/PHPMailer/src/PHPMailer.php')) {
    require __DIR__ . '/PHPMailer/src/Exception.php';
    require __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/PHPMailer/src/SMTP.php';
} else {
    // PHPMailer not installed — fall back to mail() with a warning logged
    error_log('KSC: PHPMailer not found, falling back to mail()');
    require __DIR__ . '/contact-fallback.php';
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Sanitize inputs
function clean($val) {
    return htmlspecialchars(strip_tags(trim($val)), ENT_QUOTES, 'UTF-8');
}

$name    = clean($_POST['name']    ?? '');
$email   = clean($_POST['email']   ?? '');
$company = clean($_POST['company'] ?? '');
$type    = clean($_POST['type']    ?? '');
$message = clean($_POST['message'] ?? '');

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid email address']);
    exit;
}

// Honeypot spam check
if (!empty($_POST['website'])) {
    echo json_encode(['success' => true]);
    exit;
}

// ── SMTP CONFIG ─────────────────────────────────────────────
// GoDaddy SMTP credentials — set these as environment variables
// in GoDaddy cPanel → PHP Variables, or hardcode temporarily.
// DO NOT commit credentials to git.
$smtp_host = getenv('KSC_SMTP_HOST') ?: 'smtpout.secureserver.net';
$smtp_user = getenv('KSC_SMTP_USER') ?: 'noreply@schmollcreative.com';
$smtp_pass = getenv('KSC_SMTP_PASS') ?: '';  // Set in cPanel env vars
$smtp_port = 465; // GoDaddy SSL port

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = $smtp_host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_user;
    $mail->Password   = $smtp_pass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $smtp_port;

    $mail->setFrom('noreply@schmollcreative.com', 'Schmoll Creative');
    $mail->addAddress('kevinschmoll@gmail.com', 'Kevin Schmoll');
    $mail->addReplyTo($email, $name);

    $mail->Subject = 'New inquiry from ' . $name . ' — schmollcreative.com';
    $mail->Body    =
        "New contact form submission from schmollcreative.com\n" .
        "================================================\n\n" .
        "Name:         $name\n" .
        "Email:        $email\n" .
        "Company:      $company\n" .
        "Project Type: $type\n\n" .
        "Message:\n$message\n\n" .
        "================================================\n" .
        "Reply directly to this email to respond.\n";

    $mail->send();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    error_log('KSC mailer error: ' . $mail->ErrorInfo);
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Mail failed — please try again or reach out on LinkedIn']);
}
?>
