<?php
require "connection.php";

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}

if (isset($_GET['delete_id'])) {
    $stmt = $connection->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $_GET['delete_id']]);
    header("location: profile.php?success=User deleted successfully");
    exit;
}


if (isset($_POST['update-btn'])) {
    $stmt = $connection->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute([
        ':name'  => $_POST['name'],
        ':email' => $_POST['email'],
        ':id'    => $_POST['user_id'],
    ]);
    header("location: profile.php?success=User updated successfully");
    exit;
}
?>