<?php
session_start();
include('include/connection.php');
$title = 'sales';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $salesmanager_name = $username; // set salesmanager_name to the username value from session
    $salesmanager_id = $_SESSION['myuser']; // set salesmanager_id to the user_id value from session
} else {
    // Redirect to login page if user is not logged in
    header("location: index.php");
    exit();
}
include('include/top.php');
include('include/salestop.php');
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Referral List</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-2">
        <div class="card-header py-1">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>ReferralName</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>CreatedAt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM refer WHERE salesmanager_id=:salesmanager_id ORDER BY referral_id DESC");
                        $stmt->bindParam(':salesmanager_id', $salesmanager_id);
                        $stmt->execute();
                        $referrals = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $serial = 1; // Initialize the serial counter
                        foreach ($referrals as $refer) : ?>
                            <tr>
                                <td><?php echo $serial; ?></td>
                                <td><?php echo $refer['rname']; ?></td>
                                <?php
                                // Retrieve category name
                                $category_id = $refer['category'];
                                $category_name = "";
                                $query = "SELECT * FROM category WHERE category_id = :category_id";
                                $stmt_category = $conn->prepare($query);
                                $stmt_category->bindParam(':category_id', $category_id);
                                $stmt_category->execute();
                                $category = $stmt_category->fetch(PDO::FETCH_ASSOC);
                                if ($category) {
                                    $category_name = $category['category_name'];
                                }
                                ?>
                                <td><?php echo $category_name; ?></td>
                                <?php
                                // Retrieve product name
                                $product_id = $refer['product'];
                                $product_name = "";
                                $query = "SELECT * FROM product WHERE p_id = :product_id";
                                $stmt_product = $conn->prepare($query);
                                $stmt_product->bindParam(':product_id', $product_id);
                                $stmt_product->execute();
                                $product = $stmt_product->fetch(PDO::FETCH_ASSOC);
                                if ($product) {
                                    $product_name = $product['product_name'];
                                }
                                ?>
                                <td><?php echo $product_name; ?></td>
                                <td>Rs.<?php echo $refer['price']; ?></td>
                                <td><?php echo $refer['rphone']; ?></td>
                                <td><?php echo $refer['address']; ?></td>
                                <td><?php echo $refer['remail']; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($refer['created_at'])); ?></td>
                            </tr>
                            <?php $serial++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('include/foot.php');
?>
