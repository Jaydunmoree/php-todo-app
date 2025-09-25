<?php
include "config.php";

// Add new task
if (isset($_POST['add'])) {
    $task = $_POST['task'];
    if (!empty($task)) {
        $sql = "INSERT INTO task (task, status) VALUES ('$task', 'Pending')";
        mysqli_query($db, $sql);
    }
}

// Mark task as completed
if (isset($_GET['completed'])) {
    $id = $_GET['completed'];
    $sql = "UPDATE task SET status='Done' WHERE task_id=$id";
    mysqli_query($db, $sql);
}

// Delete task
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM task WHERE task_id=$id";
    mysqli_query($db, $sql);
}

// Fetch tasks
$result = mysqli_query($db, "SELECT * FROM task");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="heading">Todo Application</div>
    </nav>

    <div class="container">
        <form method="POST" class="input-area">
            <input type="text" name="task" placeholder="Enter new task">
            <button type="submit" name="add" class="btn">Add</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="border-bottom">
                        <td><?php echo $row['task']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td class="action">
                            <?php if ($row['status'] !== 'Done') { ?>
                                <a class="btn-completed" href="index.php?completed=<?php echo $row['task_id']; ?>">✔</a>
                            <?php } ?>
                            <a class="btn-remove" href="index.php?delete=<?php echo $row['task_id']; ?>">❌</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
