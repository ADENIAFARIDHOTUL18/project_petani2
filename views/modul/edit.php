<?php include '../views/layouts/header.php'; ?>

<body>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
        <div class="content-form">
            <h2>Edit Modul</h2>

            <form method="post" action="index.php?page=modul_update" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
                <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required><br>
                <textarea name="konten" required><?= htmlspecialchars($data['konten']) ?></textarea><br>

                <?php if ($data['file_pdf']): ?>
                    <p>File saat ini:
                        <a href="uploads/<?= htmlspecialchars($data['file_pdf']) ?>" target="_blank"><?= htmlspecialchars($data['file_pdf']) ?></a>
                    </p>
                <?php endif; ?>

                <input type="file" name="file_pdf" accept="application/pdf"><br>
                <button type="submit" class="btn-primary">Update</button>
            </form>

        </div>
    </main>
  </div>
</body>
</html>
