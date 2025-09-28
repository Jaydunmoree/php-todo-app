<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Todo List</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <nav>
    <a class="heading" href="#">ToDo App</a>
  </nav>
  <div class="container">
    <div class="input-area">
      <form method="POST" action="add_task.php">
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
        <?php
        require 'config.php';

        $stmt = $db->query("SELECT * FROM task ORDER BY task_id ASC");
        $count = 1;
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
        <tr class="border-bottom">
          <td><?php echo $count++ ?></td>
          <td><?php echo htmlspecialchars($fetch['task']) ?></td>
          <td><?php echo htmlspecialchars($fetch['status']) ?></td>
          <td colspan="2" class="action">
            <?php if ($fetch['status'] != "Done"): ?>
              <a href="update_task.php?task_id=<?php echo (int)$fetch['task_id'] ?>" class="btn-completed">✔</a>
            <?php endif; ?>
            <a href="delete_task.php?task_id=<?php echo (int)$fetch['task_id'] ?>" class="btn-remove">❌</a>
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
