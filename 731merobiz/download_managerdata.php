<?php
session_start();
include('include/connection.php');
include('include/top.php');

if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    // Fetch area manager details based on the provided ID
    $query = "SELECT * FROM managerdata WHERE d_id = :d_id AND status = 'Active'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':d_id', $d_id);
    $stmt->execute();
    $managerdata = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch country, state, city, and street details
    $country_id = $managerdata['province'];
    $state_id = $managerdata['district'];
    $city_id = $managerdata['municipality'];
    $totalpoints = $managerdata['totalpoints'];

    $query = "SELECT * FROM country WHERE id = :country_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':country_id', $country_id);
    $stmt->execute();
    $countryname = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM state WHERE id = :state_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':state_id', $state_id);
    $stmt->execute();
    $statename = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM city WHERE id = :city_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':city_id', $city_id);
    $stmt->execute();
    $cityname = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM managerdata WHERE totalpoints = :totalpoints";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':totalpoints', $totalpoints);
    $stmt->execute();
    $totalpoints = $stmt->fetch(PDO::FETCH_ASSOC);

    // Prepare the data for CSV
    $data = [
        $managerdata['managerdata_name'],
        $managerdata['username'],
        $managerdata['mobilenumber'],
        $countryname['name'] . ' / ' . $statename['name'] . ' / ' . $cityname['name'],
        $managerdata['wardno'],
        $totalpoints['totalpoints'],
        $managerdata['latitude'],
        $managerdata['longitude'],
        $managerdata['province'],
        $managerdata['district'],
        $managerdata['municipality']
    ];

    // Generate CSV file
    $filename = 'managerdata.csv';
    $file = fopen('php://temp', 'w');
    fputcsv($file, $data);
    fseek($file, 0);

    // Download the CSV file
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=' . $filename);
    fpassthru($file);
    exit();
} else {
    // If no ID is provided, redirect to the previous page or handle the error accordingly
    header('Location: admindashboard.php');
    exit();
}
?>
