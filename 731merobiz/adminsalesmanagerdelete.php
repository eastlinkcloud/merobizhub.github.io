<?php
    session_start();
    include('include/connection.php');

    if(isset($_GET['salesmanager_id'])){
        $salesmanager_id = $_GET['salesmanager_id'];

        // Delete salesmanager from database
        $delete_query = "DELETE FROM salesmanager WHERE salesmanager_id=:salesmanager_id";
        $stmt = $conn->prepare($delete_query);
        $stmt->bindParam(':salesmanager_id', $salesmanager_id);
        $stmt->execute();

        if($stmt){
            $_SESSION['success_message'] = 'Sales manager deleted successfully!';
            header('Location: adminsalesmanageractive.php');
            exit();
        }
        else {
            echo "<script>alert('Error deleting sales manager!');</script>";
        }
    }
?>
