<?php
session_start();
$title = 'Add Category';
include('include/connection.php');

$successMessage = '';
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btnregister'])) {
        $category_name = $_POST['category_name'];
        $status = $_POST['status'];
        if(empty($category_name)){
            $errorMessage = "Please enter category name.";
        }
        
        // Server-side validation to check if required fields are filled and category name contains only alphabets
        elseif (!empty($category_name) && preg_match('/^[A-Za-z]+(?: [A-Za-z]+)*(?: [A-Za-z]+)?$/',$category_name) && !empty($status)) {
            try {
                // Check if the category name already exists
                $check_query = "SELECT COUNT(*) FROM category WHERE category_name = :category_name";
                $check_stmt = $conn->prepare($check_query);
                $check_stmt->bindParam(':category_name', $category_name);
                $check_stmt->execute();
                $category_count = $check_stmt->fetchColumn();

                if ($category_count > 0) {
                    $errorMessage = "Category already exists.";
                } else {
                    // Insert new category into the database
                    $insert_query = "INSERT INTO category (category_name, status) 
                    VALUES (:category_name, :status)";
                    $stmt = $conn->prepare($insert_query);
                    $stmt->bindParam(':category_name', $category_name);
                    $stmt->bindParam(':status', $status);

                    if ($stmt->execute()) {
                        $successMessage = "Category successfully added.";
                    } else {
                        $errorMessage = "Error adding category.";
                    }
                }
            } catch (PDOException $e) {
                $errorMessage = "Error: " . $e->getMessage();
            }
        } else {
            $errorMessage = "Please enter a name containing only alphabets..";
        
        }
    }
}

include('include/top.php');
include('include/admintop.php');
?>

<div class="container">
    <section class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Add Category</h3>
        </div>
        <form method="POST" class="mx-auto col-10 col-md-8 col-lg-6 form-horizontal col-xl-5 shadow-lg my-1 p-4 m-3">
            <div class="form-row">
                <div class="col-xl-12">
                    <label class="col-sm-12 control-label">Category Name*</label>
                    <div class="col-sm-12 mt-1">
                        <input type="text" class="form-control <?php echo ($errorMessage !== '' || (empty($category_name) && $_SERVER['REQUEST_METHOD'] === 'POST')) ? 'is-invalid' : ''; ?>" name="category_name" <?php if(empty($category_name) && $_SERVER['REQUEST_METHOD'] === 'POST') echo 'placeholder="Enter some values"'; ?>>
                        <?php if (empty($category_name) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                            <div class="invalid-feedback">
                                Please enter a category name.
                            </div>
                        <?php elseif ($errorMessage !== ''): ?>
                            <div class="invalid-feedback">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 form-check ml-4 mt-4">
                    <input class="form-check-input" type="radio" name="status" value="Active" checked required>
                    <label class="form-check-label">
                        Active
                    </label>
                </div>
                <div class="col-sm-3 form-check mt-4">
                    <input class="form-check-input" type="radio" name="status" value="Inactive" required>
                    <label class="form-check-label">
                        Inactive
                    </label>
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
            }, 5000); // 5 seconds
        });
    </script>
<?php elseif ($errorMessage !== '') : ?>

<?php endif; ?>

<?php
include('include/foot.php');
?>

