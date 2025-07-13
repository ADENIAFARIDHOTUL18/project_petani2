
<?php
require_once dirname(__DIR__) . '/models/User.php';

class UserController {
    private $user;

    public function __construct($pdo) {
        $this->user = new User($pdo);
    }

    public function registerPage() {
        include dirname(__DIR__) . '/views/auth/register.php';
    }

    public function registerAction() {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        if ($this->user->create($username, $password, $role, $nama)) {
            header('Location: index.php?page=dashboard');
        } else {
            echo "Gagal mendaftarkan user.";
        }
    }
}
