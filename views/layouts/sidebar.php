<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<aside class="sidebar">
  <div class="sidebar-header">
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
      <h1>Halo <?php echo $_SESSION['user']['username']; ?>!</h1>
    <?php else: ?>
      <h1>Halo <?php echo $_SESSION['user']['username']; ?>!</h1>
    <?php endif; ?>
  </div>

  <nav class="sidebar-menu">
    <ul>
      <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <li><a href="index.php?page=dashboard">🏠 Dashboard</a></li>
        <li><a href="index.php?page=register">👤 Register User</a></li>
        <li><a href="index.php?page=modul">📄 Management Modul</a></li>
        <li><a href="index.php?page=aktivitas">📄 Lihat Aktivitas</a></li>
      <?php else: ?>
        <li><a href="index.php?page=aktivitas">📄 Management Aktivitas</a></li>
        <li><a href="index.php?page=modul">📄 Lihat Modul</a></li>
      <?php endif; ?>
        <li><a href="index.php?page=forum">📄 Forum</a></li>
        <li><a href="index.php?page=logout">🔒 Logout</a></li>
    </ul>
  </nav>
</aside>
