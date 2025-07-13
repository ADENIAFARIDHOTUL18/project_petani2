
<body>
<?php include '../views/layouts/header.php'; ?>
  <div class="dashboard">

  <?php include '../views/layouts/sidebar.php'; ?>
    
    <main class="content">
        <div class="content-right">
            <h2><?= htmlspecialchars($topic['judul']) ?></h2><br>
            <hr><br>
            <p>Dibuat oleh <?= htmlspecialchars($topic['nama']) ?> pada <?= date('d F Y H:i', strtotime($topic['created_at'])) ?></p><br>

            <h4>Komentar</h4><br>
            <ul class="comment-list">
                <?php foreach($comments as $comment): ?>
                <li>
                    <span class="user-comment">
                        <strong><?= htmlspecialchars($comment['nama']) ?>
                        </strong> (<?= date('d F Y H:i', strtotime($comment['created_at'])) ?>):
                    </span>
                    <?= nl2br(htmlspecialchars($comment['komentar'])) ?>

                    <?php if ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['id'] == $comment['user_id']): ?>
                        | <a href="index.php?page=forum_delete_comment&id=<?= $comment['id'] ?>" onclick="return confirm('Yakin hapus komentar?')" class="link-delete">Hapus</a>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul><br><br>

            <h4>Tambah Komentar</h4><br>
            <form method="post" action="index.php?page=forum_add_comment">
                <input type="hidden" name="topic_id" value="<?= $topic['id'] ?>">
                <textarea name="komentar" required></textarea><br><br>
                <button type="submit" class="btn-primary">Kirim</button>
            </form>

            <a href="index.php?page=forum" class="btn-secodnary">Kembali ke daftar topik</a>
        </div>
    </main>
</body>
</html>











