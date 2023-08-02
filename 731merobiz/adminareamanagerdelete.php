<?php
session_start();
include('include/connection.php');

if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    // Validate and sanitize input
    if (!is_numeric($d_id)) {
        $_SESSION['error_message'] = 'Invalid sales manager ID!';
        header('Location: adminareamanageractive.php');
        exit();
    }

    // Delete areamanager from database
    $delete_query = "DELETE FROM managerdata WHERE d_id=:d_id";
    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(':d_id', $d_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = 'Sales manager deleted successfully!';
        header('Location: adminareamanageractive.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Error deleting sales manager!';
        header('Location: adminareamanageractive.php');
        exit();
    }
} else {
    $_SESSION['error_message'] = 'Invalid request!';
    header('Location: adminareamanageractive.php');
    exit();
}
?>
