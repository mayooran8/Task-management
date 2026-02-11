<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Management App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">📋 Task Management</h2>

    <!-- Add Task Form -->
    <div class="card p-4 mb-4">
        <form action="add_task.php" method="POST" onsubmit="return validateForm()">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Task Title">
                </div>
                <div class="col">
                    <input type="date" name="deadline" id="deadline" class="form-control">
                </div>
            </div>
            <textarea name="description" id="description" class="form-control mb-3" placeholder="Task Description"></textarea>
            <button type="submit" class="btn btn-primary w-100">Add Task</button>
        </form>
    </div>

    <!-- Task Table -->
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
        while($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['deadline'] ?></td>
                <td>
                    <?php if($row['status'] == 'Pending'): ?>
                        <a href="complete_task.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Mark Complete</a>
                    <?php else: ?>
                        ✅ Completed
                    <?php endif; ?>
                </td>
                <td>
                    <a href="update_task.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this task?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function validateForm() {
    let title = document.getElementById("title").value.trim();
    let description = document.getElementById("description").value.trim();
    let deadline = document.getElementById("deadline").value.trim();
    if (!title || !description || !deadline) {
        alert("All fields are required!");
        return false;
    }
    return true;
}
</script>

</body>
</html>
