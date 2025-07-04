<?php
require_once "../../../script/php_scripts/utilities/response.php";
require_once "../../../script/php_scripts/utilities/tables.php";
require_once "../../../script/php_scripts/database.php"; // Defines $conn

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$action = $_POST['action'] ?? null;

try {
    // 🔹 Add Class
    if ($action === "add_class") {
        $className = $_POST['class_name'] ?? null;
        $sectionNames = $_POST['section_names'] ?? [];
        $userId = $_POST['u_id'] ?? null;
        $sectionId = $_POST['section_id'] ?? null;

        if (!$className) {
            JsonResponse::send("fail", "class_name is required");
        }

        $classId = $classManager->addClass($className);
        $response = ['class_id' => $classId];

        if (!empty($sectionNames) && is_array($sectionNames)) {
            $classManager->addSections($classId, $sectionNames);
            $response['sections_added'] = $sectionNames;
        }

        if ($userId && $sectionId) {
            $classManager->assignClassToTeacher((int) $userId, $classId, (int) $sectionId);
            $response['assigned_to_teacher'] = [
                'u_id' => (int) $userId,
                'class_id' => $classId,
                'section_id' => (int) $sectionId
            ];
        }

        JsonResponse::send("success", "Class created successfully", $response);
    }

    // 🔹 Add News
    else if ($action === "new_news") {
        // Collect and sanitize input
        $newsData = [
            'typ' => $_POST['typ'] ?? '',
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'thumbnail' => $_FILES['thumbnail'] ?? null,
            'related_imgs' => $_FILES['image'] ?? null
        ];

        // 🔒 Validate required fields
        if (empty($newsData['typ']) || !in_array($newsData['typ'], ['news', 'notice'], true)) {
            JsonResponse::send("fail", "Invalid or missing post type.");
        }

        if (empty($newsData['title'])) {
            JsonResponse::send("fail", "Title is required.");
        }

        if (empty($newsData['description'])) {
            JsonResponse::send("fail", "News content is required.");
        }

        // 🔒 Validate thumbnail
        if (!isset($_FILES['thumbnail']) || $_FILES['thumbnail']['error'] !== UPLOAD_ERR_OK) {
            JsonResponse::send("fail", "Thumbnail is required and must be a valid image.");
        }

        // ✅ Attempt to add news
        $result = $news->addNews($newsData);
        if ($result) {
            JsonResponse::send("success", "News/Notice added successfully.");
        } else {
            JsonResponse::send("fail", $result);
        }
    } else if ($action === "new_document") {
        $title = trim($_POST['title'] ?? '');
        $file = $_FILES['file'] ?? null;

        // Basic validation
        if (empty($title)) {
            JsonResponse::send("fail", "Title is required.");
        }
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            JsonResponse::send("fail", "File is required.");
        }

        // Check MIME type
        $mime = mime_content_type($file['tmp_name']);
        if ($mime !== 'application/pdf') {
            JsonResponse::send("fail", "File must be a valid PDF.");
        }

        // Prepare data array
        $documentData = [
            'doc_title' => $title,
            'file' => $file,
        ];

        // Call addDocuments function which handles upload and DB insert
        $result = $document->addDocuments($documentData);

        if ($result) {
            JsonResponse::send("success", "Document added successfully.");
        } else {
            JsonResponse::send("fail", "Failed to add document.");
        }
    }



    // 🔹 Unknown Action
    else {
        JsonResponse::send("fail", "Invalid or missing action.");
    }

} catch (Exception $e) {
    JsonResponse::send("error", "An error occurred: " . $e->getMessage());
}

$conn->close();
?>