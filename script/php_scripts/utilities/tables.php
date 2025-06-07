<?php
require_once __DIR__."/../database.php";
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



// Create User object
$user = new User($conn);

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
