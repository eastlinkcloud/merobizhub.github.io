<?php
session_start();
include('include/connection.php');

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    // Delete customer from database
    $delete_query = "DELETE FROM product WHERE p_id=:p_id";
    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(':p_id', $p_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = ' deleted successfully!';
        header('Location: listproduct.php');
        exit();
    } else {
        echo "<script>alert('Error deleting !');</script>";
    }
}
?>
