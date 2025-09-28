<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $task = trim($_POST['task']);
    $stmt = $db->prepare("INSERT INTO tasks (task, status) VALUES (:task, 'pending')");
    $stmt->execute([':task' => $task]);
}

header('Location: index.php');
exit;
?>
