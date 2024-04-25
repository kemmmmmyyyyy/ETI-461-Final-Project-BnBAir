<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - BnB Air</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="top-logo">
        <a href="index.php">
            <img src="static/airbnb-logo.png" alt="BnB Air Logo">
        </a>
    </div>
    <div class="signin-container">
    <h2>Sign In</h2>
        <form action="login.php" method="post">
            <?php 
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']); 
            }
            ?>
            <input type="email" placeholder="Email Address" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" class="btn-submit">Sign In</button>
        </form>
    </div>
</body>
</html>
