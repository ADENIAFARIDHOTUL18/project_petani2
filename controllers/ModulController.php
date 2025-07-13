
<?php
require_once dirname(__DIR__) . '/models/Modul.php';
require_once dirname(__DIR__) . '/models/User.php';

class ModulController {
    private $modul;

    public function __construct($pdo) {
        $this->modul = new Modul($pdo);
    }

    public function listModul() {
        $data = $this->modul->getAll();
        include dirname(__DIR__) . '/views/modul/list.php';
    }

    public function inputModul() {
        include dirname(__DIR__) . '/views/modul/input.php';
    }

    public function saveModul() {
        $file_pdf = null;
    
        if (!empty($_FILES['file_pdf']['name'])) {
            $target_dir = dirname(__DIR__) . '/public/uploads/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
    
            $fileName = basename($_FILES["file_pdf"]["name"]);
            $target_file = $target_dir . $fileName;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            if ($fileType != "pdf") {
                die("Hanya file PDF yang diperbolehkan.");
            }
    
            if (move_uploaded_file($_FILES["file_pdf"]["tmp_name"], $target_file)) {
                $file_pdf = $fileName;
            } else {
                die("Gagal mengupload file.");
            }
        }
    
        // Simpan ke database, jika $file_pdf null maka akan masuk NULL ke kolom
        $this->modul->create($_POST['judul'], $_POST['konten'], $file_pdf);
    
        header('Location: index.php?page=modul');
    }
    
    

    public function editModul() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID modul tidak ditemukan.";
            exit;
        }
        $data = $this->modul->getById($id);
        if (!$data) {
            echo "Modul tidak ditemukan.";
            exit;
        }
        include dirname(__DIR__) . '/views/modul/edit.php';
    }
    
    public function updateModul() {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            echo "ID modul tidak ditemukan.";
            exit;
        }
    
        $modul = $this->modul->getById($id);
        $file_pdf = $modul['file_pdf']; // default: file lama
    
        if (!empty($_FILES['file_pdf']['name'])) {
            $target_dir = dirname(__DIR__) . '/public/uploads/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
    
            $fileName = basename($_FILES["file_pdf"]["name"]);
            $target_file = $target_dir . $fileName;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            if ($fileType != "pdf") {
                die("Hanya file PDF yang diperbolehkan.");
            }
    
            if (move_uploaded_file($_FILES["file_pdf"]["tmp_name"], $target_file)) {
                // Hapus file lama jika ada dan bukan null
                if ($modul['file_pdf'] && file_exists($target_dir . $modul['file_pdf'])) {
                    unlink($target_dir . $modul['file_pdf']);
                }
    
                $file_pdf = $fileName; // simpan nama file baru
            } else {
                die("Gagal mengupload file.");
            }
        }
    
        $this->modul->update($id, $_POST['judul'], $_POST['konten'], $file_pdf);
        header('Location: index.php?page=modul');
    }
    
    
    public function deleteModul() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID modul tidak ditemukan.";
            exit;
        }
        $this->modul->delete($id);
        header('Location: index.php?page=modul');
    }
    
}
