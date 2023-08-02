<!-- view areamanager details by id -->
<?php
session_start();
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');

if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    // Fetch area manager details based on the provided ID
    $query = "SELECT * FROM managerdata WHERE d_id = :d_id AND status = 'Active'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':d_id', $d_id);
    $stmt->execute();
    $managerdata = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If no ID is provided, redirect to the previous page or handle the error accordingly
    header('Location: admindashboard.php');
    exit();
}
?>
   <style>
      @media only print {
         body {
            visibility: hidden;
         }
         .cssInp {
            visibility: visible;
         }
      }
   </style>
   <div class="cssInp">
<div class="container">
    <div class="main-body">
         <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <img src="profile_images/<?php echo $managerdata['profile_img']; ?>" alt="Profile Img" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h3><?php echo $managerdata['username']; ?></h3>
                      <p class="text-primary mb-1 h5">Area Manager</p>
                      <p class="text-success font-size-sm"><?php echo $managerdata['status']; ?></p>
                      Created_At
                      <p class="text-success font-size-sm"><?php echo $managerdata['created_at']; ?> </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $managerdata['managerdata_name']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-primary">
                    <?php echo $managerdata['email']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No.</h6>
                    </div>
                    <div class="col-sm-9 text-info">
                    +977-<?php echo $managerdata['mobilenumber']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php 
                               $country_id = $managerdata['province'];
                              
                                $query = "SELECT * FROM country WHERE id = :country_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':country_id', $country_id);
                                $stmt->execute();
                                $countryname = $stmt->fetch(PDO::FETCH_ASSOC);
                                //-------
                                $state_id = $managerdata['district'];
                                $query = "SELECT * FROM state WHERE id = :state_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':state_id', $state_id);
                                $stmt->execute();
                                $statename = $stmt->fetch(PDO::FETCH_ASSOC);
                                //---------------
                                $city_id = $managerdata['municipality'];
                                $query = "SELECT * FROM city WHERE id = :city_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':city_id', $city_id);
                                $stmt->execute();
                                $cityname = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                                echo $countryname['name'] . ' / '. $statename['name'] . ' / '. $cityname['name']; 
                                ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">WardNo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $managerdata['wardno']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Street*</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $managerdata['totalpoints']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Location</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $managerdata['latitude']; ?> <?php echo $managerdata['longitude']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Created At</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $managerdata['created_at']; ?> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-success">
                    <?php echo $managerdata['status']; ?> 
                    </div>
                  </div>
                  <hr>
                  <!-- for img -->
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Docs_img*</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <div id="docs-img-container" class="zoomTarget">
                    <a href="docs_images/<?php echo $managerdata['docs_img']; ?>" target="_blank">
                        <img src="docs_images/<?php echo $managerdata['docs_img']; ?>" alt="Profile Image" class="col-sm-5">
                    </a>
                </div>
                <script>
                    document.getElementById('docs-img-container').addEventListener('click', function() {
                        Zoomooz.zoomTo(this);
                    });
                </script></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div> </div>
    <div id="cssBtnWrap">
    <a href="print_area_manager_details.php?d_id=<?php echo $d_id; ?>" class="btn btn-success"><i class="fa fa-print content-justify-between"></i> Print</a>
</div>

   <p id="cssOp"></p>
    <script>
    var cssOutEl = document.getElementById("cssOp");
    var cssBtnWrapEl = document.getElementById("cssBtnWrap");
    var originalContent = cssOutEl.innerHTML;

    function cssPrint() {
        cssOutEl.innerHTML = "Printing the document...";
        cssBtnWrapEl.style.display = "none";
        print();
    }

    window.onafterprint = function() {
        cssOutEl.innerHTML = originalContent;
        cssBtnWrapEl.style.display = "block";
    };
</script>
<!-- End of Main Content -->
<?php
include('include/foot.php');
?>
