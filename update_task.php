<?php
require_once 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = (int) $_GET['task_id'];
    $stmt = $db->prepare("UPDATE tasks SET status = 'Done' WHERE id = :id");
    $stmt->execute([':id' => $task_id]);
}

header('Location: index.php');
exit;
?>


