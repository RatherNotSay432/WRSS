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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $fullName = $_POST['full-name'];
    // $email = $_POST['email'];
    // $user = $_POST['user'];
    // $password = $_POST['password'];
    // $confirmPassword = $_POST['confirm-password'];

    $fullName = filter_input(INPUT_POST, 'full-name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email');
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_SPECIAL_CHARS);

     // check if the fields are empty
     if (empty($fullName) || empty($email) || empty($user) || empty($password) || empty($confirmPassword)) {
        header("Location: ../seller-registration.php?error=" . urlencode("There are empty fields. all fields are required!"));
        exit();
    }

     // email format '@gmail.com'
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../seller-registration.php?error=" . urlencode("Invalid email format!"));
        exit();
    }

    // sanitization of name and email
    if (preg_match('/[^a-zA-Z0-9_ \'.,-]/', $fullName) ||  
    preg_match('/[^a-zA-Z0-9_.]/', $user)) {    
        header("Location: ../seller-registration.php?error=" . urlencode("Huy. The inputted data cannot be accepted!"));
        exit();  
}



    if ($password !== $confirmPassword) {
        header("Location: ../seller-registration.php?error=" . urlencode("Passwords do not match!"));
        exit();
    }

    $password_check = strong_password($password);

    if($password_check !== true){
        header("Location: ../seller-registration.php?error=" . urlencode($password_check));
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName1 = basename($_FILES['valid-id']['name']);
    $imagePath1 = $uploadDir . $imageName1;
    if (!move_uploaded_file($_FILES['valid-id']['tmp_name'], $imagePath1)) {
        die("Failed to upload the valid ID.");
    }

    $imageName2 = basename($_FILES['image']['name']);
    $imagePath2 = $uploadDir . $imageName2;
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath2)) {
        die("Failed to upload the document.");
    }

    $check_email = "SELECT email FROM seller_registered WHERE email = ?";
    $stmt_check = $conn->prepare($check_email);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("Location: ../seller-registration.php?error=" . urlencode("Email is already registered!"));
        exit();
    } else {
        $query = "INSERT INTO pending_sellers (full_name, email, user, password, valid_id, document) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssss', $fullName, $email, $user, $hashedPassword, $imagePath1, $imagePath2);

        if ($stmt->execute()) {
            header("Location: ../seller-thankyou.html");
        } else {
            error_log("SQL Error: " . $stmt->error, 3, "errors.log");
            die("Failed to save the data.");
        }
    }

    $stmt_check->close();
}
?>
