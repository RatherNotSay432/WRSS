<?php
include 'db_connect.php';
$error = "";

function strong_password($password) {

    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must include at least one uppercase letter.";
    }

    if (!preg_match('/[a-z]/', $password)) {
        return "Password must include at least one lowercase letter.";
    }

    if (!preg_match('/\d/', $password)) {
        return "Password must include at least one number.";
    }

    if (!preg_match('/[\W_]/', $password)) {
        return "Password must include at least one special character (e.g., !@#$%^&*).";
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $email = $_POST['email'];
    // $user = $_POST['user'];
    // $password = $_POST['password'];
    // $confirmPassword = $_POST['confirm-password'];

    $email = filter_input(INPUT_POST, 'email');
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_SPECIAL_CHARS);

    // check if the fields are empty
    if (empty($email) || empty($user) || empty($password) || empty($confirmPassword)) {
        header("Location: ../buyer-registration.php?error=" . urlencode("There are empty fields. all fields are required!"));
        exit();
    }

     // email format '@gmail.com'
     if (!preg_match('/@gmail\.com$/', $email)) {
        header("Location: ../buyer-registration.php?error=" . urlencode("Email must be a Gmail address (ending with @gmail.com"));
        exit();
    }

    // sanitization of name and email
    if (preg_match('/[^a-zA-Z0-9 ]/', $user) || !preg_match('/^[a-zA-Z0-9._@]+$/', $email)) {
        header("Location: ../buyer-registration.php?error=" . urlencode("Invalid input. The inputted data cannot be accepted!"));
        exit();
    }

    if ($password !== $confirmPassword) {
        header("Location: ../buyer-registration.php?error=" . urlencode("Passwords do not match!"));
        exit();    
    }else{
        $password_check = strong_password($password);
        if($password_check !== true){
            header("Location: ../buyer-registration.php?error=" . urlencode($password_check));
            exit();
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $check_email = "SELECT email FROM buyer_registered WHERE email = ?";
            $stmt_check = $conn->prepare($check_email);
            $stmt_check->bind_param("s", $email);
            $stmt_check->execute();
            $stmt_check->store_result();
    
            if ($stmt_check->num_rows > 0) {
                header("Location: ../buyer-registration.php?error=" . urlencode("Email is already registered!"));
            } else {
                $sql_insert = "INSERT INTO buyer_registered (user, email, password) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
    
                if ($stmt_insert) {
                    $stmt_insert->bind_param("sss", $user ,$email, $hashedPassword);
    
                    if ($stmt_insert->execute()) {
                        header("Location: ../buyer-thankyou.html");
                    } else {
                        $error = "Error: " . $stmt_insert->error;
                    }
    
                    $stmt_insert->close();
                } else {
                    $error = "Error preparing statement: " . $conn->error;
                }
            }
            $stmt_check->close();
            }
        }
  
    }

$conn->close();
?>