<?php
require "index.php";

$id   = (int)$_GET['id'];
$user = $database->show("users", $id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show User</title>
</head>
<body>
<?php require "bootstrabCss.php"; ?>

<div class="container mt-5" style="max-width:500px">
    <h2 class="mb-4">User Details</h2>

    <?php if ($user): ?>
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $user['id'] ?></p>
                <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            </div>
        </div>
    <?php else: ?>
        <p class="text-danger">User not found.</p>
    <?php endif; ?>

    <a href="allusers.php" class="btn btn-secondary mt-3">Back</a>
</div>

<?php require "bootstrabJs.php"; ?>
</body>
</html>