<?php
require_once __DIR__ . "/../database.php";
function timeAgo($datetime)
{
    // Set default timezone (optional, but important if not globally set)
    date_default_timezone_set('Asia/Kathmandu');

    $timestamp = strtotime($datetime);
    $currentTime = time();
    $diff = $currentTime - $timestamp;

    if ($diff < 1) {
        return "just now";
    }

    $units = [
        31536000 => ['year', 'years'],
        2592000  => ['month', 'months'],
        86400    => ['day', 'days'],
        3600     => ['hour', 'hours'],
        60       => ['minute', 'minutes'],
        1        => ['second', 'seconds']
    ];

    foreach ($units as $secs => $labels) {
        if ($diff >= $secs) {
            $value = floor($diff / $secs);
            $label = $value === 1 ? $labels[0] : $labels[1];
            return "$value $label ago";
        }
    }

    return "just now";
}



class User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Add a new user
    public function addUser($name, $email, $password, $role = null)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (u_name, u_email, u_password, u_role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
        return $stmt->execute();
    }
    // Get paginated users using the external Paginator class
    public function getPaginatedUsers(string $search = '', string $orderBy = 'u_name ASC', int $perPage = 10, int $currentPage = 1): array
    {
        require_once '../ui/pagination.php'; // Adjust path if needed

        // Clean and prepare search condition
        $search = $this->conn->real_escape_string($search);
        $condition = "u_name LIKE '%$search%' OR u_email LIKE '%$search%' OR u_role LIKE '%$search%'";

        // Use Paginator
        $paginator = new Paginator($this->conn, 'users', $perPage, $currentPage, $condition);
        $result = $paginator->getData($orderBy);

        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return [
            'data' => $users,
            'pagination' => $paginator->renderLinks("?page="),
            'totalPages' => $paginator->getTotalPages(),
            'currentPage' => $currentPage
        ];
    }


    // Update user credentials
    public function updateUser($u_id, $name = null, $email = null, $password = null)
    {
        $fields = [];
        $params = [];
        $types = "";

        if ($name !== null) {
            $fields[] = "u_name = ?";
            $params[] = $name;
            $types .= "s";
        }
        if ($email !== null) {
            $fields[] = "u_email = ?";
            $params[] = $email;
            $types .= "s";
        }
        if ($password !== null) {
            $fields[] = "u_password = ?";
            $params[] = password_hash($password, PASSWORD_BCRYPT);
            $types .= "s";
        }

        if (empty($fields))
            return false;

        $params[] = $u_id;
        $types .= "i";

        $query = "UPDATE users SET " . implode(", ", $fields) . " WHERE u_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    // Get single user by ID
    public function getUser($u_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE u_id = ?");
        $stmt->bind_param("i", $u_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Get unassigned Users who is not assign to any class and section
    public function getUnassignedTeacher()
    {
        $stmt = $this->conn->prepare("SELECT u_id, u_name FROM users WHERE class_id IS NULL AND section_id IS NULL AND u_role = 'T'");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // ✅ Returns all unassigned teachers
    }


    // Get multiple users with search, order, and pagination
    public function getUsers($search = '', $orderBy = 'u_name', $orderDir = 'ASC', $limit = 10, $offset = 0)
    {
        $search = "%$search%";
        $allowedOrder = ['u_id', 'u_name', 'u_email', 'u_role'];
        $allowedDir = ['ASC', 'DESC'];

        if (!in_array($orderBy, $allowedOrder))
            $orderBy = 'u_name';
        if (!in_array(strtoupper($orderDir), $allowedDir))
            $orderDir = 'ASC';

        $query = "
            SELECT u_id, u_name, u_email, u_role
            FROM users
            WHERE u_name LIKE ? OR u_email LIKE ? OR u_role LIKE ?
            ORDER BY $orderBy $orderDir
            LIMIT ? OFFSET ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $search, $search, $search, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    // Count users for pagination
    public function countUsers($search = '')
    {
        $search = "%$search%";
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) as total
            FROM users
            WHERE u_name LIKE ? OR u_email LIKE ? OR u_role LIKE ?
        ");
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }

    // Assign a role
    public function assignRole($u_id, $role)
    {
        $stmt = $this->conn->prepare("UPDATE users SET u_role = ? WHERE u_id = ?");
        $stmt->bind_param("si", $role, $u_id);
        return $stmt->execute();
    }

    // Remove a role
    public function removeRole($u_id)
    {
        $stmt = $this->conn->prepare("UPDATE users SET u_role = NULL WHERE u_id = ?");
        $stmt->bind_param("i", $u_id);
        return $stmt->execute();
    }

    // Assign class and section (future use)
    public function assignClassAndSection($u_id, $class_id, $section_id)
    {
        $stmt = $this->conn->prepare("UPDATE users SET c_id = ?, s_id = ? WHERE u_id = ?");
        $stmt->bind_param("iii", $class_id, $section_id, $u_id);
        return $stmt->execute();
    }

    // Delete a user
    public function deleteUser($u_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE u_id = ?");
        $stmt->bind_param("i", $u_id);
        return $stmt->execute();
    }
}


class ClassManagement
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn; // $conn is a MySQLi connection object
    }

    // Add a new class
    public function addClass($className)
    {
        $stmt = $this->conn->prepare("INSERT INTO class (class_name) VALUES (?)");
        $stmt->bind_param("s", $className);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();
        return $insertId;
    }

    // Add multiple sections to a class
    public function addSections($classId, array $sections)
    {
        $stmt = $this->conn->prepare("INSERT INTO class_section (section_name, class_id) VALUES (?, ?)");
        foreach ($sections as $section) {
            $stmt->bind_param("si", $section, $classId);
            $stmt->execute();
        }
        $stmt->close();
        return true;
    }

    // Delete a class and its sections
    public function deleteClass($classId)
    {
        // Delete sections first
        $stmt1 = $this->conn->prepare("DELETE FROM class_section WHERE class_id = ?");
        $stmt1->bind_param("i", $classId);
        $stmt1->execute();
        $stmt1->close();

        // Then delete the class
        $stmt2 = $this->conn->prepare("DELETE FROM class WHERE class_id = ?");
        $stmt2->bind_param("i", $classId);
        $stmt2->execute();
        $stmt2->close();

        return true;
    }

    // Delete a section by section_id
    public function deleteSection($sectionId)
    {
        $stmt = $this->conn->prepare("DELETE FROM class_section WHERE section_id = ?");
        $stmt->bind_param("i", $sectionId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function getClassDetails($conn)
    {
        $data = [];

        // Get all classes
        $classSql = "SELECT * FROM class";
        $classResult = mysqli_query($conn, $classSql);
        if (!$classResult) {
            die("Class Query Failed: " . mysqli_error($conn));
        }

        while ($classRow = mysqli_fetch_assoc($classResult)) {
            $class_id = $classRow['class_id'];
            $class_name = $classRow['class_name'];

            // Get all sections for this class
            $sectionSql = "SELECT * FROM class_section WHERE class_id = $class_id";
            $sectionResult = mysqli_query($conn, $sectionSql);
            if (!$sectionResult) {
                die("Section Query Failed for class_id $class_id: " . mysqli_error($conn));
            }

            $sections = [];
            while ($sectionRow = mysqli_fetch_assoc($sectionResult)) {
                $sections[] = [
                    'section_id' => $sectionRow['section_id'],
                    'section_name' => $sectionRow['section_name']
                ];
            }

            // Get all teachers for this class (users with role 'T' and class_id matching)
            $teacherSql = "SELECT u_id, u_name 
                       FROM users 
                       WHERE u_role = 'T' AND class_id = $class_id";
            $teacherResult = mysqli_query($conn, $teacherSql);
            if (!$teacherResult) {
                die("Teacher Query Failed for class_id $class_id: " . mysqli_error($conn));
            }

            $teachers = [];
            while ($teacherRow = mysqli_fetch_assoc($teacherResult)) {
                $teachers[] = $teacherRow['u_name'];
            }

            // Compile data
            $data[] = [
                'class_id' => $class_id,
                'class_name' => $class_name,
                'teachers' => $teachers,
                'sections' => $sections
            ];
        }

        return $data;
    }
    public function getClass()
    {
        $stmt = $this->conn->prepare("SELECT * FROM class");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
    public function getSection($class_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM class_section WHERE class_id = ?");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }
    public function getSectionsByClassId($section_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM class_section WHERE class_id = $section_id");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }

    public function getTeachersByClassId($classId)
    {
        $stmt = $this->conn->prepare("SELECT u_id, u_name FROM users WHERE class_id = ? AND u_role = 'T'");
        $stmt->bind_param("i", $classId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }

    public function getTeachersBySectionId($sectionId)
    {
        $stmt = $this->conn->prepare("SELECT u_id, u_name FROM users WHERE section_id = ? AND u_role = 'T'");
        $stmt->bind_param("i", $sectionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }


    // Assign a class and section to a teacher (user)
    public function assignClassToTeacher($userId, $classId, $sectionId)
    {
        $stmt = $this->conn->prepare("UPDATE users SET class_id = ?, section_id = ? WHERE u_id = ?");
        $stmt->bind_param("iii", $classId, $sectionId, $userId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}


class News
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }
    public function addNews(array $data): bool
    {
        // Extract and sanitize inputs
        $post_type = $data['typ'] ?? '';
        $title = trim($data['title'] ?? '');
        $news_content = trim($data['description'] ?? '');
        $thumbnail = $data['thumbnail'] ?? null;
        $related_imgs = $data['related_imgs'] ?? null;

        // Validate required fields
        if (!in_array($post_type, ['news', 'notice'], true) || empty($title) || !$thumbnail) {
            return false;
        }

        // Upload directories
        $base_dir = __DIR__ . "/../../../uploads/";
        $images_dir = $base_dir . "images/";
        $descr_dir = $base_dir . "news_descr/";

        // Create directories if they don't exist
        if (!is_dir($images_dir) && !mkdir($images_dir, 0755, true)) {
            error_log("Failed to create images directory.");
            return false;
        }
        if (!is_dir($descr_dir) && !mkdir($descr_dir, 0755, true)) {
            error_log("Failed to create news_descr directory.");
            return false;
        }

        $allowed_types = ['image/jpeg', 'image/png'];

        // Validate thumbnail file type
        if (!in_array($thumbnail['type'], $allowed_types, true)) {
            return false;
        }

        // Prepare unique filename for thumbnail
        $thumb_name = uniqid('thumb_', true) . '_' . basename($thumbnail['name']);
        $thumb_path = $images_dir . $thumb_name;

        // Move thumbnail
        if (!move_uploaded_file($thumbnail['tmp_name'], $thumb_path)) {
            error_log("Failed to move uploaded thumbnail.");
            return false;
        }

        // Save news content to file
        $description_file = uniqid('descr_', true) . '_' . date("YmdHis") . ".txt";
        $desc_path = $descr_dir . $description_file;

        if (file_put_contents($desc_path, $news_content) === false) {
            error_log("Failed to save news content.");
            unlink($thumb_path); // rollback
            return false;
        }

        // Prepare and execute main insert
        $query = "INSERT INTO news (title, src, thumbnail, `type`) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            unlink($thumb_path);
            unlink($desc_path);
            return false;
        }

        $stmt->bind_param("ssss", $title, $description_file, $thumb_name, $post_type);

        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            $stmt->close();
            unlink($thumb_path);
            unlink($desc_path);
            return false;
        }

        $news_id = $stmt->insert_id;
        $stmt->close();

        // Handle related images
        if ($related_imgs && isset($related_imgs['tmp_name']) && is_array($related_imgs['tmp_name'])) {
            foreach ($related_imgs['tmp_name'] as $key => $tmp_name) {
                $file_type = $related_imgs['type'][$key] ?? '';
                if (!in_array($file_type, $allowed_types, true)) {
                    continue;
                }

                $file_name = uniqid('rtimg_', true) . '_' . basename($related_imgs['name'][$key]);
                $file_path = $images_dir . $file_name;

                if (move_uploaded_file($tmp_name, $file_path)) {
                    $img_stmt = $this->conn->prepare("INSERT INTO news_img (filename, news_id) VALUES (?, ?)");
                    if ($img_stmt) {
                        $img_stmt->bind_param("si", $file_name, $news_id);
                        $img_stmt->execute();
                        $img_stmt->close();
                    } else {
                        error_log("Image insert prepare failed: " . $this->conn->error);
                    }
                }
            }
        }

        return true;
    }





    // Get single news item by ID with images
    public function getById($id)
    {
        $id = (int) $id;
        $newsSql = "SELECT * FROM news WHERE news_id = $id";
        $newsRes = $this->conn->query($newsSql);

        if ($newsRes && $newsRes->num_rows > 0) {
            $news = $newsRes->fetch_assoc();

            $imgSql = "SELECT filename FROM news_img WHERE news_id = $id";
            $imgRes = $this->conn->query($imgSql);

            $images = [];
            if ($imgRes && $imgRes->num_rows > 0) {
                while ($row = $imgRes->fetch_assoc()) {
                    $images[] = $row['filename'];
                }
            }

            $news['images'] = $images;
            return $news;
        }

        return null;
    }

    // Get multiple news items with filters
    public function getAllNews($options = [])
    {
        $limit = isset($options['limit']) ? (int) $options['limit'] : 10;
        $typ = isset($options['typ']) ? $options['typ'] : 'news';
        $offset = isset($options['offset']) ? (int) $options['offset'] : 0;
        $query = isset($options['query']) ? '%' . $options['query'] . '%' : null;
        $order = (isset($options['order']) && strtoupper($options['order']) === 'ASC') ? 'ASC' : 'DESC';

        $data = [];

        // Build base SQL and parameters
        $sql = "SELECT * FROM news WHERE type = ?";
        $types = "s"; // type is string
        $params = [$typ];

        if ($query !== null) {
            $sql .= " AND title LIKE ?";
            $types .= "s";
            $params[] = $query;
        }

        $sql .= " ORDER BY news_id $order LIMIT ? OFFSET ?";
        $types .= "ii";
        $params[] = $limit;
        $params[] = $offset;

        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return [];
        }

        // Dynamically bind params
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();


        while ($news = $result->fetch_assoc()) {
            $news_id = (int) $news['news_id'];

            // Convert date to "time ago"
            $news['upload_date'] = timeAgo($news['upload_date']);

            // Reading the description file if it exists
            $filename = __DIR__ . "/../../../uploads/news_descr/" . $news['src'];
            if (file_exists($filename)) {
                $content = file_get_contents($filename);
                $news['src'] = $content;
            } else {
                $news['src'] = null;
            }

            // Fetch related images securely
            $imgStmt = $this->conn->prepare("SELECT filename FROM news_img WHERE news_id = ?");
            if ($imgStmt) {
                $imgStmt->bind_param("i", $news_id);
                $imgStmt->execute();
                $imgRes = $imgStmt->get_result();

                $images = [];
                while ($img = $imgRes->fetch_assoc()) {
                    $images[] = $img['filename'];
                }

                $imgStmt->close();
                $news['images'] = $images;
            } else {
                $news['images'] = [];
            }

            $data[] = $news;
        }

        $stmt->close();
        return $data;
    }


}

class Documents
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }
    public function addDocuments(array $data)
    {
        $title = trim($data['doc_title'] ?? '');
        $file = $data['file'] ?? null;

        if (empty($title) || !$file || $file['error'] !== UPLOAD_ERR_OK) {
            error_log("Missing title or invalid file.");
            return "Missing title or invalid file.";
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            error_log("Failed to open finfo.");
            return "Failed to open finfo.";
        }

        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if ($mimeType !== 'application/pdf') {
            error_log("Invalid file type: $mimeType. Only PDF allowed.");
            return "Invalid file type: $mimeType. Only PDF allowed.";
        }

        $uploadDir = __DIR__ . '/../../../uploads/documents/';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
            error_log("Failed to create upload directory.");
            return "Failed to create upload directory.";
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $safeFilename = uniqid('doc_', true) . '.' . $extension;
        $destination = $uploadDir . $safeFilename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            error_log("File upload failed.");
            return "File upload failed.";
        }

        chmod($destination, 0644);

        $sql = "INSERT INTO documents (doc_title, doc_file, upload_date) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            unlink($destination);
            return "Prepare failed: " . $this->conn->error;
        }

        $stmt->bind_param("ss", $title, $safeFilename);

        if ($stmt->execute()) {
            $insertedId = $stmt->insert_id;
            $stmt->close();
            return $insertedId;
        } else {
            $error = $stmt->error;
            error_log("Execute failed: " . $error);
            $stmt->close();
            unlink($destination);
            return "Execute failed: " . $error;
        }
    }






    // Get single document item by ID with images
    public function getById($id)
    {
        $id = (int) $id;
        $newsSql = "SELECT * FROM news WHERE news_id = $id";
        $newsRes = $this->conn->query($newsSql);

        if ($newsRes && $newsRes->num_rows > 0) {
            $news = $newsRes->fetch_assoc();

            $imgSql = "SELECT filename FROM news_img WHERE news_id = $id";
            $imgRes = $this->conn->query($imgSql);

            $images = [];
            if ($imgRes && $imgRes->num_rows > 0) {
                while ($row = $imgRes->fetch_assoc()) {
                    $images[] = $row['filename'];
                }
            }

            $news['images'] = $images;
            return $news;
        }

        return null;
    }

    // Get multiple news items with filters
    public function getAllDocuments($options = [])
    {
        $limit = isset($options['limit']) ? (int) $options['limit'] : 10;
        $offset = isset($options['offset']) ? (int) $options['offset'] : 0;
        $query = isset($options['query']) ? '%' . $options['query'] . '%' : null;
        $order = (isset($options['order']) && strtoupper($options['order']) === 'ASC') ? 'ASC' : 'DESC';

        $data = [];
        $params = [];
        $types = "";

        // Start building the SQL
        $sql = "SELECT * FROM documents";

        // Add WHERE clause if there's a search query
        if ($query !== null) {
            $sql .= " WHERE doc_title LIKE ?";
            $types .= "s";
            $params[] = $query;
        }

        // Append ordering, limit, and offset
        $sql .= " ORDER BY upload_date $order LIMIT ? OFFSET ?";
        $types .= "ii";
        $params[] = $limit;
        $params[] = $offset;

        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $this->conn->error);
            return [];
        }

        // Bind parameters
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($doc = $result->fetch_assoc()) {
            $data[] = $doc;
        }

        $stmt->close();
        return $data;
    }



}


$classManager = new ClassManagement($conn);
$user = new User($conn);
$news = new News($conn);
$document = new Documents($conn);

// ---- Test methods ----

// Add new user
// $user->addUser("John Doe", "john@example.com", "password123");

// Update user credentials (name only)
// $user->updateUser(14, "John Updated", null, null);

// Update user credentials (email and password)
// $user->updateUser(1, null, "newemail@example.com", "newpass456");

// Get single user by ID
// print_r($user->getUser(1));

// Get paginated users (with search, sorting, and pagination)
// print_r($user->getPaginatedUsers("john", "u_name DESC", 5, 1));

// Get multiple users with offset and limit
// print_r($user->getUsers("john", "u_email", "DESC", 5, 0));

// Count total users with search
// echo $user->countUsers("john");

// Assign role to user
// $user->assignRole(1, "editor");

// Remove role from user
// $user->removeRole(1);

// Assign class and section
// $user->assignClassAndSection(1, 101, 5);

// Delete user
// $user->deleteUser(1);

?>