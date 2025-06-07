<?php
require_once __DIR__ . "/../database.php";
class Authenticator
{
    private $conn;
    private $sessionKey = 'login_id';
    private $roleKey = 'user_role';

    public function __construct($dbConnection)
    {
        session_start();
        $this->conn = $dbConnection;
    }

    // Login method
    public function login($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "invalid_credentials";
        }

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE u_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return "invalid_credentials";
        }

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['u_password'])) {
            $_SESSION[$this->sessionKey] = $user['u_id'];
            $_SESSION[$this->roleKey] = $user['u_role']; // Save role to session
            return "success";
        } else {
            return "invalid_credentials";
        }
    }

    // Sign up / Register user
    public function signup($u_email, $u_password, $u_name, $u_role = null)
    {
        // Validate inputs
        if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
            return ['status' => 'error', 'message' => 'Invalid email address.'];
        }

        if (strlen($u_password) < 6) {
            return ['status' => 'error', 'message' => 'Password must be at least 6 characters long.'];
        }

        if (empty($u_name)) {
            return ['status' => 'error', 'message' => 'Name is required.'];
        }

        // Check if email already exists
        $stmt = $this->conn->prepare("SELECT u_id FROM users WHERE u_email = ?");
        $stmt->bind_param("s", $u_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return ['status' => 'error', 'message' => 'Email already registered.'];
        }

        $stmt->close();

        // Hash password
        $hashedPassword = password_hash($u_password, PASSWORD_BCRYPT);

        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO users (u_email, u_password, u_name, u_role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $u_email, $hashedPassword, $u_name, $u_role);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'User registered successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to register user.'];
        }
    }

    // Logout
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        return true;
    }

    // Check login status
    public function isLoggedIn()
    {
        return isset($_SESSION[$this->sessionKey]) && isset($_SESSION[$this->roleKey]) ? $this->getUserRole() : "";
    }

    // Get user ID
    public function getUserId()
    {
        return $this->isLoggedIn() ? $_SESSION[$this->sessionKey] : null;
    }

    // Get user role
    public function getUserRole()
    {
        return $_SESSION[$this->roleKey] ?? null;
    }

    // Require login
    public function requireLogin($redirectPath)
    {
        if (!$this->isLoggedIn()) {
            header("Location: $redirectPath");
            exit;
        }
    }

    // Role-based redirect
    public function redirectByRole()
    {
        if (!$this->isLoggedIn()) {
            header("Location: login.php");
            exit;
        }

        $role = strtoupper($_SESSION[$this->roleKey] ?? '');

        switch ($role) {
            case 'A':
                header("Location: ../admin/index.php");
                break;
            case 'T':
                header("Location: ../teacher/index.php");
                break;
            case 'E':
                header("Location: ../editor/index.php");
                break;
            default:
                header("Location: ../unauthorized.php"); // fallback for unknown roles
        }
        exit;
    }
}

$auth = new Authenticator($conn);

?>