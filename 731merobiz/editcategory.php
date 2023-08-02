<!-- edit category -->
<?php
session_start();
$title = 'Edit category';
include('include/connection.php');

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the updated information from the form
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $status = $_POST['status'];

    // Update the category information in the database
    $stmt = $conn->prepare("UPDATE category SET category_name = ?, status = ? WHERE category_id = ?");
    $stmt->execute([$category_name, $status, $category_id]);

    // Redirect the user back to the category list page with success message in the URL
    header('Location: editcategory.php?category_id=' . $category_id . '&success=1');
    exit();
}

// Check if an ID has been provided in the URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Get the category information from the database
    $stmt = $conn->prepare("SELECT * FROM category WHERE category_id = ?");
    $stmt->execute([$category_id]);
    $category = $stmt->fetch();

    if (!$category) {
        // Redirect the user back to the category list page if no category found with the provided ID
        header('Location: listcategory.php');
        exit();
    }
} else {
    // Redirect the user back to the category list page if no ID was provided
    header('Location: listcategory.php');
    exit();
}

include('include/top.php');
include('include/admintop.php');
?>
<!-- Display success toast notification -->
<?php if (isset($_GET['success']) && $_GET['success'] == 1) : ?>
    <div id="successToast" class="toast position-fixed text-center top-4 end-0 p-3 bg-success text-white" style="z-index: 9999">
        <div class="toast-body">
        <i class="fas fa-fw fa-chevron-left"></i>  Category successfully updated.
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toast = new bootstrap.Toast(document.getElementById('successToast'));
            toast.show();
            setTimeout(function() {
                toast.hide();
            }, 2000); // 4 seconds
        });
    </script>
<?php endif; ?>
<!-- Begin Page Content -->
<div class="container-fluid mb-4">
    <div class="card shadow mx-auto col-10 col-md-8 col-lg-5">
        <div class="card-body">
            <h4 class="card-title text-center">Update category</h4>
            <hr>
            <form method="post" class="form-horizontal p-4 m-4">
                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Active" <?php if ($category['status'] == 'Active') echo 'selected'; ?>>Active</option>
                        <option value="Inactive" <?php if ($category['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                    <a href="listcategory.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include('include/foot.php');
?>
