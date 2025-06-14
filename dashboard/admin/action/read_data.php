<?php
require_once '../../../script/php_scripts/database.php'; // Assumes $conn is a MySQLi connection
require_once '../../../script/php_scripts/utilities/response.php';
require_once "../../../script/php_scripts/utilities/tables.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        JsonResponse::send('fail', 'Invalid request method. Use POST.');
    } else {
        if (isset($_POST['typ'])) {
            if ($_POST['typ'] === "class") {
                $classes = $classManager->getClass();
                if ($classes) {
                    JsonResponse::send('success', 'Classes fetched successfully.', $classes);
                } else {
                    JsonResponse::send('error', 'Query failed: ' . $conn->error);
                }
            } else if ($_POST['typ'] === "section") {
                if (isset($_POST['class_id']) && !empty($_POST['class_id'])) {
                    $class_id = intval($_POST['class_id']);
                    $sections = $classManager->getSection($class_id);
                    if ($sections || $sections === []) {
                        JsonResponse::send('success', 'Sections fetched successfully.', $sections);
                    } else {
                        JsonResponse::send('success', 'Query failed: ' . $conn->error);
                    }
                } else {
                    JsonResponse::send('fail', 'Class ID is required for fetching sections.');
                }
            }else if($_POST['typ']=="news" || $_POST['typ']=="notice") {
                $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10; // Default limit
                $sort = isset($_POST['sort']) ? $_POST['sort'] : 'DESC'; // Default sort order
                $query = isset($_POST['query']) ? $_POST['query'] : '';

                $newsData = $news->getAllNews(array("typ"=>$_POST['typ'], "limit"=>$limit, "order"=> $sort, "query"=>$query));
                if(count($newsData)>0){
                    JsonResponse::send('success', 'News fetched successfully.', $newsData);
                }else if(count($newsData) === 0){
                    JsonResponse::send('success', 'No news found.', []);
                } else {
                    JsonResponse::send('error', 'Query failed: ' . $conn->error);
                }
            }else if($_POST['typ'] === "document") {
                $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10; // Default limit
                $sort = isset($_POST['sort']) ? $_POST['sort'] : 'DESC'; // Default sort order
                $query = isset($_POST['query']) ? $_POST['query'] : '';

                $documentsData = $document->getAllDocuments(array("limit"=>$limit, "order"=> $sort, "query"=>$query));
                if(count($documentsData)>0){
                    JsonResponse::send('success', 'Documents fetched successfully.', $documentsData);
                }else if(count($documentsData) === 0){
                    JsonResponse::send('success', 'No documents found.', []);
                } else {
                    JsonResponse::send('error', 'Query failed: ' . $conn->error);
                }

            } else {
                JsonResponse::send('fail', 'Invalid type specified.');
            }
        } else {
            JsonResponse::send('fail', 'Type parameter is missing.');
        }
    }

} catch (Exception $e) {
    JsonResponse::send('error', 'Server error occurred.');
}
