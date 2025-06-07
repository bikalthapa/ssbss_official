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
$email = trim($_POST['user_email'] ?? '');
$password = trim($_POST['user_password'] ?? '');

// Validate input
if (empty($email) || empty($password)) {
    JsonResponse::send('fail', 'Email and password are required');
}

// Perform authentication
$status = $auth->login($email, $password);
$role = $auth->getUserRole();


// Handle login result
if ($status === "success") {
	if($role === "A"){
		JsonResponse::send('success', 'Login successful', [
			'redirect_url' => '../dashboard/admin/'
		]);
	}else if($role === "T"){
		JsonResponse::send('success', 'Login successful', [
			'redirect_url' => '../dashboard/teacher/'
		]);
	}
} elseif ($status === "invalid_credentials") {
    JsonResponse::send('fail', 'Invalid email or password');
} else {
    JsonResponse::send('error', 'An unexpected error occurred');
}
?>