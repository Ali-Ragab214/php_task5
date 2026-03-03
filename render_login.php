<?php
session_start();

require "connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        header("Location: login.php?message=Please fill all fields");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?message=Enter valid email");
        exit;
    }

    try {

        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $data  = $connection->prepare($query);
        $data->execute([':email' => $email]);

        $user = $data->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: profile.php");
            exit;

        } else {

            header("Location: login.php?message=Invalid email or password");
            exit;

        }

    } catch (PDOException $e) {

        header("Location: login.php?message=Something went wrong");
        exit;

    }

} else {

    header("Location: login.php");
    exit;

}