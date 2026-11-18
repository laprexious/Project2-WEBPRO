<?php
session_start();

$error = "";
// if pass and user match to hash; nav to games
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (isset($_SESSION["users"][$username]) &&
        password_verify($password, $_SESSION["users"][$username])) {

        $_SESSION["username"] = $username;

        header("Location: game.php");
        exit();
    } else {
        $error = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Brain Busters</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <section class="card">
                <h2>Welcome Back!</h2>
                <p>Log in to continue playing Brain Busters.</p>

                <?php if ($error != ""): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <form action="login.php" method="POST">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="button">Log In</button>

                </form>

                <p>Don't have an account? <a href="register.php">Create Account</a></p>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
