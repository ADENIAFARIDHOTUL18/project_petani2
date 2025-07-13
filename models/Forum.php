<?php
class Forum {
    private $db;
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAllTopics() {
        $stmt = $this->db->query("SELECT ft.*, u.nama FROM forum_topics ft JOIN users u ON ft.user_id = u.id ORDER BY ft.created_at DESC");
        return $stmt->fetchAll();
    }

    public function getTopicById($id) {
        $stmt = $this->db->prepare("SELECT ft.*, u.nama FROM forum_topics ft JOIN users u ON ft.user_id = u.id WHERE ft.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getCommentsByTopic($topic_id) {
        $stmt = $this->db->prepare("SELECT fc.*, u.nama FROM forum_comments fc JOIN users u ON fc.user_id = u.id WHERE fc.topic_id = :topic_id ORDER BY fc.created_at ASC");
        $stmt->execute(['topic_id' => $topic_id]);
        return $stmt->fetchAll();
    }

    public function createTopic($user_id, $judul) {
        $stmt = $this->db->prepare("INSERT INTO forum_topics (user_id, judul) VALUES (:user_id, :judul)");
        return $stmt->execute(['user_id' => $user_id, 'judul' => $judul]);
    }

    public function createComment($topic_id, $user_id, $komentar) {
        $stmt = $this->db->prepare("INSERT INTO forum_comments (topic_id, user_id, komentar) VALUES (:topic_id, :user_id, :komentar)");
        return $stmt->execute(['topic_id' => $topic_id, 'user_id' => $user_id, 'komentar' => $komentar]);
    }

    public function deleteTopic($id) {
        $stmt = $this->db->prepare("DELETE FROM forum_topics WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function deleteComment($id) {
        $stmt = $this->db->prepare("DELETE FROM forum_comments WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getCommentById($id) {
        $stmt = $this->db->prepare("SELECT * FROM forum_comments WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
}
