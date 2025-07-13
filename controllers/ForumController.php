<?php
require_once dirname(__DIR__) . '/models/Forum.php';

class ForumController {
    private $forum;

    public function __construct($pdo) {
        $this->forum = new Forum($pdo);
    }

    public function listTopics() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $topics = $this->forum->getAllTopics();
        include dirname(__DIR__) . '/views/forum/list.php';
    }

    public function viewTopic() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "Topik tidak ditemukan";
            exit;
        }
        $topic = $this->forum->getTopicById($id);
        if (!$topic) {
            echo "Topik tidak ditemukan";
            exit;
        }
        $comments = $this->forum->getCommentsByTopic($id);
        include dirname(__DIR__) . '/views/forum/view.php';
    }

    public function createTopicPage() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        include dirname(__DIR__) . '/views/forum/create.php';
    }

    public function createTopicAction() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $judul = $_POST['judul'] ?? '';
        $user_id = $_SESSION['user']['id'];
        if ($judul) {
            $this->forum->createTopic($user_id, $judul);
            header('Location: index.php?page=forum');
        } else {
            echo "Judul harus diisi.";
        }
    }

    public function addComment() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $topic_id = $_POST['topic_id'] ?? null;
        $komentar = $_POST['komentar'] ?? '';
        $user_id = $_SESSION['user']['id'];
        if ($topic_id && $komentar) {
            $this->forum->createComment($topic_id, $user_id, $komentar);
            header("Location: index.php?page=forum_view&id=$topic_id");
        } else {
            echo "Komentar tidak boleh kosong.";
        }
    }

    public function deleteTopic() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Tidak diizinkan.";
            exit;
        }
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->forum->deleteTopic($id);
        }
        header('Location: index.php?page=forum');
    }

    public function deleteComment() {
        session_start();
        if (!isset($_SESSION['user'])) {
            echo "Tidak diizinkan.";
            exit;
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?page=forum');
            exit;
        }

        // Cek apakah admin atau pemilik komentar
        $comment = $this->forum->getCommentById($id);
        if (!$comment) {
            echo "Komentar tidak ditemukan.";
            exit;
        }

        $user = $_SESSION['user'];

        if ($user['role'] === 'admin' || $comment['user_id'] == $user['id']) {
            $this->forum->deleteComment($id);
        } else {
            echo "Tidak diizinkan menghapus komentar ini.";
            exit;
        }

        header('Location: index.php?page=forum_view&id=' . $comment['topic_id']);
    }
}
