<?php
include 'db.php';

if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['deadline'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("INSERT INTO tasks (title, description, deadline) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $deadline);
    $stmt->execute();
}

header("Location: index.php");
?>
