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
include('include/top.php');
include('include/salestop.php');
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
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead style="font-size:15px; padding:0px; color: #fff; background-color: blue; color: #fff;">
        <tr>
            <th>S.No.</th>
            <th>Username</th>
            <th>Sales Manager</th>
            <th>Mobile_Number</th>
            <th>Email</th>
            <th>Address
                <p style="font-size: 10px; display: block;">Province/District/<br>Municipality/wardno</p>
            </th>
            <th>Location
            <p style="font-size: 10px; display: block;">Latitude/Longitude</p></th>
            <th>TotalPoint</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        $query = "SELECT * FROM salesmanager WHERE d_id=$_SESSION[myuser] AND DATE(created_at) = CURDATE()  ORDER BY salesmanager_id ASC";
        $stmt = $conn->query($query);
        $serial = 1; // initialize counter variable
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr class='tr-shadow'>";
            echo "<td>$serial</td>"; 
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['salesmanager_name']}</td>";
            echo "<td class='desc'>{$row['mobilenumber']}</td>";
            echo "<td><span class='block-email text-primary'>{$row['email']}</span></td>";
            echo "<td class='wardno'>{$row['province']} / {$row['district']} / {$row['municipality']} / {$row['wardno']}</td>";
            echo "<td class='text-dark'>{$row['latitude']}/ {$row['longitude']}</td>";
            echo "<td class='text-dark'>{$row['totalpoints']}</td>";
            echo "<td class='text-success'>{$row['status']}</td>";
            echo "<td><a class='col item btn btn-primary btn-sm text-light' href='editsales.php?salesmanager_id=" . $row['salesmanager_id'] . "' style='font-size:8px;font-weight:bold;'>Edit</a>
            <a class='col item btn btn-danger btn-sm text-light' href='deletesales.php?salesmanager_id=" . $row['salesmanager_id'] . "' style='font-size:8px;font-weight:bold;' onclick='return confirmDelete()'>Delete</a>
 
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
                <!-- /.container-fluid -->
<?php
include('include/foot');
?>