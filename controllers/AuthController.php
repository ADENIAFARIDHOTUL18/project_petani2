
<?php
require_once dirname(__DIR__) . '/models/User.php';

class AuthController {
    private $user;

    public function __construct($pdo) {
        $this->user = new User($pdo);
    }

    public function loginPage() {
        if (isset($_SESSION['user'])) {
            header('Location: index.php?page=dashboard');
            exit;
        }
        include dirname(__DIR__) . '/views/auth/login.php';
    }

    public function loginAction() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $this->user->login($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: index.php?page=dashboard');
        } else {
            echo "Login gagal!";
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?page=login');
    }
}
