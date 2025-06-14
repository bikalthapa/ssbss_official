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

    // Validate required fields
    if (empty($_POST['u_id']) || empty($_POST['u_role'])) {
        JsonResponse::send('fail', 'Missing required parameters.');
    }

    $userId = intval($_POST['u_id']);
    $role = $_POST['u_role'];
    $classId = !empty($_POST['class_id']) ? intval($_POST['class_id']) : null;
    $sectionId = !empty($_POST['section_id']) ? intval($_POST['section_id']) : null;

    // Assuming $users is a utility object (e.g., instance of a class UsersHandler)
    // If not defined, you need to create this class or write SQL below directly

    $classResult = true;
    if ($role === 'T') {
        // Class & section assignment required only for Teacher
        if (!$classId) {
            JsonResponse::send('fail', 'Class is required for Teacher role.');
        }
        // Assign class and section
        $stmt = $conn->prepare("UPDATE users SET class_id = ?, section_id = ? WHERE u_id = ?");
        $stmt->bind_param("iii", $classId, $sectionId, $userId);
        $classResult = $stmt->execute();
        $stmt->close();
    } else {
        // Reset class/section for non-teachers
        $stmt = $conn->prepare("UPDATE users SET class_id = NULL, section_id = NULL WHERE u_id = ?");
        $stmt->bind_param("i", $userId);
        $classResult = $stmt->execute();
        $stmt->close();
    }

    // Assign role
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