<?php
session_start();
include('include/connection.php');
// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION['username'])) {
    if (isset($_POST['submit'])) {
        // Code for login processing
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        try {
            // Prepare and execute the query to check if the username exists in admin_info table
            $queryAdmin = "SELECT * FROM admin_info WHERE username=:username";
            $stmtAdmin = $conn->prepare($queryAdmin);
            $stmtAdmin->bindValue(':username', $username, PDO::PARAM_STR);
            $stmtAdmin->execute();

            // Prepare and execute the query to check if the username exists in managerdata table
            $queryManager = "SELECT * FROM managerdata WHERE username=:username";
            $stmtManager = $conn->prepare($queryManager);
            $stmtManager->bindValue(':username', $username, PDO::PARAM_STR);
            $stmtManager->execute();

            // Prepare and execute the query to check if the username exists in salesmanager table
            $querySalesManager = "SELECT * FROM salesmanager WHERE username=:username";
            $stmtSalesManager = $conn->prepare($querySalesManager);
            $stmtSalesManager->bindValue(':username', $username, PDO::PARAM_STR);
            $stmtSalesManager->execute();

            if ($stmtAdmin->rowCount() > 0) {
                $row = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
                if ($password === $row['password']) {
                    // Password matches
                    // Store username and user_type in session variables
                    $_SESSION['username'] = $username;
                    $_SESSION['user_type'] = 'admin';

                    // Redirect to admin dashboard
                    header("Location: admindashboard.php");
                    exit();
                }
            } elseif ($stmtManager->rowCount() > 0) {
                $row = $stmtManager->fetch(PDO::FETCH_ASSOC);
                if ($password === $row['password']) {
                    // Password matches
                    // Store username and user_type in session variables
                    $_SESSION['username'] = $username;
                    $_SESSION['user_type'] = 'areamanager';
                    $_SESSION['myuser'] = $row['d_id']; // Set the d_id in session

                    // Redirect to area manager dashboard
                    header("Location: areamanagerdashboard.php");
                    exit();
                }
            } elseif ($stmtSalesManager->rowCount() > 0) {
                $row = $stmtSalesManager->fetch(PDO::FETCH_ASSOC);
                if ($password === $row['password']) {
                    // Password matches
                    // Store username and user_type in session variables
                    $_SESSION['username'] = $username;
                    $_SESSION['user_type'] = 'salesmanager';
                    $_SESSION['myuser'] = $row['salesmanager_id']; // Set the salesmanager_id in session
                    // Redirect to sales manager dashboard
                    header("Location: salesdashboard.php");
                    exit();
                }
            }

            // If username is not found or password does not match
            $login_error = "Invalid username or password";

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }
    include('login_form.php');
    exit();
} else {
    // Include the appropriate dashboard based on user type when the user is logged in
    if ($_SESSION['user_type'] == 'admin') {
        header("Location: admindashboard.php");
        exit();
    } else if ($_SESSION['user_type'] == 'areamanager') {
        header("Location: areamanagerdashboard.php");
        exit();
    } else if ($_SESSION['user_type'] == 'salesmanager') {
        header("Location: salesdashboard.php");
        exit();
    }
}
?>
