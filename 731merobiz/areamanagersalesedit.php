<!-- editsales.php -->
<?php
session_start();
include('include/connection.php');
$title = 'Create customer';
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $managerdata_name = $username; // set salesmanager_name to the username value from session
    $d_id = $_SESSION['myuser']; // set salesmanager_id to the user_id value from session
  } else {
    // Redirect to login page if user is not logged in
    header("location: index.php");
    exit();
  }

// Check if the form has been submitted
if(isset($_POST['submit'])) {
    // Get the updated information from the form
    $salesmanager_id = $_POST['salesmanager_id'];
    $username = $_POST['username'];
    $managerdata_name = $_POST['managerdata_name'];
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

    // Update the Salespoint information in the database
    $stmt = $conn->prepare("UPDATE salesmanager SET username = ?,  salesmanager_name = ?, wardno = ?, mobilenumber = ?, email = ?, totalpoints = ?, status = ? WHERE salesmanager_id = ?");
    $stmt->execute([$username, $salesmanager_name, $wardno, $mobilenumber, $email, $totalpoints, $status, $salesmanager_id]);

    // Redirect the user back to the Salespoint list page
    header('Location: areamanagersalesactive.php');
    exit;
}

// Check if an ID has been provided in the URL
if(isset($_GET['salesmanager_id'])) {
    $salesmanager_id = $_GET['salesmanager_id'];

    // Get the Salespoint information from the database
    $stmt = $conn->prepare("SELECT * FROM salesmanager WHERE salesmanager_id = ?");
    $stmt->execute([$salesmanager_id]);
    $salesmanager = $stmt->fetch();
} else {
    // Redirect the user back to the Salespoint list page if no ID was provided
    header('Location: areamanagersalesactive.php');
    exit();
}
include('include/top.php');
include('include/areatop.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <p class="h3 text-black fw-bold" style="margin-left: 12%;">Update SalesPoint</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal mx-auto col-9 col-md-9 col-lg-9 shadow-lg my-4 p-4 m-4" role="form">  
    <input type="hidden" name="salesmanager_id" value="<?php echo $salesmanager_id; ?>">
    <div class="form-row mb-3">
    <div class="col-sm-4">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $salesmanager['username']; ?>">
</div>
<div class="col-sm-4">    
    <label for="salesmanager_name">Salesmanager Name</label>
    <input type="text"  class="form-control" name="salesmanager_name" value="<?php echo $salesmanager['salesmanager_name']; ?>">
</div>
<div class="col-sm-4"><label for="mobilenumber">Mobile Number</label>
<input type="text" class="form-control" name="mobilenumber" value="<?php echo $salesmanager['mobilenumber']; ?>"></div>
    </div>
    <div class="form-row mb-3">
    <div class="col-sm-4"><label for="email">Email</label>
<input type="text" class="form-control" name="email" value="<?php echo $salesmanager['email']; ?>"></div>
    <div class="col-sm-4"><label for="wardno">Ward No</label>
<input type="text" class="form-control" name="wardno" value="<?php echo $salesmanager['wardno']; ?>">
</div>
    <div class="col-sm-4"><label for="totalpoints">Street/Tole</label>
<input type="text" class="form-control" name="totalpoints" value="<?php echo $salesmanager['totalpoints']; ?>"></div>
</div>

<label for="status">Status:</label>
<div class="form-group">
<select class="form-select col-4" id="status" name="status">
<option value="Pending" <?php if($salesmanager['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
    <option value="Process" <?php if($salesmanager['status'] == 'Process') echo 'selected'; ?>>Process</option>
    <option value="Active" <?php if($salesmanager['status'] == 'Active') echo 'selected'; ?>>Active</option>
    <option value="Inactive" <?php if($salesmanager['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
</select>
</div><br>
<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit">Save Changes</button>
        <a href="areamanagersalesactive.php" class="btn btn-secondary btn-sm">Cancel</a>
</form>
</div>

                <!-- /.container-fluid -->

    <?php
        include('include/foot.php');
    ?>
