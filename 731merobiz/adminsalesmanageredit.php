<!-- edit salesmanager -->
<?php
session_start();
$title = 'Edit SalesPoint';
include('include/connection.php');
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the updated information from the form
    $salesmanager_id = $_POST['salesmanager_id'];
    $username = $_POST['username'];
    $salesmanager_name = $_POST['salesmanager_name'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $municipality = $_POST['municipality'];
    $wardno = $_POST['wardno'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $totalpoints = $_POST['totalpoints'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = $_POST['status'];

    // Update the SalesManager information in the database
    $stmt = $conn->prepare("UPDATE salesmanager SET username = ?, salesmanager_name = ?, wardno = ?, mobilenumber = ?, email = ?, totalpoints = ?, status = ? WHERE salesmanager_id = ?");
    $stmt->execute([$username, $salesmanager_name, $wardno, $mobilenumber, $email, $totalpoints, $status, $salesmanager_id]);

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Update successful');</script>";
    } else {
        echo "<script>alert('Failed to update');</script>";
    }

    // Redirect the user back to the SalesManager list page
    header('Location: adminsalesmanageractive.php');
    exit;
}

// Check if an ID has been provided in the URL
if (isset($_GET['salesmanager_id'])) {
    $salesmanager_id = $_GET['salesmanager_id'];

    // Get the SalesManager information from the database
    $stmt = $conn->prepare("SELECT * FROM salesmanager WHERE salesmanager_id = ?");
    $stmt->execute([$salesmanager_id]);
    $salesmanager = $stmt->fetch();

    if (!$salesmanager) {
        // Redirect the user back to the SalesManager list page if the ID doesn't exist
        header('Location: admindashboard.php');
        exit();
    }
} else {
    // Redirect the user back to the SalesManager list page if no ID was provided
    header('Location: admindashboard.php');
    exit();
}
include('include/top.php');
include('include/admintop.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <p class="h3 text-black fw-bold" style="margin-left: 8%;">Update SalesPoint</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal mx-auto col-9 col-md-9 col-lg-9 shadow-lg my-4 p-4 m-4" role="form">
    <input type="hidden" name="salesmanager_id" value="<?php echo $salesmanager_id; ?>">
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($salesmanager['username']); ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="salesmanager_name">Salesmanager Name:</label>
                <input type="text" class="form-control" name="salesmanager_name" value="<?php echo htmlspecialchars($salesmanager['salesmanager_name']); ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($salesmanager['email']); ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="wardno">Ward No:</label>
                <input type="number" class="form-control" name="wardno" value="<?php echo htmlspecialchars($salesmanager['wardno']); ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="mobilenumber">Mobile Number:</label>
                <input type="text" class="form-control" name="mobilenumber" value="<?php echo htmlspecialchars($salesmanager['mobilenumber']); ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="totalpoints">Street/Tole:</label>
                <input type="text" class="form-control" name="totalpoints" value="<?php echo htmlspecialchars($salesmanager['totalpoints']); ?>">
            </div>
        </div>
        <div class="mb-4">
            <label for="status">Status:</label>
            <select class="col-md-4 form-select" id="status" name="status">
                <option value="Pending" <?php if ($salesmanager['status'] === 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Process" <?php if ($salesmanager['status'] === 'Process') echo 'selected'; ?>>Process</option>
                <option value="Active" <?php if ($salesmanager['status'] === 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if ($salesmanager['status'] === 'Inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary" value="submit" name="submit">Save Changes</button>
            <a href="adminsalesmanageractive.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

<?php include('include/foot.php'); ?>
