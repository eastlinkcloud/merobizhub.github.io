<?php
session_start();
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');
?>

<!-- content start -->
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
                        <th>AreaManagerName</th>
                        <th>MobileNumber</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>wardno</th>
                        <th>Street*</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = "SELECT * FROM managerdata WHERE status='Active'";
                    $stmt = $conn->query($query);
                    $serial = 1; // initialize counter variable
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='tr-shadow'>";
                        echo "<td>$serial</td>";
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['managerdata_name']}</td>";
                        echo "<td class='desc'>{$row['mobilenumber']}</td>";
                        echo "<td><span class='block-email text-primary'>{$row['email']}</span></td>";
                        echo "<td class='wardno'>{$row['province']} / {$row['district']} / {$row['municipality']}</td>";
                        echo "<td class='text-dark'>{$row['wardno']}</td>";
                        echo "<td class='text-dark'>{$row['totalpoints']}</td>";
                        echo "<td class='text-dark'>{$row['latitude']} {$row['longitude']}</td>";
                        echo "<td class='text-success'>{$row['status']}</td>";
echo "<td>
                        <a class='col item btn btn-info btn-sm text-light' href='adminareamanageredit.php?d_id=" . $row['d_id'] . "' style='font-size:8px;'>Edit</a>
                        <a class='col btn btn-danger btn-sm text-light' href='adminareamanagerdelete.php?d_id=" . $row['d_id'] . "' style='font-size:8px;font-weight:bold;' onclick='return confirmDelete()'>Delete</a>
                        <a class='col btn btn-primary btn-sm text-light' href='viewdetails.php?d_id=" . $row['d_id'] . "' style='font-size:8px;font-weight:bold;'>View</a>
                        <a class='col btn btn-primary btn-sm text-light' href='viewdetailsarea.php?d_id=" . $row['d_id'] . "' style='font-size:8px;font-weight:bold;'>View Area</a>
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

<!-- Create View Query -->
<?php
// Create a view for the above details
$viewQuery = "CREATE VIEW managerdata_view AS SELECT * FROM managerdata WHERE status='Active'";
$conn->exec($viewQuery);
?>

<!-- End of Main Content -->
<?php
include('include/foot.php');
?>
