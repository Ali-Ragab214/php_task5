<?php
require "index.php";

$message = "";

if (isset($_POST['create-btn'])) {
    $data = [
        'name'     => $_POST['name'],
        'email'    => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ];
    $result = $database->create("users", $data);
    $message = $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
</head>
<body>
<?php require "bootstrabCss.php"; ?>

<div class="container mt-5" style="max-width:500px">
    <h2 class="mb-4">Add New User</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="create-btn" class="btn btn-success">Create</button>
        <a href="allusers.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require "bootstrabJs.php"; ?>
</body>
</html>