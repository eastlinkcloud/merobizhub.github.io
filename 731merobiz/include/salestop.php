
                        


<style>
.sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover {
    background-color:#222A44;
}

.sidebar .nav-item .collapse .collapse-inner, .sidebar .nav-item .collapsing .collapse-inner {
    padding: 0.7rem 1rem;
    min-width: 7rem;
    font-size: 0.85rem;
    margin: -10px 0 -15px 0;
}
.sidebar .nav-item .nav-link:hover{
    background-color:#222A44;
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
        </style>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar  accordion" id="accordionSidebar" style="background:#28304e; color:#fff;">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="salesdashboard.php">
                <div class="sidebar-brand-text mx-3"> <img src="img/icon/merobizz.png" alt="" width="70%" ></div>
            </a>
            <li class="nav-item active text-center">  </li>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item active mt-4">
                <a class="nav-link" href="salesdashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider my-0  bg-light">
            <!-- Heading -->
            <style>
.sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover {
    background-color:blue;
}
       </style>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Customer</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded text-white">
                        <a class="collapse-item text-white" href="salescustomerform.php">Create Customer</a>
                        <a class="collapse-item text-white" href="salescustomeractive.php">List Customer</a>
 </div>
                </div>
            </li>
                        <!-- Nav Item - Pages report Menu -->
                        <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePageses"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Report</span>
                </a>
                <div id="collapsePageses" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded text-white">
                        <a class="collapse-item text-white" href="reportcustomers.php">Customer Report</a>
                    </div>
                </div>
            </li>
           
                        <!-- Nav Item - Charts -->
                        <li class="nav-item">
                <a class="nav-link" href="receipt.php">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Reseller Wallet Amount</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="salesreceipt.php">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Receipt</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="reffer.php">
                    <i class="fas fa-fw fa-share"></i>
                    <span>Refer</span></a>
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
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
      <!-- Sidebar Message -->

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand  topbar mb-4 static-top shadow" style="background:#28304e; color:#fff;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    
<div class="col d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <a href="salescustomerform.php" class="navbar-brand btn btn-info" style="background:#28304e; color:#fff; font-size:15px;">Create Customer</a>

    <a href="receipt.php" class="navbar-brand btn btn-info" style="background:#28304e; color:#fff; font-size:15px;">Reseller Wallet Amount</a>
</div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a href="salesdashboard.php" class="nav-link text-center justify-content-center"><img src="img/icon/merobizz.png" alt="" width="45%"></a>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown arrow text-white">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <span class="mr-2 d-none d-lg-inline  text-capitalize text-white"><span class="text-capitalize"> SalesPoint</span></span>
                                <img src="<?php
$query = "SELECT profile_img FROM salesmanager WHERE salesmanager_id=:salesmanager_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':salesmanager_id', $_SESSION['myuser']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo $result['profile_img'];
?>" alt=""  style="width:35px; border-radius:50%; border:2px solid #fff;">
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
           