<?php
class Aktivitas {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAllByUser($user_id) {
        $stmt = $this->db->prepare("SELECT a.*, u.username, u.nama 
            FROM aktivitas a 
            JOIN users u ON u.id = a.user_id 
            WHERE user_id = :user_id ORDER BY tanggal DESC");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    public function getAll() {
        return $this->db->query("
            SELECT a.*, u.username, u.nama 
            FROM aktivitas a 
            JOIN users u ON u.id = a.user_id 
            ORDER BY tanggal DESC
        ")->fetchAll();
    }
    

    public function create($user_id, $tanggal, $kategori, $deskripsi, $lokasi = null, $foto = null) {
        $stmt = $this->db->prepare("
            INSERT INTO aktivitas (user_id, tanggal, kategori_aktivitas, deskripsi, lokasi, foto)
            VALUES (:user_id, :tanggal, :kategori, :deskripsi, :lokasi, :foto)
        ");
        return $stmt->execute([
            'user_id' => $user_id,
            'tanggal' => $tanggal,
            'kategori' => $kategori,
            'deskripsi' => $deskripsi,
            'lokasi' => $lokasi,
            'foto' => $foto
        ]);
    }
    

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM aktivitas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function update($id, $tanggal, $kategori, $deskripsi, $lokasi) {
        $stmt = $this->db->prepare("
            UPDATE aktivitas
            SET tanggal = :tanggal,
                kategori_aktivitas = :kategori,
                deskripsi = :deskripsi,
                lokasi = :lokasi
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'tanggal' => $tanggal,
            'kategori' => $kategori,
            'deskripsi' => $deskripsi,
            'lokasi' => $lokasi
        ]);
    }
    
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM aktivitas WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function updateWithFoto($id, $tanggal, $kategori, $deskripsi, $lokasi, $foto) {
        $stmt = $this->db->prepare("
            UPDATE aktivitas
            SET tanggal = :tanggal,
                kategori_aktivitas = :kategori,
                deskripsi = :deskripsi,
                lokasi = :lokasi,
                foto = :foto
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'tanggal' => $tanggal,
            'kategori' => $kategori,
            'deskripsi' => $deskripsi,
            'lokasi' => $lokasi,
            'foto' => $foto
        ]);
    }
    
    
    
}
