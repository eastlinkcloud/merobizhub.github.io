<?php
session_start();
$title = 'Admin Panel';
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
</div>
<!-- content start -->
<div class="row">
  <div class="col-xl-3 ">
    <!-- for AreaManager -->
  <div class="col-xl-11">
    <div class="card border-left-info" style="background:#000099;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col">
                    <div class="font-weight-bold text-white">
                        List AreaManager</div>
                    <div class="h3 mb-0 text-white">
                <!-- total area manager -->
                <?php
                    $query = "SELECT * FROM managerdata";
                    $stmt = $conn->query($query);
                    $total_rows = $stmt->rowCount(); // get total number of rows

                    echo "<center style='font-weight:bold;'>$total_rows</center>";

                    $serial = 1; // initialize counter variable

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Rest of the code to display data in HTML table
                    }
                ?>

                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-address-book fa-2x text-white"></i>
                </div>
            </div>
        </div>
      <a href="adminareamanageractive.php" class="ahref text-center text-white">View Details</a>
    </div>
</div>

<!-- salesmanager --> 
<div class="col-xl-11 mt-4">
    <div class="card border-left-info shadow1" style="background:#000099;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-0">
                    <div class="font-weight-bold text-white">
                    List SalesManager</div>
                    <div class="h3 mb-0 text-white">
                <!-- total area manager -->
                <?php
                        $query = "SELECT * FROM salesmanager";
                        $stmt = $conn->query($query);
                        $serial = 1; // initialize counter variable
                        $total_rows = $stmt->rowCount(); // get total number of rows
                        echo "<center style='font-weight:bold;'>$total_rows</center>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // rest of the code to display data in HTML table
                        }
                    ?>

                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-address-book fa-2x text-light"></i>
                </div>
            </div>
        </div>
      <a href="adminsalesmanageractive.php" class="ahref text-white text-center">View Details</a>
    </div>
</div>
<!-- customer -->
<div class="col-xl-11 mt-4">
    <div class="card  border-left-info shadow" style="background:#000099;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-0">
                    <div class="font-weight-bold text-white">
                    List Customers</div>
                    <div class="h3 mb-0 text-white">
                <!-- total area manager -->
                <?php
                        $query = "SELECT * FROM customer";
                        $stmt = $conn->query($query);
                        $serial = 1; // initialize counter variable
                        $total_rows = $stmt->rowCount(); // get total number of rows
                        echo "<center style='font-weight:bold;'>$total_rows</center>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // rest of the code to display data in HTML table
                        }
                    ?>

                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-address-book fa-2x text-white"></i>
                </div>
            </div>
        </div>
      <a href="admincustomeractive.php" class="ahref text-white text-center">View Details</a>
    </div>
</div>
<!-- customer -->
<div class="col-xl-11 mt-4">
    <div class="card border-left-info shadow" style="background:#000099;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-0">
                    <div class="font-weight-bold text-white">
                         Receipt</div>
                    <div class="h3 mb-0 text-white">
                <!-- total area manager -->
                <?php
                        $query = "SELECT * FROM resellerwallet";
                        $stmt = $conn->query($query);
                        $serial = 1; // initialize counter variable
                        $total_rows = $stmt->rowCount(); // get total number of rows
                        echo "<center style='font-weight:bold;'>$total_rows</center>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // rest of the code to display data in HTML table
                        }
                    ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-address-book fa-2x text-white"></i>
                </div>
            </div>
        </div>
      <a href="view_receipt.php" class="ahref text-center text-white" >View Details</a>
    </div>
</div>

  </div>
  <div class="col-sm-9">
                        <div class="row m-0">
                        <div class="col-sm-3">
                        <div class="card " style="background: rgb(15, 108, 102);">
                          <div class="card-body">
                            <p class="m-0 survey-head text-white">Today's Customers</p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                              <div>
                                <h3 class="m-0 survey-value text-white">
                                <?php
                                                  $query = "SELECT COUNT(*) AS total_customers
                                                          FROM customer
                                                          WHERE DATE(created_at) = CURDATE()"; // Retrieve only today's data
                                                  $stmt = $conn->prepare($query);
                                                 
                                                  $stmt->execute();
      
                                                  if ($stmt->rowCount() > 0) {
                                                      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                      $total_customers = $row['total_customers'];
                                                      echo "<center style='font-weight:bold; text-white'>$total_customers</center>";
                                                  } else {
                                                      echo "<center style='font-weight:bold;'>No customers added today</center>";
                                                  }
                                              ?>
                                </h3>
                                <a href="admintodaycustomer.php"><p class="text-white m-0">view all</p></a>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill text-white" viewBox="0 0 16 16">
  <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
</svg>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="card" style="background:rgb(15, 108, 102);">
                          <div class="card-body">
                            <p class="m-0 survey-head text-white">Pending Customers</p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                              <div>
                                <h3 class="m-0 survey-value text-white">
                                <?php
$query = "SELECT * FROM customer WHERE status='Pending'";
$stmt = $conn->query($query);
$total_rows = $stmt->rowCount(); // get total number of rows

echo "<center style='font-weight:bold;'>$total_rows</center>";

$serial = 1; // initialize counter variable

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  // Rest of the code to display data in HTML table
}
?>
                                </h3>
                                <a href="admincustomerpending.php"><p class="text-white m-0">view all</p></a>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill  text-white" viewBox="0 0 16 16">
  <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
</svg>
                            </div>
                          </div>
                        </div>
                      </div>
<div class="col-sm-3">
                        <div class="card" style="background:rgb(15, 108, 102);">
                          <div class="card-body">
                            <p class="m-0 survey-head text-white">Process Customers</p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                              <div>
                                <h3 class="m-0 survey-value text-white">
                                <?php
$query = "SELECT * FROM customer WHERE status='Process'";
$stmt = $conn->query($query);
$total_rows = $stmt->rowCount(); // get total number of rows

echo "<center style='font-weight:bold;'>$total_rows</center>";

$serial = 1; // initialize counter variable

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  // Rest of the code to display data in HTML table
}
?>
     
                                </h3>
                                <a href="admincustomerprocess.php"><p class="text-white m-0">view all</p></a>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill  text-light" viewBox="0 0 16 16">
  <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
</svg>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="card" style="background:rgb(15, 108, 102);">
                          <div class="card-body">
                            <p class="m-0 survey-head text-white">Refer</p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                              <div>
                                <h3 class="m-0 survey-value text-white">
                                <?php
$query = "SELECT * FROM refer";
$stmt = $conn->query($query);
$total_rows = $stmt->rowCount(); // get total number of rows

echo "<center style='font-weight:bold;'>$total_rows</center>";

$serial = 1; // initialize counter variable

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  // Rest of the code to display data in HTML table
}
?>
                                </h3>
                                <a href="view_referrals.php"><p class="text-white m-0">view all</p></a>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line-fill  text-white" viewBox="0 0 16 16">
  <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
</svg>
                            </div>
                          </div>
                        </div>
                      </div>
    </div>

    <div class="row m-0 mt-4">
        <div class="col-xl-7 col-lg-6">
        <div class="card shadow">
    <!-- Card Header - Dropdown -->
    <!-- Card Body -->
    <div class="card-body">
        <canvas id="trafficChart">
 
        </canvas>
    </div>
</div>
<!-- Initialize the chart component -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById("trafficChart").getContext("2d");
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: "Progress Bar ",
                        data: [19, 21, 22, 26, 29, 28, 30],
                        backgroundColor: "rgba(63, 81, 181, 0.7)"
                        
                    }
                ]
            },
            options: {}
        });
    });
</script>
</div>
<!-- barcode -->
<div class="col-xl-5 col-lg-6">
<div class="card">
<img src="img/icon/Payment.png" alt="" width="350" height="273">
</div>
</div>
<!-- endbarcode -->
</div>
</div>
</div>
<!-- end content -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include('include/foot.php'); ?>