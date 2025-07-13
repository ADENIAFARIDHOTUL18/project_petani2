<?php
require_once dirname(__DIR__) . '/models/Aktivitas.php';

class AktivitasController {
    private $aktivitas;

    public function __construct($pdo) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->aktivitas = new Aktivitas($pdo);
    }

    public function listAktivitas() {
   
        if ($_SESSION['user']['role'] === 'admin') {
            $data = $this->aktivitas->getAll();
            include dirname(__DIR__) . '/views/aktivitas/admin_list.php';
        } else {
            $data = $this->aktivitas->getAllByUser($_SESSION['user']['id']);
            include dirname(__DIR__) . '/views/aktivitas/petani_list.php';
        }
    }

    public function inputAktivitas() {

        include dirname(__DIR__) . '/views/aktivitas/input.php';
    }

    public function saveAktivitas() {
        $user_id = $_SESSION['user']['id'];
        $tanggal = $_POST['tanggal'];
        $kategori = $_POST['kategori_aktivitas'];
        $deskripsi = $_POST['deskripsi'];
        $lokasi = $_POST['lokasi'];
    
        // Upload foto jika ada
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $filename = time() . '_' . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $filename);
            $foto = $filename;
        }
    
        $this->aktivitas->create($user_id, $tanggal, $kategori, $deskripsi, $lokasi, $foto);
        header('Location: index.php?page=aktivitas');
    }
    

    public function editAktivitas() {
        $id = $_GET['id'];
        $data = $this->aktivitas->getById($id);
    
        // Cek apakah user pemilik data
        if ($data['user_id'] != $_SESSION['user']['id']) {
            echo "Tidak diizinkan.";
            exit;
        }
    
        include dirname(__DIR__) . '/views/aktivitas/edit.php';
    }
    
    public function updateAktivitas() {
        $id = $_POST['id'];
        $tanggal = $_POST['tanggal'];
        $kategori = $_POST['kategori_aktivitas'];
        $deskripsi = $_POST['deskripsi'];
        $lokasi = $_POST['lokasi'];
        $foto_lama = $_POST['foto_lama'];
    
        $foto = $foto_lama;
    
        // Cek apakah user upload foto baru
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $filename = time() . '_' . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $filename);
            $foto = $filename;
    
            // Opsional: Hapus foto lama jika file ada
            if ($foto_lama && file_exists('uploads/' . $foto_lama)) {
                unlink('uploads/' . $foto_lama);
            }
        }
    
        $this->aktivitas->updateWithFoto($id, $tanggal, $kategori, $deskripsi, $lokasi, $foto);
    
        header('Location: index.php?page=aktivitas');
    }
    
    
    
    public function deleteAktivitas() {
        $id = $_GET['id'];
        $data = $this->aktivitas->getById($id);
    
        if ($data['user_id'] != $_SESSION['user']['id']) {
            echo "Tidak diizinkan.";
            exit;
        }
    
        $this->aktivitas->delete($id);
        header('Location: index.php?page=aktivitas');
    }
    
}
