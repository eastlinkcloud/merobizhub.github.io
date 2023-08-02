<?php
include('include/connection.php');
// Get the province ID from the AJAX request
$country = $_GET['country'];

// Query the districts table for the selected province ID
$stmt = $conn->prepare('SELECT id, name FROM state WHERE country = ?');
$stmt->execute([$country]);
$districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the districts as JSON data
header('Content-Type: application/json');
echo json_encode($state);
?>

