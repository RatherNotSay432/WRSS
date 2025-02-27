<?php

include 'db_connect.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // $user = $_POST['user'];
    // $password = $_POST['password'];

    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    // check if the fields are empty
    if (empty($user) || empty($password)) {
        header("Location: ../wrss.php?error=" . urlencode("All fields are required. Please fill in all fields!"));
            exit();
    }

    //Sanitize the user input
    if (preg_match('/[^a-zA-Z0-9 ]/', $user)) {
        header("Location: ../wrss.php?error=" . urlencode("Invalid input. The provided data is not accepted!"));
            exit();
    }

    $sql_buyer = "SELECT user, password FROM buyer_registered WHERE user = ?";
    $stmt_buyer = $conn->prepare($sql_buyer);
    $stmt_buyer->bind_param("s", $user);
    $stmt_buyer->execute();
    $result_buyer = $stmt_buyer->get_result();

    if ($result_buyer->num_rows > 0) {
        $user = $result_buyer->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            header("Location: ../buyer-homepage.html"); // After mu log in ang buyer
            exit();
        } else {
            header("Location: ../wrss.php?error=" . urlencode("Incorrect password. Please try again!"));
            exit();
        }
    }

    $stmt_buyer->close();

    $sql_seller = "SELECT user, password FROM pending_sellers WHERE user = ?";
    $stmt_seller = $conn->prepare($sql_seller);
    $stmt_seller->bind_param("s", $user);
    $stmt_seller->execute();
    $result_seller = $stmt_seller->get_result();

    if ($result_seller->num_rows > 0) {
        $user = $result_seller->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            header("Location: ../seller-notyetReg.html"); // After mo log in ang seller
            exit();
        } else {
            header("Location: ../wrss.php?error=" . urlencode("Incorrect password. Please try again!"));
            exit();
        }
    }
    $stmt_seller->close();


    $sql_seller = "SELECT user, password FROM seller_registered WHERE user = ?";
    $stmt_seller = $conn->prepare($sql_seller);
    $stmt_seller->bind_param("s", $user);
    $stmt_seller->execute();
    $result_seller = $stmt_seller->get_result();

    if ($result_seller->num_rows > 0) {
        $user = $result_seller->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            header("Location: ../seller-homepage.html"); // After mo log in ang seller
            exit();
        } else {
            header("Location: ../wrss.php?error=" . urlencode("Incorrect password. Please try again!"));
            exit();
        }
    }
    $stmt_seller->close();

    $sql_admin = "SELECT user, password FROM admin_access WHERE user = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param("s", $user);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        $user = $result_admin->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            header("Location: ../admin-dashboard.php"); // After mu log in ang admin
            exit();
        } else {
            header("Location: ../wrss.php?error=" . urlencode("Incorrect password. Please try again!"));
            exit();
        }
    }
    $stmt_admin->close();

    header("Location: ../wrss.php?error=" . urlencode("Email not registered. Please sign up!"));
    exit();

}

$conn->close();
