<?php
session_start();
$title = 'Add Category';
include('include/connection.php');

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnregister'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    // Server-side validation to check if required fields are filled
    if (!empty($product_name) && !empty($status) && !empty($price) && !empty($category_id)) {
        // Check if the product name already exists
        $check_query = "SELECT COUNT(*) FROM product WHERE product_name = :product_name";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':product_name', $product_name);
        $check_stmt->execute();
        $product_count = $check_stmt->fetchColumn();

        if ($product_count > 0) {
            $errorMessage = "Product already exists.";
        } else {
            try {
                // Insert new product into the database
                $insert_query = "INSERT INTO product (product_name, price, status, description, category_id) 
                VALUES (:product_name, :price, :status, :description, :category_id)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bindParam(':product_name', $product_name);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':category_id', $category_id);

                if ($stmt->execute()) {
                    $successMessage = "Product successfully added.";
                } else {
                    $errorMessage = "Error adding product.";
                }
            } catch (PDOException $e) {
                $errorMessage = "Error: " . $e->getMessage();
            }
        }
    } else {
        $errorMessage = "Please fill in all required fields.";
    }
}         

include('include/top.php');
include('include/admintop.php');
?>



<div class="container">
    <section class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Add Product</h3>
        </div>
        <form method="POST" class="mx-auto col-md-auto col-lg-auto form-horizontal shadow-lg my-1 p-4 m-4 needs-validation" novalidate>
            <div class="form-row">
                <div class="col-xl-4">
                    <label for="validationCustom01" class="control-label ml-3">Select Category*</label>
                    <div class="col-xl-12 mt-1">
                        <select name="category_id" id="validationCustom01" class="form-select <?php echo $errorMessage !== '' ? 'is-invalid' : ''; ?>" required>
                            <option value=''>Select Category*</option>
                            <?php
                            $query = "SELECT * FROM category WHERE status='Active'";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {
                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                            ?>
                        </select>
                        <?php if ($errorMessage !== ''): ?>
                            <div class="invalid-feedback">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-4">
                    <label for="validationCustom02" class="control-label">Product Name*</label>
                    <div class="col-xl-12 mt-1">
                        <input type="text" id="validationCustom02" class="form-control <?php echo $errorMessage !== '' ? 'is-invalid' : ''; ?>" name="product_name" placeholder="Product Name" required>
                        <?php if ($errorMessage !== ''): ?>
                            <div class="invalid-feedback">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-4">
                    <label for="validationCustom03" class="control-label">Price*</label>
                    <div class="col-xl-12 mt-1">
                        <input type="text" id="validationCustom03" class="form-control <?php echo $errorMessage !== '' ? 'is-invalid' : ''; ?>" name="price" placeholder="Price" required>
                        <?php if ($errorMessage !== ''): ?>
                            <div class="invalid-feedback">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>
            <div class="row mt-4 ml-2">
                <div class="col-xl-1">
                    <label for="form-control">Status*</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="Active" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Active
                        </label>
                    </div>
                </div>
                <div class="col-xl-1">
                    <label for="form-control" style="color:#fff;">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="Inactive" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-md" name="btnregister">
                    Submit
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
