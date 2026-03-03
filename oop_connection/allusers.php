<?php

require "index.php";

$allUsers = $database->index("users");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Users</title>
</head>

<body>

    <?php require "bootstrabCss.php"; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-4">All Users</h2>

                <a href="create.php" class="btn btn-success">
                    Add New User
                </a>
            </div>
        </div>

        <div class="row">

            <?php if (!empty($allUsers)): ?>

                <?php foreach ($allUsers as $user): ?>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <?= htmlspecialchars($user['name']) ?>
                                </h5>

                                <p class="card-text">
                                    <strong>Email:</strong>
                                    <?= htmlspecialchars($user['email']) ?>
                                </p>

                            </div>

                            <div class="card-footer bg-white border-top text-center">

                                <a href="show.php?id=<?= (int)$user['id'] ?>"
                                    class="btn btn-sm btn-warning">
                                    Show
                                </a>

                                <a href="edit.php?id=<?= (int)$user['id'] ?>"
                                    class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <a href="delete.php?id=<?= (int)$user['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </a>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">
                    <p class="text-muted text-center">
                        No users found.
                    </p>
                </div>

            <?php endif; ?>

        </div>
    </div>

    <?php require "bootstrabJs.php"; ?>

</body>

</html>