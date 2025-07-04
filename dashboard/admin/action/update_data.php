<?php
require_once '../../../script/php_scripts/database.php'; // $conn = mysqli connection
require_once '../../../script/php_scripts/utilities/response.php';
require_once "../../../script/php_scripts/utilities/tables.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        JsonResponse::send('fail', 'Invalid request method. Use POST.');
    }

    // ✅ Check if this is a password change request
    if (!empty($_POST['action']) && $_POST['action'] === 'change_password') {
        if (empty($_POST['u_id']) || empty($_POST['current_password']) || empty($_POST['new_password'])) {
            JsonResponse::send('fail', 'Missing password change fields.');
        }

        $userId = intval($_POST['u_id']);
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        // Fetch existing hashed password
        $stmt = $conn->prepare("SELECT password FROM users WHERE u_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            JsonResponse::send('fail', 'User not found.');
        }

        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        // Verify old password
        if (!password_verify($currentPassword, $hashedPassword)) {
            JsonResponse::send('fail', 'Incorrect current password.');
        }

        // Hash new password
        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE u_id = ?");
        $stmt->bind_param("si", $newHash, $userId);

        if ($stmt->execute()) {
            JsonResponse::send('success', 'Password updated successfully.');
        } else {
            JsonResponse::send('fail', 'Failed to update password.');
        }
        $stmt->close();
        $conn->close();
        exit;
    }

    // ✅ Original user update logic continues below
    if (empty($_POST['u_id']) || empty($_POST['u_role'])) {
        JsonResponse::send('fail', 'Missing required parameters.');
    }

    $userId = intval($_POST['u_id']);
    $role = $_POST['u_role'];
    $classId = !empty($_POST['class_id']) ? intval($_POST['class_id']) : null;
    $sectionId = !empty($_POST['section_id']) ? intval($_POST['section_id']) : null;

    $classResult = true;
    if ($role === 'T') {
        if (!$classId) {
            JsonResponse::send('fail', 'Class is required for Teacher role.');
        }

        $stmt = $conn->prepare("UPDATE users SET class_id = ?, section_id = ? WHERE u_id = ?");
        $stmt->bind_param("iii", $classId, $sectionId, $userId);
        $classResult = $stmt->execute();
        $stmt->close();
    } else {
        $stmt = $conn->prepare("UPDATE users SET class_id = NULL, section_id = NULL WHERE u_id = ?");
        $stmt->bind_param("i", $userId);
        $classResult = $stmt->execute();
        $stmt->close();
    }

    $stmt = $conn->prepare("UPDATE users SET u_role = ? WHERE u_id = ?");
    $stmt->bind_param("si", $role, $userId);
    $roleResult = $stmt->execute();
    $stmt->close();

    $conn->close();

    if ($classResult && $roleResult) {
        JsonResponse::send('success', 'User role and details updated successfully.');
    } else {
        JsonResponse::send('fail', 'Failed to update user role or class/section.');
    }

} catch (Exception $e) {
    JsonResponse::send('error', 'Server error occurred: ' . $e->getMessage());
}
?>
