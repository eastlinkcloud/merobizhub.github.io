<?php
session_start();
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');

if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    // Fetch area manager details based on the provided ID
    $query = "SELECT * FROM managerdata WHERE d_id = :d_id AND status = 'Active'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':d_id', $d_id);
    $stmt->execute();
    $managerdata = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If no ID is provided, redirect to the previous page or handle the error accordingly
    header('Location: admindashboard.php');
    exit();
}
?>

<style>
    /* Custom styling for printing */
    @media print {
        /* Add your custom styles for printing here */
        body * {
            visibility: hidden;
        }

        #printable-content,
        #printable-content * {
            visibility: visible;
        }
    }
</style>

<div id="printable-content">
    <!-- Place your content to be printed here -->
    <div class="container">
        <div class="main-body">
            <!-- Rest of your code from the previous file -->
            <!-- ... -->
        </div>
    </div>
</div>

<script>
    // Automatically trigger the print dialog when the page is loaded
    window.onload = function () {
        window.print();
    };
</script>
