
<?php include '../views/layouts/header.php'; ?>

<body>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
        <div class="content-form">
            <h2>Edit Aktivitas</h2><br>
            <form method="post" action="index.php?page=aktivitas_update" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">
                <label>Kategori Aktivitas:</label><br>
                <select name="kategori_aktivitas" required>
                    <option value="pembibtan" <?= $data['kategori_aktivitas'] == 'pembibitan' ? 'selected' : '' ?>>Pembibitan</option>
                    <option value="pemanenan" <?= $data['kategori_aktivitas'] == 'pemanenan' ? 'selected' : '' ?>>Pemanenan</option>
                    <option value="pemupukan" <?= $data['kategori_aktivitas'] == 'pemupukan' ? 'selected' : '' ?>>Pemupukan</option>
                    <option value="pruning" <?= $data['kategori_aktivitas'] == 'pruning' ? 'selected' : '' ?>>Pruning</option>
                </select><br><br>
                
                <label>Tanggal:</label><br>
                <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required><br><br>
                
                <label>Deskripsi:</label><br>
                <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']) ?></textarea><br><br>
                
                <label>Lokasi:</label><br>
                <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>"><br><br>

                <label>Ganti Foto (opsional):</label><br>
                <?php if ($data['foto']): ?>
                    <a href="uploads/<?= htmlspecialchars($data['foto']) ?>" target="_blank">
                        <img src="uploads/<?= htmlspecialchars($data['foto']) ?>" width="100"><br>
                    </a>
                <?php endif; ?>
                <input type="file" name="foto"><br><br>

                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </main>
  </div>
</body>
</html>


