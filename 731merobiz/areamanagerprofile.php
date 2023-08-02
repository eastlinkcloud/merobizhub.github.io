<!-- areamanagerprofile.php -->
<?php
session_start();
include('include/connection.php');

    // Retrieve sales manager information
    $stmt = $conn->prepare("SELECT * FROM managerdata WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $managerdata = $stmt->fetch(PDO::FETCH_ASSOC);
include('include/top.php');
?>

<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-4">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body text-center">
            <div class="mt-3 mb-4">
              <img src="profile_images/<?php echo $managerdata['profile_img']; ?>" alt="img/icon/profile-icon.png" class="rounded-circle img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2">Name: <?php echo $managerdata['managerdata_name']; ?></h4>
            <p class="text-success mb-3">@AreaManager</p>
            <div class="justify-content-start text-left" style="padding-left:60px;">
  Contact: <?php echo $managerdata['mobilenumber']; ?><br>
  Email: <?php echo $managerdata['email']; ?><br>
  Address: <?php echo $managerdata['province'], $managerdata['district'], $managerdata['municipality']; ?>
</div>

            <div class="d-flex justify-content-between text-center mt-5 mb-2">
              <div>
                <p class="mb-2 h5">SalesPoint</p>
                <p class="text-muted mb-0">
                  <?php
                  $query = "SELECT * FROM salesmanager WHERE d_id=:d_id AND status='Active'";
                  $stmt = $conn->prepare($query);
                  $stmt->bindParam(':d_id', $_SESSION['myuser']);
                  $stmt->execute();
                  $total_rows = $stmt->rowCount(); // get total number of rows
                  echo "<center style='font-weight:bold; color:blue;'>$total_rows</center>";
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      // rest of the code to display data in HTML table
                  }
                  ?>
                </p>
              </div>
              <div class="px-3">
                <p class="mb-2 h5">Customer</p>
                <p class="text-muted mb-0">
                  <?php
                  $query = "SELECT * FROM area_customer WHERE d_id=:d_id AND status='Active'";
                  $stmt = $conn->prepare($query);
                  $stmt->bindParam(':d_id', $_SESSION['myuser']);
                  $stmt->execute();
                  $total_rows = $stmt->rowCount(); // get total number of rows
                  echo "<center style='font-weight:bold;color:green;'>$total_rows</center>";
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      // rest of the code to display data in HTML table
                  }
                  ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="firstinfo">
  <img src="<?php echo $managerdata['profile_img']; ?>" alt="Profile Image">
  <div class="profileinfo">
    <h1>Name: <?php echo $managerdata['managerdata_name']; ?></h1>
    <h3>Email: <?php echo $managerdata['email']; ?></h3>
    <p class="bio">Contact No: +977 - <?php echo $managerdata['mobilenumber']; ?></p>
  </div>
</div>

<?php
include('include/foot.php');
?>
