
<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    //method get data user
    public function getAll() {
        return $this->db->query("SELECT * FROM users")->fetchAll();
    }

    //method create user
    public function create($username, $password, $role, $nama) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role, nama) VALUES (:username, :password, :role, :nama)");
        return $stmt->execute([
            'username' => $username,
            'password' => $password,
            'role'     => $role,
            'nama'     => $nama
        ]);
    }
    
    
}
