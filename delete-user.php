<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/User.php";
    include "app/Model/Task.php";
    
    if (!isset($_GET['id'])) {
        header("Location: user.php");
        exit();
    }
    $id = $_GET['id'];
    $user = get_user_by_id($conn, $id);

    if ($user == 0) {
        header("Location: user.php");
        exit();
    }

    // First, get all tasks assigned to this user
    $tasks = get_all_tasks_by_id($conn, $id);
    
    // If there are tasks, we need to handle them
    if ($tasks != 0) {
        // Option 1: Delete all tasks assigned to this user
        foreach ($tasks as $task) {
            delete_task($conn, [$task['id']]);
        }
        
        // OR Option 2: Reassign tasks to another user (e.g., admin)
        // You would need to implement this if you prefer reassignment
    }

    // Now we can safely delete the user
    $data = array($id, "employee");
    delete_user($conn, $data);
    $sm = "Deleted Successfully";
    header("Location: user.php?success=$sm");
    exit();

} else { 
    $em = "Vui lòng đăng nhập!";
    header("Location: login.php?error=$em");
    exit();
}
?>