<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif (isset($_SESSION["users"][$username])) {
        $error = "That username is already taken.";
    } else {
        $_SESSION["users"][$username] = password_hash($password, PASSWORD_DEFAULT);

        $_SESSION["username"] = $username;

        header("Location: game.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Brain Busters</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <section class="card">
                <h2>Create Your Account</h2>
                <p>Register to start playing Brain Busters - The Puzzle Vault!</p>
                <?php if ($error != ""): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <form action="register.php" method="POST">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" class="button">Create Account</button>

                </form>

                <p>Already have an account? <a href="login.php">Log In</a></p>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
