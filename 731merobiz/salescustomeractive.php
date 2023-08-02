<!-- salescustomer form -->
<?php
session_start();
include('include/connection.php');
$title = 'Customer List';
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
<!-- content start -->
<h2 class="m-3">Customer List</h2>
<div class="card shadow pt-3">
<a href="salescustomerform.php" class="col-2 btn btn-sm btn-success ml-3 fw-bold" >+ Customer</a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead>
        <tr>
            <th>S.No.</th>
            <th>CustomerName</th>
            <th>MobileNumber</th>
            <th>Address</th>
            <th>Created_at</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $query = "SELECT * FROM customer WHERE salesmanager_id=:salesmanager_id ORDER BY salesmanager_id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':salesmanager_id', $_SESSION['myuser']);
    $stmt->execute();
    $serial = 1; // initialize counter variable

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='tr-shadow'>";
        echo "<td>$serial</td>"; 
        echo "<td>{$row['customer_name']}</td>";
        echo "<td class='desc'>{$row['mobilenumber']}</td>";
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
        echo "<td class='text-dark'>{$row['created_at']}</td>";
        echo "<td class='text-success'>{$row['status']}</td>";
        echo "<td>
        <a class='ml-4' href='#exampleModalCenter$serial' type='button' data-toggle='modal' data-target='#exampleModalCenter$serial'>
        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-eye-fill text-success' viewBox='0 0 16 16'>
                <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
              </svg>
              </a>
              <div class='modal fade' id='exampleModalCenter$serial' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
              <div class='modal-dialog modal-dialog-centered' role='document'>
                  <div class='modal-content'>
                      <div class='modal-header'>
                          <h5 class='modal-title' id='exampleModalLongTitle'>AreaManager Details</h5>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                          </button>
                      </div>
                      <div class='modal-body'>
                          <div class='col-auto text-center'>
                          <img src='{$row['profile_img']}' alt='Profile Img' class='rounded-circle border border-secondary' style='width: 100px; height: 100px; border-width: 5px; border-color: #888;'></div><hr>
                          <div class='row'>
                          <div class='col-3'>Full Name</div><div class='col-auto'>{$row['customer_name']}</div><hr></div>  
                         <div class='row'>
                          <div class='col-3'>Address</div><div class='col-auto'>{$countryname} - {$statename} - {$cityname}</div><hr></div>
                          <div class='row'>
                          <div class='col-3'>WardNo</div><div class='col-auto'>{$row['wardno']}</div><hr></div>
                          <div class='row'>
                          <div class='col-3'>Street/Tole</div><div class='col-auto'>{$row['streetno']}</div><hr></div>
                          <div class='row'>
                          <div class='col-3'>Contact</div><div class='col-auto'>{$row['mobilenumber']}</div><hr></div>
                          <div class='row'>
                          <div class='col-3'>Email</div><div class='col-auto'>{$row['email']}</div><hr></div>
                          <div class='row'>
                          <div class='col-3'>CreatedAt</div><div class='col-auto'>" . date('Y-m-d', strtotime($row['created_at'])) . "</div><hr>
                          </div>
                          <div class='row'>
                          <div class='col-3'>Status</div><div class='col-auto'>{$row['status']}</div><hr></div>
                          </div>
                        </div>
                    </div>
              </div>
          </div>
          
          <script>
              function printModalContent(serial) {
                  var printWindow = window.open('', '', 'height=500,width=800');
                  printWindow.document.write('<html><head><title>Print</title>');
                  printWindow.document.write('<style>@media print {.modal-footer, .close {display: none;}}</style>');
                  printWindow.document.write('</head><body>');
                  printWindow.document.write(document.getElementById('exampleModalCenter' + serial).innerHTML);
                  printWindow.document.write('</body></html>');
                  printWindow.document.close();
                  printWindow.print();
              }
          </script>
          
          
    
      <a  href='salescustomeredit.php?customer_id=" . $row['customer_id'] . "' >
      <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-pencil-square ml-2 mr-2' viewBox='0 0 16 16'>
      <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
      <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
    </svg>
      </a>
      <a  href='salescustomerdelete.php?customer_id=" . $row['customer_id'] . "' onclick='return confirmDelete(event)'>
      <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash3 text-danger' viewBox='0 0 16 16'>
      <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
    </svg></a>               
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
                <!-- /.container-fluid -->

    <?php
include('include/foot.php');
?>
