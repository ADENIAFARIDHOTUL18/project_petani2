<?php include '../views/layouts/header.php'; ?>

<body>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
        <div class="content-form">
            <h2>Input Aktivitas</h2><br>
            <form method="post" action="index.php?page=aktivitas_save" enctype="multipart/form-data">
                <label>Kategori Aktivitas:</label><br>
                <select name="kategori_aktivitas" required>
                    <option value="pembibitan">Pembibitan</option>
                    <option value="pemanenan">Pemanenan</option>
                    <option value="pemupukan">Pemupukan</option>
                    <option value="pruning">Pruning</option>
                </select><br><br>

                <label>Tanggal:</label><br>
                <input type="date" name="tanggal" required><br><br>

                <label>Deskripsi:</label><br>
                <textarea name="deskripsi" required></textarea><br><br>

                <label>Lokasi:</label><br>
                <input type="text" name="lokasi"><br><br>

                <label>Upload Foto (opsional):</label><br>
                <input type="file" name="foto" accept="image/*"><br><br>

                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </main>
  </div>
</body>
</html>

