<?php include '../views/layouts/header.php'; ?>

<body>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
      <div class="content-right">
      <h2>Daftar Modul</h2><br/>
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <p><a href="index.php?page=modul_input"><button class="btn-primary">Tambah Modul</button></a></p>
        <?php endif; ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th style="text-align: left;">No</th>
                    <th>Title Modul</th>
                    <th>Action Modul</th>
                </tr>
            </thead>
            <tbody>

                  <?php $nomor = 1;  
                    foreach ($data as $modul): ?>
                  <tr>
                    <td style="text-align: left;"><?= $nomor++ ?></td>
                    <td><?= htmlspecialchars($modul['judul']) ?></td>
                    <td>
                      <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                          <a href="index.php?page=modul_edit&id=<?= $modul['id'] ?>" class="btn-action btn-edit">Edit</a>
                          <a href="index.php?page=modul_delete&id=<?= $modul['id'] ?>" class="btn-action btn-delete"
                              onclick="return confirm('Yakin ingin menghapus modul ini?')">Hapus</a>
                              
                      <?php endif; ?>
                      <?php if ($modul['file_pdf'] && $_SESSION['user']['role'] !== 'admin'): ?>
                          <a href="uploads/<?= htmlspecialchars($modul['file_pdf']) ?>" class="btn-primary" target="_blank">Download PDF</a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
            </tbody>
        </table>

      </div>
      
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>

      
      let table = new DataTable('#myTable', {
          responsive: true
      });
    </script>
  </div>
</body>
</html>

