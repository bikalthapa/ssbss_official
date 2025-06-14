<?php
require_once '../../../script/php_scripts/utilities/response.php';
require_once '../../../script/php_scripts/utilities/tables.php'; // Adjust path if needed


// Ensure it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    JsonResponse::send('fail', 'Invalid request method. Use POST.');
}

// Validate and sanitize input
if(isset($_POST['u_id'])){
    if (!isset($_POST['u_id']) || !is_numeric($_POST['u_id'])) {
        JsonResponse::send('fail', 'Missing or invalid user ID.');
    }
    $u_id = (int) $_POST['u_id'];

    // Attempt to delete the user
    if ($user->deleteUser($u_id)) {
        JsonResponse::send('success', "User with ID {$u_id} has been deleted.");
    } else {
        JsonResponse::send('fail', "Failed to delete user with ID {$u_id}. It may not exist.");
    }
}else if(isset($_POST['class_id'])){
    if (!isset($_POST['class_id']) || !is_numeric($_POST['class_id'])) {
        JsonResponse::send('fail', 'Missing or invalid Class ID.');
    }
    $class_id = (int) $_POST['class_id'];
    // Attempt to delete the class
    if ($classManager->deleteClass($class_id)) {
        JsonResponse::send('success', "Class with ID {$class_id} has been deleted.");
    } else {
        JsonResponse::send('fail', "Failed to delete class with ID {$class_id}. It may not exist.");
    }
}



?>
