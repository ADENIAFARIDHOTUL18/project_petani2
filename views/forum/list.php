
<body>
<?php include '../views/layouts/header.php'; ?>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
      <div class="content-right">
      <p><a href="index.php?page=forum_create"><button class="btn-primary">+ Buat Topik Baru</button></a></p><br>
      <h2>Forum Diskusi</h2><br/>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th style="text-align: left;">No</th>
                    <th>Forum</th>
                    <th>Pembuat Forum</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
                $nomor = 1; 
                foreach ($topics as $topic): ?>
                <tr>
                    <td style="text-align: left;"><?php echo $nomor++; ?></td>
                    <td>
                        <a href="index.php?page=forum_view&id=<?= $topic['id'] ?>">
                            <?= htmlspecialchars($topic['judul']) ?>
                        </a>
                    </td>
                    <td>
                        oleh <strong><?= htmlspecialchars($topic['nama']) ?></strong> pada <?= date('d F Y H:i', strtotime($topic['created_at'])) ?>
                        
                        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                            | <a href="index.php?page=forum_delete_topic&id=<?= $topic['id'] ?>" onclick="return confirm('Yakin hapus topik?')">Hapus</a>
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











