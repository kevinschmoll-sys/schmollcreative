<?php
// ============================================================
// KSC CONTACT FORM HANDLER
// Receives POST from the contact form, emails Kevin
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

// Honeypot spam check (hidden field — bots fill it, humans don't)
if (!empty($_POST['website'])) {
    // Silently succeed so bots think it worked
    echo json_encode(['success' => true]);
    exit;
}

// Build email
$to      = 'kevinschmoll@gmail.com';
$subject = 'New inquiry from ' . $name . ' — schmollcreative.com';

$body  = "New contact form submission from schmollcreative.com\n";
$body .= "================================================\n\n";
$body .= "Name:         $name\n";
$body .= "Email:        $email\n";
$body .= "Company:      $company\n";
$body .= "Project Type: $type\n\n";
$body .= "Message:\n$message\n\n";
$body .= "================================================\n";
$body .= "Reply directly to this email to respond.\n";

$headers  = "From: noreply@schmollcreative.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Mail failed — please try again or reach out on LinkedIn']);
}
?>
