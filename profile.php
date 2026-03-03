<?php
require "connection.php";

if (!isset($_SESSION['user_id'])) {
    header("location: login.php?message=You must login first");
    exit;
}

$query = $connection->prepare("SELECT * FROM users");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">All Users</h3>
    <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-3">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success"><?= $_GET['success'] ?></div>
<?php endif; ?>

<div class="row g-4">
<?php foreach ($users as $user): ?>
    <div class="col-md-4">
        <div class="card border-0 bg-body-secondary rounded-4 p-3">

            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                     style="width:48px;height:48px">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                </div>
                <div>
                    <div class="fw-semibold"><?= htmlspecialchars($user['name']) ?></div>
                    <div class="text-body-secondary small"><?= htmlspecialchars($user['email']) ?></div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="render_profile.php?delete_id=<?= $user['id'] ?>"
                   class="btn btn-danger btn-sm rounded-3 flex-grow-1"
                   onclick="return confirm('Delete this user?')">
                    <i class="bi bi-trash"></i> Delete
                </a>
                <button class="btn btn-outline-primary btn-sm rounded-3 flex-grow-1"
                        data-bs-toggle="collapse"
                        data-bs-target="#edit-<?= $user['id'] ?>">
                    <i class="bi bi-pencil"></i> Edit
                </button>
            </div>

            <div class="collapse mt-3" id="edit-<?= $user['id'] ?>">
                <form action="render_profile.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <div class="mb-2">
                        <input type="text" name="name"
                               class="form-control form-control-sm bg-body-tertiary border-0"
                               value="<?= htmlspecialchars($user['name']) ?>" required>
                    </div>
                    <div class="mb-2">
                        <input type="email" name="email"
                               class="form-control form-control-sm bg-body-tertiary border-0"
                               value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="update-btn" class="btn btn-primary btn-sm rounded-3">
                            <i class="bi bi-check-lg"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
<?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>