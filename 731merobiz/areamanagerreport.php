<?php
session_start();
include('include/connection.php');
// Retrieve filter values from the form submission or set default values
$category = isset($_POST['category']) ? $_POST['category'] : '';
$province = isset($_POST['province']) ? $_POST['province'] : '';
$district = isset($_POST['district']) ? $_POST['district'] : '';
$municipality = isset($_POST['municipality']) ? $_POST['municipality'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
// Prepare the query based on the filter values
$query = "SELECT c.*, cn.name as province_name, s.name as district_name, m.name as municipality_name
          FROM managerdata c
          LEFT JOIN country cn ON c.province = cn.id
          LEFT JOIN state s ON c.district = s.id
          LEFT JOIN city m ON c.municipality = m.id
          WHERE 1=1";
$params = array();

if (!empty($province)) {
    $query .= " AND cn.name LIKE :province";
    $params[':province'] = '%' . $province . '%';
}

if (!empty($district)) {
    $query .= " AND s.name LIKE :district";
    $params[':district'] = '%' . $district . '%';
}

if (!empty($municipality)) {
    $query .= " AND m.name LIKE :municipality";
    $params[':municipality'] = '%' . $municipality . '%';
}

if (!empty($status)) {
    $query .= " AND c.status LIKE :status";
    $params[':status'] = '%' . $status . '%';
}

if (!empty($start_date) && !empty($end_date)) {
    $query .= " AND c.created_at >= :start_date AND c.created_at < :end_date";
    $params[':start_date'] = date('Y-m-d', strtotime($start_date));
    $params[':end_date'] = date('Y-m-d', strtotime($end_date . '+1 day')); // Adding 1 day to exclude the end date
}

$query .= " ORDER BY c.d_id DESC";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$serial = 1;


$sql = "SELECT * FROM country";
$stmt2 = $conn->prepare($sql);
$stmt2->execute();
$country = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM state";
$stmt2 = $conn->prepare($sql);
$stmt2->execute();
$state = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM city";
$stmt2 = $conn->prepare($sql);
$stmt2->execute();
$city = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Cusotmer Report</title>
<!-- css file -->
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="icon" type="image/png" href="img/icon/merobiz.png">
  <!-- Include necessary CSS -->
  <!-- for export -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
 <body>
<!-- content start -->
<style>

.dataTables_wrapper .dataTables_info {
    clear: both;
    float: left;
    padding-top: 2em;
}

.dataTables_wrapper .dataTables_paginate {
    float: right;
    text-align: right;
    padding-top:2em;
}
    thead{
        background: #fff;
        color: #000;
        font-weight:bolder;
    }
    .dt-buttons{
       margin-left:82%;
        margin-bottom: 1%;
        background: #dfd9d9;
    }
    #example_filter{
        display:none;
    }
    .form-select{
        font-size:13px; 
        font-weight: bold;
        width:150px;
        margin: 2px;
       
    }
    .form-select1{
        font-size:13px; 
        font-weight: bold;
        width:170px;
        margin: 2px;
        border: 1px solid #888;
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
     
    }

    .form-control{
        font-size:15px; 
        font-weight: bold;
        width:156px;
        margin: 2px;
    }
    .btn1{
        width: 100px;
        margin-left: 10px;
        background: green;
        border: 1px solid #fff;
        color: #fff;
    }
    .btn1:hover{
        background: blue;
        color: #fff;
    }
    form{
        background: #dfd9d9;
        font-size: 13px;
        padding:2% 1% 1% 10%;
        height: 96px;
        margin-top: 0px;
        
    }
    table{
        font-size:12px;
        margin:0;
        padding: 0;
    }
    .navbar{
        background:#28304e; 
        color:#fff; 
        border-radius: 0;
        height: 5rem;
        margin-bottom: 0px;
    }
.card{
width: 99.09%;
margin: 0;
padding: 0;
}

</style>

<nav class="navbar navbar-expand-lg">
<a class="sidebar-brand d-flex align-items-center justify-content-center fw-bold " href="admindashboard.php">
                <div class="sidebar-brand-text mx-3"> <img src="img/icon/merobizz.png" alt="" width="7%" ><span style="margin-left:2%;color:#fff;font-weigth:bold;"><i class="fa fa-home"></i> Dashboard</span></div>
</a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item d-sm-none">
                            <a href="admindashboard.php" class="nav-link text-center justify-content-center"><img src="img/icon/merobizz.png" alt="" width="45%"></a>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item  text-white">
                            <a class="nav-link dropdown-toggle text-white" href="#" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline  text-capitalize text-white">admin</span>
                                <img class="img-profile rounded-circle" src="img/icon/profile-icon.png" alt="profile-img" width="32">
                            </a>
                        </li>

                    </ul>
</nav>
<form method="POST">
            <div class="row">
                    <select name="province" id="province" class="form-select">
                        <option value="">Select Province</option>
                        <?php
                        foreach ($country as $countryItem) {
                            $selected = ($province == $countryItem['name']) ? 'selected' : '';
                            echo "<option value='{$countryItem['name']}' $selected>{$countryItem['name']}</option>";
                        }
                        ?>
                    </select>


                    <select name="district" id="district" class="form-select">
                        <option value="">Select district</option>
                        <?php
                        foreach ($state as $stateItem) {
                            $selected = ($district == $stateItem['name']) ? 'selected' : '';
                            echo "<option value='{$stateItem['name']}' $selected>{$stateItem['name']}</option>";
                        }
                        ?>
                    </select>
                    <select name="municipality" id="municipality" class="form-select1">
                        <option value="">Select municipality</option>
                        <?php
                        foreach ($city as $cityItem) {
                            $selected = ($municipality == $cityItem['name']) ? 'selected' : '';
                            echo "<option value='{$cityItem['name']}' $selected>{$cityItem['name']}</option>";
                        }
                        ?>
                    </select>

                    <select class="form-select" id="status" name="status">
                        <option value="" <?php if ($status === '') echo 'selected'; ?>>Select Status</option>
                        <option value="Active" <?php if ($status === 'Active') echo 'selected'; ?>>Active</option>
                        <option value="Pending" <?php if ($status === 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Process" <?php if ($status === 'Process') echo 'selected'; ?>>Process</option>
                        <option value="Inactive" <?php if ($status === 'Inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
                    <input type="date" placeholder="Start Date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date; ?>">

                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date; ?>">

                    <button type="submit" class="btn btn1">Search</button>
            </div>
        </form>
<div class="card shadow">

    <div class="card-body">
<div class="table-responsive">

<table id="example"  class="display nowrap table-bordered">
<h3 style="margin-left: 1%; margin-bottom:-42px; font-weight:bold;">AreaManager List</h3>
                <thead>
                    <tr>
                        <th style="width:20px;text-align:left;">S.No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>Municipality</th>
                        <th>WardNo</th>
                        <th>Street/Tole</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>CreatedAt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='tr-shadow'>";
                        echo "<td>$serial</td>";
                        echo "<td>{$row['managerdata_name']}</td>";
                        echo "<td>{$row['username']}</td>";
                        echo "<td>{$row['province_name']}</td>";
                        echo "<td>{$row['district_name']}</td>";
                        echo "<td>{$row['municipality_name']}</td>";
                        echo "<td>{$row['wardno']}</td>";
                        echo "<td>{$row['totalpoints']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['mobilenumber']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>";
                        echo "</tr>";
                        $serial++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- Footer -->
<footer class="footer sticky-footer mt-4">
                <div class="container">
                    <div class="copyright text-center my-4">
                        <span>Copyright &copy; EASTLINK 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
<!-- script part -->
<script>$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );
} );</script>
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  $('#customer_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "ajax" : {
    url:"areamanagerreport.php",
    type:"POST"
   },
   dom: 'lBfrtip',
   buttons: [
    'excel', 'csv', 'copy'
   ],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
  });
  
 });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 </body>
</html>
