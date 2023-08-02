<!-- editproduct.php -->
<?php
session_start();
$title = 'Edit Product';
include('include/connection.php');

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnupdate'])) {
    $p_id = $_POST['p_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Server-side validation to check if required fields are filled
    if (!empty($product_name) && !empty($status)) {
        try {
            // Update the product information in the database
            $update_query = "UPDATE product SET product_name = :product_name, price = :price, status = :status, description = :description, category_id = :category_id WHERE p_id = :p_id";
            $stmt = $conn->prepare($update_query);
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':p_id', $p_id);

            if ($stmt->execute()) {
                $successMessage = "Product successfully updated.";
            } else {
                $errorMessage = "Error updating product.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    } else {
        $errorMessage = "Please fill in all required fields.";
    }
}

// Check if a p_id has been provided in the URL
if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    // Get the product information from the database
    $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = ?");
    $stmt->execute([$p_id]);
    $product = $stmt->fetch();

    if (!$product) {
        // Redirect the user back to the product list page if no product found with the provided p_id
        header('Location: listproduct.php');
        exit();
    }
} else {
    // Redirect the user back to the product list page if no p_id was provided
    header('Location: listproduct.php');
    exit();
}

include('include/top.php');
include('include/admintop.php');
?>

<div class="container">
    <section class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Edit Product</h3>
        </div>
        <form method="POST" class="mx-auto col-md-auto col-lg-auto form-horizontal shadow-lg my-1 p-4 m-4 needs-validation" role="form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="p_id" value="<?php echo $product['p_id']; ?>">
            <div class="form-row">
                <div class="col-xl-4">
                    <label for="name" class="control-label ml-3">Select Category*</label>
                    <div class="col-xl-12 mt-1">
                        <select name="category_id" class="border-primary form-select" required>
                            <option value=''>Select Category*</option>
                            <?php
                            $query = "SELECT * FROM category";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                $selected = ($row['category_id'] == $product['category_id']) ? 'selected' : '';
                                echo "<option value='{$row['category_id']}' $selected>{$row['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4">
                    <label for="name" class="control-label">Product Name*</label>
                    <div class="col-xl-12 mt-1">
                        <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                    </div>
                </div>
                <div class="col-xl-4">
                    <label for="name" class="control-label">Price*</label>
                    <div class="col-xl-12 mt-1">
                        <input type="textclass="form-control" name="price" placeholder="Price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                    </div>
                </div>
            </div>
<div class="form-group mt-3">
  <label for="exampleFormControlTextarea1">Description</label>
  <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
</div>


            <div class="row mt-4 ml-2">
                <div class="col-xl-1">
                    <label for="form-control">Status*</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="Active" <?php if ($product['status'] == 'Active') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Active
                        </label>
                    </div>
                </div>
                <div class="col-xl-1">
                    <label for="form-control" style="color:#fff;">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="Inactive" <?php if ($product['status'] == 'Inactive') echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-md" name="btnupdate">
                    Update
                </button>
            </div>
        </form>
    </section>
</div>

<!-- Display success or error toast notification -->
<?php if ($successMessage !== '') : ?>
    <div id="successToast" class="toast position-fixed top-0 mt-4 end-0 p-3 bg-success text-light" style="z-index: 9999">
        <div class="toast-body">
            <?php echo $successMessage; ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toast = new bootstrap.Toast(document.getElementById('successToast'));
            toast.show();
            setTimeout(function() {
                toast.hide();
            }, 3000); // 5 seconds
        });
    </script>
<?php elseif ($errorMessage !== '') : ?>
    <div id="errorToast" class="toast position-fixed top-0 mt-4 end-0 p-3 bg-danger text-white" style="z-index: 9999">
        <div class="toast-body">
            <?php echo $errorMessage; ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toast = new bootstrap.Toast(document.getElementById('errorToast'));
            toast.show();
            setTimeout(function() {
                toast.hide();
            }, 3000); // 5 seconds
        });
    </script>
<?php endif; ?>

<?php
include('include/foot.php');
?>
