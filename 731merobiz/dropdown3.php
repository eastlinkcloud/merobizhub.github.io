
<?php  
$conn = new mysqli('localhost', 'merobizh_root', 'Kniltsae@977');  
mysqli_select_db($conn, 'merobizh_sales');  
$sql = "SELECT `customer_id`,`customer_name`,`category`,`product`,`price`,`province`,`district`,`municipality`,`mobilenumber`,`status`,`created_at` FROM `customer`";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = "customer_id" . "\t" . "customer_name" . "\t" . "Category" . "\t" . "Product" . "\t" . "Price" . "\t"
. "Province" . "\t" . "District" . "\t" . "municipality" . "\t" . "Contact" . "\t" . "Status" . "\t" . "CreatedAt" . "\t";
 
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?>



//
<?php
session_start();
$title = 'AreaManager List';
include('include/connection.php');
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
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link rel="icon" type="image/png" href="img/icon/merobiz.png">
  <!-- Include necessary CSS -->
  <!-- for export -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
 <body>
 <style>
.sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover {
    background-color:#2f4182;
}

.sidebar .nav-item .collapse .collapse-inner, .sidebar .nav-item .collapsing .collapse-inner {
    padding: 0.7rem 1rem;
    min-width: 7rem;
    font-size: 0.85rem;
    margin: -10px 0 -15px 0;
}
.sidebar .nav-item .nav-link:hover{
    background-color:#2f4182;
}
.sidebar .nav-item .nav-link {
    display: block;
    width: 100%;
    text-align: left;
    padding: 0.77rem;
    width: 14rem;
}
thead,th,td{
    background: #fff;
    color: #000;
}

.center-button {
    margin-left: auto;
    margin-right: auto;
    display: block;
}
.sidebar{
    background:#28304e; 
    color:#fff;
}   
        </style>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <li><a class="sidebar-brand d-flex align-items-center justify-content-center" href="admindashboard.php">
                <div class="sidebar-brand-text mx-3"> <img src="img/icon/merobizz.png" alt="" width="70%" ></div>
            </a></li>
            <li class="nav-item active text-center mb-3">

            </li>
            <!-- Divider -->
 
            <li class="nav-item active">
                <a class="nav-link" href="admindashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider my-0  bg-light">
 <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>AreaManager</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="collapse-inner rounded" >
                        <a class="collapse-item text-white" href="adminareamanagerform.php">Create AreaManager</a>
                        <a class="collapse-item text-white" href="adminareamanageractive.php">List AreaManager</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>SalesPoint</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded text-white">
                        <a class="collapse-item text-white" href="adminsalesmanagerform.php">Create SalesPoint</a>
                        <a class="collapse-item text-white" href="adminsalesmanageractive.php">List SalesPoint</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customer</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded text-white">
                        <a class="collapse-item text-white" href="admincustomerform.php">Create Customer</a>
                        <a class="collapse-item text-white" href="admincustomeractive.php">List Customer</a>
                        <a class="collapse-item text-white" href="customerreport.php">Customer Report</a>
                      
                      </div>
                </div>
            </li>
                <!-- category -->
            <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess"
                                aria-expanded="true" aria-controls="collapsePage">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg><span>Category</span>
                        </a>
                <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded text-white">
                        <a class="collapse-item text-white" href="category.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"/>
                    </svg> Add Category</a>
                    <a class="collapse-item text-white" href="listcategory.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                    </svg> List Category</a>
                    </div>
                                    </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    <span>Product</span>
                </a>
                <div id="collapsePage" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded text-white">
                                    <a class="collapse-item text-white" href="addproduct.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"/>
                    </svg> Add product</a>
                    <a class="collapse-item text-white" href="listproduct.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                    </svg> List Product</a>
                    </div>
                        </div>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="view_receipt.php">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Receipt List</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="view_referrals.php">
                    <i class="fas fa-fw fa-share"></i>
                    <span>Referral List</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Send feedback</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" style="fill: white;">
                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
                </svg>
                <span style="color:#ff7088;">Log Out</span></a>
                            </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                <a class="btn rounded-circle border-0 btn-light" id="sidebarToggle" aria-label="Toggle Sidebar"></a>

                    </div>
            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand  topbar mb-4 static-top shadow" style="background:#28304e; color:#fff;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <a class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </a>

                    
<div class="col d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <a href="adminareamanagerform.php" class="navbar-brand btn btn-info" style="background:#28304e; color:#fff; font-size:15px;">Create Areamanager</a>
    <a href="adminsalesmanagerform.php" class="navbar-brand btn btn-info" style="background:#28304e; color:#fff; font-size:15px;">Create SalesPoint</a>
    <a href="admincustomerform.php" class="navbar-brand btn btn-info" style="background:#28304e; color:#fff; font-size:15px;">Create Customer</a>
</div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a href="admindashboard.php" class="nav-link text-center justify-content-center"><img src="img/icon/merobizz.png" alt="" width="45%"></a>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown arrow text-white">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <span class="mr-2 d-none d-lg-inline  text-capitalize text-white"><?php echo $_SESSION['username']; // Display the username ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/icon/profile-icon.png" alt="profile-img" width="32">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->
  <div class="container">
   <h3 align="center">Cusotmer Report</h3>
   <br />
   <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
        <?php
$query = "SELECT * FROM managerdata ORDER BY d_id DESC";
$stmt = $conn->query($query);
$serial = 1; // initialize counter variable
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr class='tr-shadow'>";
    echo "<td>$serial</td>";
    echo "<td>{$row['managerdata_name']}</td>";
    echo "<td>{$row['mobilenumber']}</td>";
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

    echo "<td>{$countryname} - {$statename} - {$cityname}</td>";

    echo "<td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>";
    echo "<td>{$row['status']}</td>";
    echo "</tr>";
    $serial++; // increment counter variable
}
?>
    </tbody>
    </table>
  </div>
  
  <script>$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );</script>
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  $('#customer_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "ajax" : {
    url:"fetch.php",
    type:"POST"
   },
   dom: 'lBfrtip',
   buttons: [
    'excel', 'csv', 'pdf', 'copy'
   ],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
  });
  
 });
 
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 </body>
</html>




//
customer Report
<?php
session_start();
$title = 'Customer List';
include 'include/connection.php';
include 'include/top.php';
include 'include/admintop.php';

// Retrieve filter values from the form submission or set default values
$category = isset($_POST['category']) ? $_POST['category'] : '';
$province = isset($_POST['province']) ? $_POST['province'] : '';
$district = isset($_POST['district']) ? $_POST['district'] : '';
$municipality = isset($_POST['municipality']) ? $_POST['municipality'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// Prepare the query based on the filter values
$query = "SELECT c.*, ca.category_name, p.product_name, cn.name as province_name, s.name as district_name, m.name as municipality_name
          FROM customer c
          LEFT JOIN category ca ON c.category = ca.category_id
          LEFT JOIN product p ON c.product = p.p_id
          LEFT JOIN country cn ON c.province = cn.id
          LEFT JOIN state s ON c.district = s.id
          LEFT JOIN city m ON c.municipality = m.id
          WHERE 1=1";
$params = array();

if (!empty($category)) {
    $query .= " AND ca.category_name LIKE :category";
    $params[':category'] = '%' . $category . '%';
}

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

$query .= " ORDER BY c.customer_id DESC";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$serial = 1;

$sql = "SELECT category_id, category_name FROM category WHERE status = 'Active'";
$stmt1 = $conn->prepare($sql);
$stmt1->execute();
$categories = $stmt1->fetchAll(PDO::FETCH_ASSOC);

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
<!-- content start -->
<h2 class="m-4">Customer List</h2>

<style>
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
        background: #000;
        border: 1px solid #fff;
        color: #fff;
    }
    form{
        background: #fff;
        margin:10px;
    }
    table{
        font-size:15px;
    }
</style>
<form method="POST">
            <div class="row">

                    <select name="category" id="category" class="form-select ml-4" >
                        <option value="" style="font-size:10px;">Select Category</option>
                        <?php
                        foreach ($categories as $categoryItem) {
                            $selected = ($category == $categoryItem['category_name']) ? 'selected' : '';
                            echo "<option value='{$categoryItem['category_name']}' $selected>{$categoryItem['category_name']}</option>";
                        }
                        ?>
                    </select>

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

        <form action="dropdown3.php">
            <button class="btn btn-sm btn-success" name="submit" type="submit">Export</button>
        </form>
        

<div class="card shadow pt-3">
    <div class="card-body">
<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Customer Name</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>Municipality</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='tr-shadow'>";
                        echo "<td>$serial</td>";
                        echo "<td>{$row['customer_name']}</td>";
                        echo "<td>{$row['category_name']}</td>";
                        echo "<td>{$row['product_name']}</td>";
                        echo "<td>Rs.{$row['price']}</td>";
                        echo "<td>{$row['province_name']}</td>";
                        echo "<td>{$row['district_name']}</td>";
                        echo "<td>{$row['municipality_name']}</td>";
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
<?php

?>

<?php
include('include/foot.php');
?>
