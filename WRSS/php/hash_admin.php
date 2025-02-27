<?php
$admin_password = "admin_wrss1930";
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashed_password;
?>