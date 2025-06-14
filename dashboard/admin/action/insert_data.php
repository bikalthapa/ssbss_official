<?php
require_once "../../../script/php_scripts/utilities/response.php";
require_once "../../../script/php_scripts/utilities/tables.php";
require_once "../../../script/php_scripts/database.php"; // This defines $conn


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


// Extract POST data
$className = $_POST['class_name'] ?? null;
$sectionNames = $_POST['section_names'] ?? [];  // Expected as array
$userId = $_POST['u_id'] ?? null;
$sectionId = $_POST['section_id'] ?? null;

if (!$className) {
    JsonResponse::send("fail", "class_name is required");
}

try {
    // Add class
    $classId = $classManager->addClass($className);

    $response = ['class_id' => $classId];

    // Add sections
    if (!empty($sectionNames) && is_array($sectionNames)) {
        $classManager->addSections($classId, $sectionNames);
        $response['sections_added'] = $sectionNames;
    }

    // Assign to teacher if both u_id and section_id are provided
    if ($userId && $sectionId) {
        $classManager->assignClassToTeacher((int) $userId, $classId, (int) $sectionId);
        $response['assigned_to_teacher'] = [
            'u_id' => (int) $userId,
            'class_id' => $classId,
            'section_id' => (int) $sectionId
        ];
    }

    JsonResponse::send("success", "Class created successfully", $response);

} catch (Exception $e) {
    
    JsonResponse::send("error", "An error occurred: " . $e->getMessage());
}

// You can close the connection here if needed, or leave it to your database manager.
$conn->close();
?>