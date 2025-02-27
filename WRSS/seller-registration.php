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
    <title>Seller | Registration</title>
</head>
<body>
    <main>
        <div class="form-container">
            <form action="php/checkReg-seller.php" method="POST" enctype="multipart/form-data">
                <h2>Registration</h2>
                <h4>Seller</h4>
                <?php if ($error): ?>
                        <p style="color: #0099ff; font-weight: bold; text-align: center;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>
                <div class="full-name">
                    <label for="full-name">Full name:</label>
                    <input type="text" name="full-name" id="full-name" placeholder="Enter your full name" required>
                    <p class="note"><span>Ex:</span> Dela Cruz, Juan A.</p>
                </div>
                <div class="insert-image">
                    <label for="valid-id">Insert valid ID:</label>
                    <input type="file" name="valid-id" id="valid-id" required>
                    <p class="note"><span>Note:</span> Insert a valid identification</p>
                    <label for="image">Insert file:</label>
                    <input type="file" name="image" id="image" reaquired>
                    <p class="note"><span>Note:</span> Insert document showing you have a water refilling station</p>
                </div>
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
                <button type="submit" >Register</button>
                <p>You only want to order a gallon of water? Click here to <a href="buyer-registration.php">register</a></p>
                <p style="margin-bottom: 20px;">Back to <a href="wrss.php">login page</a></p>
            </form>
        </div>
    </main>
</body>
</html>

<!-- onclick="location.href='seller-thankyou.html'" -->