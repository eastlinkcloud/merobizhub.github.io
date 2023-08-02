<!-- viewdetailscustomer.php -->
<?php
session_start();
include('include/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch customer details based on the provided ID
    $query = "SELECT * FROM resellerwallet WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $resellerwallet = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // If no ID is provided, redirect to the previous page or handle the error accordingly
    header('Location: admindashboard.php');
    exit();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>
body{margin-top:20px;
background-color:#eee;
}

.card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 1rem;
}
</style>
<div class="container" id="printable-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15"><span class="badge bg-success font-size-12 ms-2"></span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">Merobizhub.com</h2>
                        </div>
                        <div class="text-muted">
                        <h5 class="font-size-15 mb-2">SalesPoint: <?php echo $resellerwallet['requested_by']; ?></h5>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> Email: <?php echo $resellerwallet['email']; ?></p>
                            <p><i class="uil uil-phone me-1"></i>Contact: <?php echo $resellerwallet['contactnumber']; ?></p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">Customer Name: <?php echo $resellerwallet['customer_name']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Amount</th>
                                        <th>Amount in word</th>              
                                        <th>Payment Method</th>
                                        <th>Date of Issue</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td><?php echo $resellerwallet['aword']; ?></td>
                                        <td><?php echo $resellerwallet['anumber']; ?></td>
                                        <td ><?php echo $resellerwallet['payment_type']; ?></td>
                                        <td><?php echo $resellerwallet['date']; ?></td>
                                    </tr>
                                    <!-- end tr -->

                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4">
    <div class="float-end">
        <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
