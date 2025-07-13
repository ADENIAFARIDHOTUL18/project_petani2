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
        <form method="post" action="index.php?page=login_action" class="login-form">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
