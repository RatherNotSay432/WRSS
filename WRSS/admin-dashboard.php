<?php 
include 'php/db_connect.php';

$query = "SELECT * FROM pending_sellers";
$result = $conn->query($query);
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/admin.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <main>
    <header>
            <div class="logo">WRSS</div>
            <nav>
                <ul>
                    <li><a href="#">Approved</a></li>
                    <li><a href="#">Rejected</a></li>
                    <li><a href="wrss.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div class="admin-container">
        <h2>Pending Seller Registrations</h2>
        <?php if ($error): ?>
            <p style="color: #0099ff; font-weight: bold; text-align: center;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    <table>
        <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Valid ID</th>
            <th>Document</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['user']) ?></td>
            <td><a href="/WRSS/php/<?= htmlspecialchars($row['valid_id']) ?>" target="_blank">View ID</a></td>
            <td><a href="/WRSS/php/<?= htmlspecialchars($row['document']) ?>" target="_blank">View Document</a></td>

            <td>
                <form action="php/approve-seller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="seller_id" value="<?= $row['id'] ?>">
                    <button type="submit" name="approve" class="approve-btn" >Approve</button>
                </form>
                <form action="php/reject-seller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="seller_id" value="<?= $row['id'] ?>">
                    <button type="submit" name="reject" class="reject-btn">Reject</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
        </div>
    </main>
</body>
</html>
