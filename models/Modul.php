
<?php
class Modul {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM modul")->fetchAll();
    }

    public function create($judul, $konten, $file_pdf = null) {
        $stmt = $this->db->prepare("INSERT INTO modul (judul, konten, file_pdf) VALUES (:judul, :konten, :file_pdf)");
        return $stmt->execute([
            'judul' => $judul,
            'konten' => $konten,
            'file_pdf' => $file_pdf
        ]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM modul WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function update($id, $judul, $konten, $file_pdf = null) {
        $stmt = $this->db->prepare("UPDATE modul SET judul = :judul, konten = :konten, file_pdf = :file_pdf WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'judul' => $judul,
            'konten' => $konten,
            'file_pdf' => $file_pdf
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM modul WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
}
