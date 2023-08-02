<!-- viewdetailscustomer.php -->
<?php
session_start();
$title = 'view customer';
include('include/connection.php');


if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Fetch customer details based on the provided ID
    $query = "SELECT * FROM area_customer WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If no ID is provided, redirect to the previous page or handle the error accordingly
    header('Location: areamanagerdashboard.php');
    exit();
}
include('include/top.php');
include('include/areatop.php');
?>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo $customer['profile_img']; ?>" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h3><?php echo $customer['customer_name']; ?></h3>
                                <p class="text-primary mb-1 h5">Customer</p>
                                <p class="text-success font-size-sm"><?php echo $customer['status']; ?></p>
                                <button></button>
                                <button></button>
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
                                <?php echo $customer['customer_name']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-primary">
                                <?php echo $customer['email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Contact No.</h6>
                            </div>
                            <div class="col-sm-9 text-info">
                                +977-<?php echo $customer['mobilenumber']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?php 
                               $country_id = $customer['province'];
                              
                                $query = "SELECT * FROM country WHERE id = :country_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':country_id', $country_id);
                                $stmt->execute();
                                $countryname = $stmt->fetch(PDO::FETCH_ASSOC);
                                //-------
                                $state_id = $customer['district'];
                                $query = "SELECT * FROM state WHERE id = :state_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':state_id', $state_id);
                                $stmt->execute();
                                $statename = $stmt->fetch(PDO::FETCH_ASSOC);
                                //---------------
                                $city_id = $customer['municipality'];
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
                                <?php echo $customer['wardno']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Street*</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $customer['streetno']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Location</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $customer['latitude']; ?> <?php echo $customer['longitude']; ?>
                            </div>
                        </div><hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Created At</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $customer['created_at']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters-sm">
                    <div class="col-sm-10 mb-0">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Docs Images</i></h5>
                                <?php if (!empty($customer['docs_img'])) : ?>
                                    <a href="<?php echo $customer['docs_img']; ?>" download>
                                        <button class="btn btn-primary btn-sm justify-content-end">Download</button>
                                    </a>
                                    <p></p>
                                    <div id="docs-img-container" class="zoomTarget">
                                        <a href="<?php echo $customer['docs_img']; ?>" target="_blank">
                                            <img src="<?php echo $customer['docs_img']; ?>" alt="Docs Image" class="col-sm-12">
                                        </a>
                                    </div>
                                    <script>
                                        document.getElementById('docs-img-container').addEventListener('click', function() {
                                            Zoomooz.zoomTo(this);
                                        });
                                    </script>
                                <?php else : ?>
                                    <p>No docs image available.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('include/foot.php');
?>
