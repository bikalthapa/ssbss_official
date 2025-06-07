<?php
ob_clean(); // Clear any previous output
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../script/php_scripts/utilities/authentication.php";
require_once "../script/php_scripts/utilities/response.php";

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    JsonResponse::send('fail', 'Invalid request method');
}

// Sanitize input
$name = trim($_POST['user_name'] ?? '');
$email = trim($_POST['user_email'] ?? '');
$password = trim($_POST['user_password'] ?? '');
$cpassword = trim($_POST['user_cpassword'] ?? '');

// Input validations
if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
    JsonResponse::send('fail', 'All fields are required');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    JsonResponse::send('fail', 'Invalid email format');
}

if (strlen($password) < 6) {
    JsonResponse::send('fail', 'Password must be at least 6 characters');
}

if ($password !== $cpassword) {
    JsonResponse::send('fail', 'Passwords do not match');
}

// Attempt signup
$result = $auth->signup($email, $password, $name); // optional: add 'E' as 4th arg for role

if ($result['status'] === 'success') {
    JsonResponse::send('success', $result['message'], [
        'redirect_url' => 'index' // Login page
    ]);
} else {
    JsonResponse::send('fail', $result['message']);
}
