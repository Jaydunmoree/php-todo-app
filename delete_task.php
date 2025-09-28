<?php
require_once 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = (int) $_GET['task_id'];
    $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute([':id' => $task_id]);
}

header('Location: index.php');
exit;
?>

