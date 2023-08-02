<!-- edit AreaManager -->
<?php
session_start();
$title = 'Edit AreaManager';
include('include/connection.php');
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $d_id = $_POST['d_id'];
    $managerdata_name = $_POST['managerdata_name'];
    $username = $_POST['username'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $municipality = $_POST['municipality'];
    $wardno = $_POST['wardno'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = $_POST['status'];
    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE managerdata SET managerdata_name = :managerdata_name, username = :username, province = :province, district = :district, municipality = :municipality, wardno = :wardno, mobilenumber = :mobilenumber, email = :email, latitude = :latitude, longitude = :longitude, status = :status WHERE d_id = :d_id");
    // Bind the parameters
    $stmt->bindParam(':managerdata_name', $managerdata_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':province', $province);
    $stmt->bindParam(':district', $district);
    $stmt->bindParam(':municipality', $municipality);
    $stmt->bindParam(':wardno', $wardno);
    $stmt->bindParam(':mobilenumber', $mobilenumber);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':latitude', $latitude);
    $stmt->bindParam(':longitude', $longitude);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':d_id', $d_id);

    if ($stmt->execute()) {
        echo '<div id="success-message" role="alert" style="
        color: #fff;
        background-color: green;
        border-radius: 7px;
        padding: 10px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        white-space: nowrap;
        width: 300px;
        position: fixed;
        top: 96px;
        left: 93%;
        transform: translateX(-50%);
        text-align: center;
        z-index: 9999;
        transition: opacity 0.2s ease-in-out;
      ">Update Successfully.</div>';
    
      echo '<script>
        setTimeout(function() {
          var successMessage = document.getElementById("success-message");
          successMessage.style.opacity = "0";
          setTimeout(function() {
            successMessage.remove();
          }, 200);
        }, 2000);
      </script>';
    } else {
        echo "<script>alert('Failed to update');</script>";
    }
}
// Check if the ID parameter is present in the URL
if (!isset($_GET['d_id'])) {
    header("Location: admindashboard.php");
    exit();
}
// Retrieve the customer ID from the URL query parameters
$d_id = $_GET['d_id'];
// Query the database for the customer data using the ID
$stmt = $conn->prepare("SELECT * FROM managerdata WHERE d_id = :d_id");
$stmt->bindParam(':d_id', $d_id);
$stmt->execute();
$managerdata = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the customer data was found
if (!$managerdata) {
    header("Location: admindashboard.php");
    exit();
}
ob_end_flush(); // flush output buffer and send output to browser
?>
<?php
include('include/top.php');
include('include/admintop.php');
?>
<!-- content start -->
<div class="container-fluid">
<p class="h3 text-black fw-bold" style="margin-left:8%;">Update AreaManager</p>
<form method="post" class="form-horizontal mx-auto col-9 col-md-9 col-lg-9 shadow-lg my-4 p-4 m-4" role="form">
        <input type="hidden" name="d_id" value="<?php echo $managerdata['d_id']; ?>">
<div class="form-row">
<div class="col-md-4 form-group">
            <label for="managerdata_name">Name:</label>
            <input type="text" class="form-control" id="managerdata_name" name="managerdata_name" value="<?php echo $managerdata['managerdata_name']; ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $managerdata['username']; ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $managerdata['email']; ?>">
        </div>

</div>

        <?php
            include('dropdown.php');
        ?>
<div class="form-row">
<div class="col-md-4 form-group">
            <label for="wardno">Ward No:</label>
            <input type="text" class="form-control" id="wardno" name="wardno" value="<?php echo $managerdata['wardno']; ?>">
</div>
        <div class="col-md-4 form-group">
            <label for="username">Street*:</label>
            <input type="text" class="form-control" id="totalpoints" name="totalpoints" value="<?php echo $managerdata['totalpoints']; ?>">
        </div>
        
        <div class="col-md-4 form-group">
            <label for="mobilenumber">Mobile Number:</label>
            <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" value="<?php echo $managerdata['mobilenumber']; ?>">
        </div>
        </div>

        <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">

    <div class="mb-4">
    Status 
            <select class="col-md-4 form-select" id="status" name="status">
            <option value="Pending" <?php if($managerdata['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Process" <?php if($managerdata['status'] == 'Process') echo 'selected'; ?>>Process</option>
                <option value="Active" <?php if($managerdata['status'] == 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if($managerdata['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
            </select>
    </div>


        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="adminareamanageractive.php" class="btn btn-secondary">Cancel</a>
</div>
</div>
  </div>
</form>
</div>
<!-- end content -->
<?php
include('include/foot.php');
?>
