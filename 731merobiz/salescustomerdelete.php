<?php
session_start();
include('include/connection.php');

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Delete customer from database
    $delete_query = "DELETE FROM customer WHERE customer_id=:customer_id";
    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(':customer_id', $customer_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Customer deleted successfully!';
        header('Location: salesdashboard.php');
        exit();
    } else {
        echo "<script>alert('Error deleting customer!');</script>";
    }
}
?>

