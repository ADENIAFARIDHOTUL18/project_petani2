<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="././assets/images/favicon.png" type="image/x-icon" />
    <title>Login Page</title>
    <link rel="stylesheet" href="././assets/style.css" />
</head>
<body>
    <div class="login-container">
        <form method="post" action="index.php?page=register_action" class="login-form">
            <h2>Register User Baru</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="text" name="nama" placeholder="Nama" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="role" required>
                <option value="petani">Petani</option>
                <option value="admin">Admin</option>
            </select><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

