<!-- admintop -->
<?php
session_start();
$title = 'Edit Customer';
include('include/connection.php');

// Check if the form has been submitted
if(isset($_POST['submit'])) {
    // Get the updated information from the form
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $wardno = $_POST['wardno'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $streetno = $_POST['streetno'];
    $status = $_POST['status'];

    // Update the Customer information in the database
    $stmt = $conn->prepare("UPDATE areacustomer SET customer_name = ?, mobilenumber = ?, streetno = ?, wardno = ?, email = ?, status = ? WHERE customer_id = ?");
    $stmt->execute([$customer_name, $mobilenumber, $streetno, $wardno, $email, $status, $customer_id]);
// Set a session variable to indicate successful update
$_SESSION['customer_update_success'] = true;
    // Redirect the user back to the Customer list page
    header('Location: areamanagercustomer.php');
    exit;
}

// Check if an ID has been provided in the URL
if(isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Get the Customer information from the database
    $stmt = $conn->prepare("SELECT * FROM areacustomer WHERE customer_id = ?");
    $stmt->execute([$customer_id]);
    $customer = $stmt->fetch();
} else {
    // Redirect the user back to the Customer list page if no ID was provided
    header('Location: areamanagercustomer.php');
    exit();
}

include('include/top.php');
include('include/areatop.php');
?>

<!-- content start -->
<div class="container-fluid">
    <p class="h3 text-black fw-bold" style="margin-left: 8%;">Update Customer</p>
    <form method="post" class="form-horizontal mx-auto col-9 col-md-9 col-lg-9 shadow-lg my-4 p-4 m-4" role="form">
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" class="form-control" name="customer_name" value="<?php echo $customer['customer_name']; ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo $customer['email']; ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="mobilenumber">Contact:</label>
                <input type="text" class="form-control" name="mobilenumber" value="<?php echo $customer['mobilenumber']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5 form-group">
                <label for="wardno">Ward No:</label>
                <input type="text" class="form-control" name="wardno" value="<?php echo $customer['wardno']; ?>">
            </div>
            <div class="col-md-7 form-group">
                <label for="streetno">Street/Tole:</label>
                <input type="text" class="form-control" name="streetno" value="<?php echo $customer['streetno']; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="status">Status:</label>
                <select class="form-select" id="status" name="status">
                    <option value="Pending" <?php if($customer['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Process" <?php if($customer['status'] == 'Process') echo 'selected'; ?>>Process</option>
                    <option value="Active" <?php if($customer['status'] == 'Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if($customer['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
        </div><br>
        <button type="submit" class="btn btn-primary" value="submit" name="submit">Save Changes</button>
        <a href="admincustomeractive.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<!-- /.container-fluid -->

<?php
include('include/foot.php');
?>
