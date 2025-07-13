<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        Admin
    <?php else: ?>
        Petani  
    <?php endif; ?>
  </title>
  <link rel="stylesheet" href="././assets/style.css" />
  <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" />
  <link rel="icon" href="././assets/images/favicon.png" type="image/x-icon" />
</head>