<?php 
include 'php/db_connect.php';
$error = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/registration.css">
    <script src="javascript/show-password.js" defer></script>
    <title>Buyer | Registration</title>
</head>
<body>
    <main>
    <div class="form-container">
            <form action="php/checkReg-buyer.php" method="POST">
                <h2>Registration</h2>
                <h4>Buyer</h4>
                <div class="form-container">
                    <?php if ($error): ?>
                        <p style="color: #0099ff; font-weight: bold; text-align: center;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Email Adress" required>
                <label for="user">Username</label>
                <input type="text" name="user" id="user" placeholder="Create your username" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Create Password" required>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>
                <div class="show-password">
                    <input type="checkbox" id="showPassword">
                    <label class="show" for="showPassword">Show Password</label>
                </div>
                <button type="submit">Register</button>
                <p>Do you have a water refilling station? Click here to <a href="seller-registration.php">register</a></p>
            <p>Back to <a href="wrss.php">login page</a></p>
            </form>
        </div>
    </main>
</body>
</html>