<?php
include('include/connection.php');
// Get the district ID from the AJAX request
$district_id = $_GET['state_id'];

// Query the municipalities table for the selected district ID
$stmt = $conn->prepare('SELECT id, name FROM city WHERE state_id = ?');
$stmt->execute([$state_id]);
$city = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the municipalities as JSON data
header('Content-Type: application/json');
echo json_encode($city);
?>