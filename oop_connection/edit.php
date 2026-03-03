<?php
require "index.php";

$id      = (int)$_GET['id'];
$user    = $database->show("users", $id);
$message = "";

if (isset($_POST['update-btn'])) {
    $data = [
        'name'  => $_POST['name'],
        'email' => $_POST['email'],
    ];
    $result  = $database->update("users", $data, $id);
    $message = $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
<?php require "bootstrabCss.php"; ?>

<div class="container mt-5" style="max-width:500px">
    <h2 class="mb-4">Edit User</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                   value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <button type="submit" name="update-btn" class="btn btn-primary">Update</button>
        <a href="allusers.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php require "bootstrabJs.php"; ?>
</body>
</html>