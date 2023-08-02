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
include('include/top.php');
include('include/areatop.php');
?>
 <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <p class="h6 mb-0 text-dark fw-bold"><a href="areamanagerdashboard.php">Home / Dashboard</a></p>
                      
                    </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pending SalesManager</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-2">
                        <div class="card-header py-1">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" cellspacing="0">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>Username</th>
            <th>SalesManager</th>
            <th>MobileNumber</th>
            <th>Email</th>
            <th>Address</th>
            <th>Wardno</th>
            <th>Street*</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        $query = "SELECT * FROM salesmanager WHERE d_id=$_SESSION[myuser] AND status='Pending'  ORDER BY salesmanager_id ASC";
        $stmt = $conn->query($query);
        $serial = 1; // initialize counter variable
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr class='tr-shadow'>";
            echo "<td>$serial</td>"; 
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['salesmanager_name']}</td>";
            echo "<td class='desc'>{$row['mobilenumber']}</td>";
            echo "<td><span class='block-email text-primary'>{$row['email']}</span></td>";
            $country_id = $row['province']; // Assuming 'province' is the column name in 'managerdata' table
            $state_id = $row['district']; // Assuming 'district' is the column name in 'managerdata' table
            $city_id = $row['municipality']; // Assuming 'municipality' is the column name in 'managerdata' table
            
            $countryname = "";
            $statename = "";
            $cityname = "";
        
            // Retrieve country name
            $query = "SELECT * FROM country WHERE id = :country_id";
            $stmt_country = $conn->prepare($query);
            $stmt_country->bindParam(':country_id', $country_id);
            $stmt_country->execute();
            $country = $stmt_country->fetch(PDO::FETCH_ASSOC);
            if ($country) {
                $countryname = $country['name'];
            }
        
            // Retrieve state name
            $query = "SELECT * FROM state WHERE id = :state_id";
            $stmt_state = $conn->prepare($query);
            $stmt_state->bindParam(':state_id', $state_id);
            $stmt_state->execute();
            $state = $stmt_state->fetch(PDO::FETCH_ASSOC);
            if ($state) {
                $statename = $state['name'];
            }
        
            // Retrieve city name
            $query = "SELECT * FROM city WHERE id = :city_id";
            $stmt_city = $conn->prepare($query);
            $stmt_city->bindParam(':city_id', $city_id);
            $stmt_city->execute();
            $city = $stmt_city->fetch(PDO::FETCH_ASSOC);
            if ($city) {
                $cityname = $city['name'];
            }
        
            echo "<td>{$countryname} / {$statename} / {$cityname}</td>";  echo "<td class='text-dark'>{$row['wardno']}</td>";
            echo "<td class='text-dark'>{$row['totalpoints']}</td>";
            echo "<td class='text-dark'>{$row['latitude']} {$row['longitude']}</td>";
            echo "<td class='text-success'>{$row['status']}</td>";
            echo "<td><a class='col item btn btn-primary btn-sm text-light' href='areamanagersalesedit.php?salesmanager_id=" . $row['salesmanager_id'] . "' style='font-size:8px;font-weight:bold;'>Edit</a>
            <a class='col item btn btn-danger btn-sm text-light' href='areamanagersalesdelete.php?salesmanager_id=" . $row['salesmanager_id'] . "' style='font-size:8px;font-weight:bold;' onclick='return confirmDelete()'>Delete</a>

     </td>";
            echo "</tr>";
            $serial++; // increment counter variable
        }
        ?>
        <script>
            function confirmDelete() {
  return confirm("Are you sure you want to delete this record?");
}

        </script>
    </tbody>
</table>

                            </div>
                        </div>
                    </div>

                </div>
              
    <?php
        include('include/foot.php');
    ?>

