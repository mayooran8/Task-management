<?php
include 'db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, deadline=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $description, $deadline, $id);
    $stmt->execute();

    header("Location: index.php");
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Edit Task</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="text" name="title" value="<?= $row['title'] ?>" class="form-control mb-3">
        <textarea name="description" class="form-control mb-3"><?= $row['description'] ?></textarea>
        <input type="date" name="deadline" value="<?= $row['deadline'] ?>" class="form-control mb-3">
        <button type="submit" name="update" class="btn btn-success">Update Task</button>
    </form>
</div>
</body>
</html>
