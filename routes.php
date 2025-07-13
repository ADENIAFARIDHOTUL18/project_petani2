<?php
require_once 'middleware.php';  // pastikan ini ada di atas

$pdo = (new Database())->connect();
$page = $_GET['page'] ?? 'login';

switch($page) {
    case 'login':
        guest_only();
        (new AuthController($pdo))->loginPage();
        break;

    case 'login_action':
        guest_only();
        (new AuthController($pdo))->loginAction();
        break;

    case 'logout':
        auth_required();
        (new AuthController($pdo))->logout();
        break;

    case 'dashboard':
        auth_required();
        $role = $_SESSION['user']['role'];
        if ($role === 'admin') {
            include dirname(__FILE__) . '/views/dashboard/admin.php';
        } else {
            include dirname(__FILE__) . '/views/dashboard/petani.php';
        }
        break;

    case 'register':
        auth_required();
        (new UserController($pdo))->registerPage();
        break;

    case 'register_action':
        auth_required();
        (new UserController($pdo))->registerAction();
        break;

    case 'modul':
        auth_required();
        $role = $_SESSION['user']['role'];
        (new ModulController($pdo))->listModul();
        break;

    case 'modul_input':
        auth_required();
        $role = $_SESSION['user']['role'];
        // Tambahkan cek role admin jika perlu
        if ($_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak.";
            exit;
        }
        (new ModulController($pdo))->inputModul();
        break;

    case 'modul_save':
        auth_required();
        $role = $_SESSION['user']['role'];
        if ($_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak.";
            exit;
        }
        (new ModulController($pdo))->saveModul();
        break;

    case 'modul_edit':
        auth_required();
        $role = $_SESSION['user']['role'];
        if ($_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak.";
            exit;
        }
        (new ModulController($pdo))->editModul();
        break;
    
    case 'modul_update':
        auth_required();
        $role = $_SESSION['user']['role'];
        if ($_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak.";
            exit;
        }
        (new ModulController($pdo))->updateModul();
        break;
    
    case 'modul_delete':
        auth_required();
        $role = $_SESSION['user']['role'];
        if ($_SESSION['user']['role'] !== 'admin') {
            echo "Akses ditolak.";
            exit;
        }
        (new ModulController($pdo))->deleteModul();
        break;

    case 'aktivitas':
        auth_required();
        (new AktivitasController($pdo))->listAktivitas();
        break;
    
    case 'aktivitas_input':
        auth_required();
        (new AktivitasController($pdo))->inputAktivitas();
        break;
    
    case 'aktivitas_save':
        auth_required();
        (new AktivitasController($pdo))->saveAktivitas();
        break;
    case 'aktivitas_edit':
        (new AktivitasController($pdo))->editAktivitas();
        break;
    case 'aktivitas_update':
        (new AktivitasController($pdo))->updateAktivitas();
        break;
    case 'aktivitas_delete':
        (new AktivitasController($pdo))->deleteAktivitas();
        break;

    case 'forum':
        (new ForumController($pdo))->listTopics();
        break;
    case 'forum_view':
        (new ForumController($pdo))->viewTopic();
        break;
    case 'forum_create':
        (new ForumController($pdo))->createTopicPage();
        break;
    case 'forum_create_action':
        (new ForumController($pdo))->createTopicAction();
        break;
    case 'forum_add_comment':
        (new ForumController($pdo))->addComment();
        break;
    case 'forum_delete_topic':
        (new ForumController($pdo))->deleteTopic();
        break;
    case 'forum_delete_comment':
        (new ForumController($pdo))->deleteComment();
        break;
    
        
        
        
    default:
        echo "404 Page not found.";
}
