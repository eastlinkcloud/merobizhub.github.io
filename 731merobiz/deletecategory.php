<?php
session_start();
include('include/connection.php');

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Delete customer from database
    $delete_query = "DELETE FROM category WHERE category_id=:category_id";
    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(':category_id', $category_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = ' deleted successfully!';
        header('Location: listcategory.php');
        exit();
    } else {
        echo "<script>alert('Error deleting !');</script>";
    }
}
?>
