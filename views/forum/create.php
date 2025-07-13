
<body>
<?php include '../views/layouts/header.php'; ?>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
        <div class="content-right">
            <h2>Buat Topik Baru</h2><br><br>
            <form method="post" action="index.php?page=forum_create_action">
                <label>Judul Topik:</label><br>
                <input type="text" name="judul" required><br><br>
                <button type="submit" class="btn-primary">Buat</button>
            </form>
        </div>
    </main>
</body>
</html>











