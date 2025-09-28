<?php
require 'config.php'; // config.php must create $db as a PDO instance (Postgres)

/* Add new task */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $task = trim($_POST['task'] ?? '');
    if ($task !== '') {
        $stmt = $db->prepare('INSERT INTO task (task, status) VALUES (:task, :status)');
        $stmt->execute([':task' => $task, ':status' => 'Pending']);
    }
    header('Location: index.php');
    exit;
}

/* Mark task as completed */
if (isset($_GET['completed'])) {
    $id = (int) $_GET['completed'];
    $stmt = $db->prepare('UPDATE task SET status = :status WHERE task_id = :id');
    $stmt->execute([':status' => 'Done', ':id' => $id]);
    header('Location: index.php');
    exit;
}

/* Delete task */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $db->prepare('DELETE FROM task WHERE task_id = :id');
    $stmt->execute([':id' => $id]);
    header('Location: index.php');
    exit;
}

/* Fetch tasks */
$stmt = $db->query('SELECT * FROM task ORDER BY task_id ASC');
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Todo App</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
  <nav>
    <a class="heading" href="#">ToDo App</a>
  </nav>

  <div class="container">
    <div class="input-area">
      <form method="POST" action="index.php">
        <input type="text" name="task" placeholder="write your tasks here..." required />
        <button class="btn" name="add">Add Task</button>
      </form>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Tasks</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($tasks) === 0): ?>
          <tr class="border-bottom"><td colspan="4">No tasks yet.</td></tr>
        <?php else: ?>
          <?php $count = 1; foreach ($tasks as $fetch): ?>
            <tr class="border-bottom">
              <td><?php echo $count++; ?></td>
              <td><?php echo htmlspecialchars($fetch['task'], ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); ?></td>
              <td><?php echo htmlspecialchars($fetch['status'], ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); ?></td>
              <td class="action">
                <?php if ($fetch['status'] !== 'Done'): ?>
                  <a class="btn-completed" href="index.php?completed=<?php echo (int)$fetch['task_id']; ?>">✔</a>
                <?php endif; ?>
                <a class="btn-remove" href="index.php?delete=<?php echo (int)$fetch['task_id']; ?>">❌</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
