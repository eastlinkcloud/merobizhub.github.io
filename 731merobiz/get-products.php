<!-- get-products.php -->
<?php
// Establish database connection
$host = 'localhost';
$db = 'merobizh_sales';
$user = 'merobizh_root';
$password = 'Kniltsae@977';

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get products based on the selected category
$categoryID = $_POST['category'];

$sql = "SELECT p_id, product_name, price FROM product WHERE category_id = :category_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':category_id', $categoryID, PDO::PARAM_INT);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate options for the product dropdown
$options = '<option value="">Select product</option>';
foreach ($products as $product) {
    $productName = htmlspecialchars($product['product_name']);
    $options .= "<option value='{$product['p_id']}'>{$productName}</option>";
}

echo $options;
?>
