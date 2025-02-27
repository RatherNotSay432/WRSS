<?php 
include 'db_connect.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['approve'])) {
    $sellerId = $_POST['seller_id'];

    // Retrieve seller details
    $query = "SELECT * FROM pending_sellers WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $sellerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $seller = $result->fetch_assoc();

    if ($seller) {
        // Move seller to main table
        $insertQuery = "INSERT INTO seller_registered (full_name, email, user, password, valid_id, document)
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->bind_param("ssssss", $seller['full_name'], $seller['email'], $seller['user'], 
                                $seller['password'], $seller['valid_id'], $seller['document']);
        if ($stmtInsert->execute()) {
            // Delete from pending_sellers
            $deleteQuery = "DELETE FROM pending_sellers WHERE id = ?";
            $stmtDelete = $conn->prepare($deleteQuery);
            $stmtDelete->bind_param("i", $sellerId);
            $stmtDelete->execute();
            header("Location: ../admin-dashboard.php?error=" . urlencode("Approved successfully!"));
        exit();
        }
    }
}
?>
