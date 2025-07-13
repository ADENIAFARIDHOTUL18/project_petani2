<header>
    <h1>Dashboard</h1>
</header>
<section>
    <h2>Welcome, <?php echo ($_SESSION['user']['role'] === 'admin') ? 'Admin' : 'Petani'; ?></h2>
</section>