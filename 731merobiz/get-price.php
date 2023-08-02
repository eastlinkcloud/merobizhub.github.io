<?php
// Establish database connection
$host = 'localhost';
$db = 'merobizh_sales';
$user = 'merobizh_root';
$password = 'Kniltsae@977';

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve the selected product ID from the AJAX request
$productID = $_POST['product'];

// Retrieve the price from the database based on the selected product ID
$sql = "SELECT price FROM product WHERE p_id = :product_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':product_id', $productID, PDO::PARAM_INT);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($product) {
    $price = $product['price'];
    echo $price;
} else {
    echo 'Price not found';
}
?>
