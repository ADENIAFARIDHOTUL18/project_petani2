<?php include '../views/layouts/header.php'; ?>

<body>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
        <div class="content-form">
            <form method="post" action="index.php?page=modul_save" enctype="multipart/form-data">
                <input type="text" name="judul" placeholder="Judul Modul"><br>
                <textarea name="konten" placeholder="Konten Modul"></textarea><br>
                <input type="file" name="file_pdf" accept="application/pdf"><br>
                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </main>
  </div>
</body>
</html>
