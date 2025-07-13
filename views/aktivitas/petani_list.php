<body>
<?php include '../views/layouts/header.php'; ?>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
      <div class="content-right">
      <p><a href="index.php?page=aktivitas_input"><button class="btn-primary">Tambah Aktivitas</button></a></p><br>
      <h2>Aktivitas Saya</h2><br/>
      <?php //echo '<pre>'; print_r($data); echo '</pre>'; ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align:left;">Tanggal</th>
                    <th>Nama</th>
                    <th>Kategori Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
                $nomor = 1; 
                foreach ($data as $a): ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td style="text-align:left; width:190px;"><?= date('d F Y', strtotime($a['tanggal'])) ?></td>
                    <td><?= htmlspecialchars($a['nama']) ?></td>
                    <td><?= nl2br(htmlspecialchars($a['kategori_aktivitas'])) ?></td>
                    <td><?= nl2br(htmlspecialchars($a['deskripsi'])) ?></td>
                    <td style="width:200px"><?= nl2br(htmlspecialchars($a['lokasi'])) ?></td>
                    <td>
                    <?php if ($a['foto']): ?>
                        <a href="uploads/<?= htmlspecialchars($a['foto']) ?>" target="_blank">
                            <img src="uploads/<?= htmlspecialchars($a['foto']) ?>" alt="" width="100">
                        </a>
                    <?php endif; ?>
                    </td>
                    <td style="width:300px">
                    <?php if ($_SESSION['user']['id'] == $a['user_id']): ?>
                        <a href="index.php?page=aktivitas_edit&id=<?= $a['id'] ?>" class="btn-action btn-edit">Edit</a>
                        <a href="index.php?page=aktivitas_delete&id=<?= $a['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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











