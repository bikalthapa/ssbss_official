<?php
class Database {
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ssbss_official";
    private $connection;

    public function __construct($hostname = null, $username = null, $password = null, $dbname = null) {
        if ($hostname) $this->hostname = $hostname;
        if ($username) $this->username = $username;
        if ($password) $this->password = $password;
        if ($dbname)   $this->dbname = $dbname;

        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli(
            $this->hostname,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}

// Initialize database
$db = new Database();
$conn = $db->getConnection();
?>
