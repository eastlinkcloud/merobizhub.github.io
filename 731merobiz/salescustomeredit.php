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

// Check if the form has been submitted
if(isset($_POST['submit'])) {
    // Get the updated information from the form
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $package_id = $_POST['package_id'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $municipality = $_POST['municipality'];
    $wardno = $_POST['wardno'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = $_POST['status'];

    // Update the Salespoint information in the database
    $stmt = $conn->prepare("UPDATE customer SET customer_name = ?, package_id=?, province = ?, district = ?, municipality = ?, wardno = ?, mobilenumber = ?, email = ?, latitude = ?, longitude = ?, status = ? WHERE customer_id = ?");
    $stmt->execute([$customer_name, $package_id, $province, $district, $municipality, $wardno, $mobilenumber, $email, $latitude, $longitude, $status, $customer_id]);

    // Redirect the user back to the Salespoint list page
    header('Location: salesdashboard.php');
    exit;
}

// Check if an ID has been provided in the URL
if(isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Get the Salespoint information from the database
    $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_id = ?");
    $stmt->execute([$customer_id]);
    $customer = $stmt->fetch();
} else {
    // Redirect the user back to the Salespoint list page if no ID was provided
    header('Location: salesdashboard.php');
    exit();
}
include('include/top.php');
include('include/salestop.php');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Update Customer</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-2">


<form method="post" class="form-horizontal col-sm-5 border rounded border-primary p-3" role="form">
    <h4 style="text-align:center;font-style:italic;">Update Customer Form</h4>
    <hr>      
    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
    <div class="form-group">
    <label for="username">Customer_Name:</label>
    <input type="text" class="form-control" name="customer_name" value="<?php echo $customer['customer_name']; ?>"><br>
</div>
    <label for="salesmanager_name">Package_ID:</label>
    <input type="text"  class="form-control" name="package_id" value="<?php echo $customer['package_id']; ?>"><br>
    <label for="province">Province:</label>
    <input type="text" class="form-control" name="province" value="<?php echo $customer['province']; ?>"><br>
<label for="district">District:</label>
<input type="text" class="form-control" name="district" value="<?php echo $customer['district']; ?>"><br>
<label for="municipality">Municipality:</label>
<input type="text" class="form-control" name="municipality" value="<?php echo $customer['municipality']; ?>"><br>
<label for="wardno">Ward No:</label>
<input type="text" class="form-control" name="wardno" value="<?php echo $customer['wardno']; ?>"><br>
<label for="mobilenumber">Mobile Number:</label>
<input type="text" class="form-control" name="mobilenumber" value="<?php echo $customer['mobilenumber']; ?>"><br>
<label for="email">Email:</label>
<input type="text" class="form-control" name="email" value="<?php echo $customer['email']; ?>"><br>
<label for="latitude">Latitude:</label>
<input type="text" class="form-control" name="latitude" value="<?php echo $customer['latitude']; ?>"><br>
<label for="longitude">Longitude:</label>
<input type="text" class="form-control" name="longitude" value="<?php echo $customer['longitude']; ?>"><br>
<label for="status">Status:</label>


<div class="form-group">
<select class="form-control" id="status" name="status">
    <option value="<?php echo $customer['status']; ?>"><?php echo $customer['status']; ?></option>
</select>
</div><br>
<button type="submit" class="btn btn-primary" value="submit" name="submit">Save Changes</button>
        <a href="salesdashboard.php" class="btn btn-secondary">Cancel</a>
</form>
</form>








                    </div>

                </div>
                <!-- /.container-fluid -->


    <?php
include('include/foot.php');
?>