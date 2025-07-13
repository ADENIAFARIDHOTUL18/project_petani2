<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="content-header">
    <h1>Dashboard Admin</h1>
    <a href="index.php?page=aktivitas_input" class="btn btn-primary">Tambah Aktivitas</a>
</div>

<div class="card">
    <div class="card-header">
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user']['nama']); ?>!</h2>
    </div>
    <div class="card-body">
        <p>Anda masuk sebagai Admin. Dari sini Anda dapat mengelola semua data aktivitas, modul, forum, dan pengguna.</p>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>