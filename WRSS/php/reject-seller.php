<?php 
include 'db_connect.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reject'])) {
    $sellerId = $_POST['seller_id'];

    $query = "DELETE FROM pending_sellers WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $sellerId);
    
    if ($stmt->execute()) {
        header("Location: ../admin-dashboard.php?error=" . urlencode("Rejected successfully!"));
        exit();
    } else {
        header("Location: ../admin-dashboard.php?error=" . urlencode("Failed to reject!"));
        exit();
    }
}
?>
