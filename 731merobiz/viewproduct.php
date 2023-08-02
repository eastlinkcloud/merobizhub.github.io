<!-- viewdetailssalespoint -->
<?php
session_start();
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    // Fetch area product details based on the provided ID
    $query = "SELECT * FROM product WHERE p_id = :p_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':p_id', $p_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If no ID is provided, redirect to the previous page or handle the error accordingly
    header('Location: admindashboard.php');
    exit();
}
?>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
     
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-body">
            <h3>Product Details</h3>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Category Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">  <?php
$query = "SELECT * FROM product";
$stmt = $conn->query($query);
$serial = 1; // initialize counter variable

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $category_id = $row['category_id'];
    $category_name = "";
    $query = "SELECT * FROM category WHERE category_id = :category_id";
    $stmt_category = $conn->prepare($query);
    $stmt_category->bindParam(':category_id', $category_id);
    $stmt_category->execute();
    $category = $stmt_category->fetch(PDO::FETCH_ASSOC);
    if ($category) {
        $category_name = $category['category_name'];
    }
    echo "<tr>";
    echo "<td>{$category_name}</td>";
    echo "</tr>";
}
?>
</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Product Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-dark mb-0"><?php echo $product['product_name']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Price</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $product['price']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">(098) 765-4321</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




















<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">CategoryName</th>
      <th scope="col">ProductName</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
                <?php
                    $query = "SELECT * FROM product";
                    $stmt = $conn->query($query);
                    $serial = 1; // initialize counter variable

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $category_id = $row['category_id'];
                        $category_name = "";
                        $query = "SELECT * FROM category WHERE category_id = :category_id";
                        $stmt_category = $conn->prepare($query);
                        $stmt_category->bindParam(':category_id', $category_id);
                        $stmt_category->execute();
                        $category = $stmt_category->fetch(PDO::FETCH_ASSOC);
                        if ($category) {
                            $category_name = $category['category_name'];
                        }
                        echo "<td>{$category_name}</td>";
                    }
                ?>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>







<?php
include('include/foot.php');
?>
