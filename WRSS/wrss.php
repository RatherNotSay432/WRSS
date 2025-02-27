<?php
    include 'php/db_connect.php';
    $error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/wrss.css">
    <script src="javascript/show-password.js" defer></script>
    <title>Water Refilling Station</title>
</head>
<body>
    <main>
        <header>
            <nav>
                <ul>
                    <li><p class="app">Install the app now, click <a href="">here</a></p></li>
                </ul>
            </nav>
        </header>
        <div class="content">
            <div class="child-content">
                <div class="qoute">
                    <div>
                        <h1>Welcome, Users</h1>
                    </div>
                    <div>
                        <p class="paragraph">At our <strong>water refilling station system (WRSS)</strong>, we believe that clean, refreshing water should be accessible to everyone. Each gallon fill represents not just a commitment to quality, but also a step towards a sustainable future. Together, let's quench our thirst and protect our planet, refill for everyone.</p>
                    </div> 
                </div>
                <div class="form-container">
                    <form action="php/login.php" method="POST"> 
                        <h2>Log in to <span>WRSS</span></h2>
                            <?php if ($error): ?>
                                <p style="color: #0099ff; font-weight: bold; text-align: center;"><?= htmlspecialchars($error) ?></p>
                            <?php endif; ?>
                        <!-- <label for="email">Email:</label>
                        <input type="email" id="email" name="email" autocomplete="email" placeholder="Your Email Address" required> -->
                        <label for="user">Username:</label>
                        <input type="text" id="user" name="user" placeholder="Your username" required>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Your Password">
                        <div class="show-password">
                            <input type="checkbox" id="showPassword">
                            <label class="show" for="showPassword">Show Password</label>
                        </div>
                        <button type="submit">Login</button>
                    </form>
                    <div class="register">
                        <p>You don't have an account yet?</p>
                        <p>Click here to <a href="buyer-registration.php">register</a></p>
                    </div>
                    <div class="register">
                        <p>Do you have a water refilling station?</p>
                        <p>Click here to <a href="seller-registration.php   ">register</a></p>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer-container">
                <div class="foot-1">
                    <h3>Follow us on</h3>
                    <div>
                        <p><a href="">Facebook</a></p>
                        <p><a href="">Instagram</a></p>
                    </div>
                </div>
                <div class="foot-2">
                    <h3>Contact us</h3>
                    <p class="contact">You can email us through this email address <span class="gmail">wrss@gmail.com</span></p>
                </div>
            </div>
        </footer>
    </main>
</body>
</html>
