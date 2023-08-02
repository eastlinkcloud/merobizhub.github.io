<!-- admintop -->
<?php
session_start();
$title = 'Resellerwallet List';
include('include/connection.php');
include('include/top.php');
include('include/admintop.php');
?>
<!-- content start -->
<div class="card shadow mb-2">
    <div class="card-header py-1">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>RequestedBy</th>
                        <th>CustomerName</th>
                        <th>PaymentType</th>
                        <th>Amount</th>
                        <th>AmountInAmount</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
$query = "SELECT * FROM resellerwallet";
$stmt = $conn->query($query);
$serial = 1; // initialize counter variable
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr class='tr-shadow'>";
    echo "<td>$serial</td>";
    echo "<td>{$row['requested_by']}</td>";
    echo "<td>{$row['customer_name']}</td>";
    echo "<td>{$row['payment_type']}</td>";
    echo "<td>{$row['anumber']}</td>";
    echo "<td>{$row['aword']}</td>";
    echo "<td>{$row['contactnumber']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['remark']}</td>";
    echo "<td class='row'>
    <a class='col btn btn-primary btn-sm text-light' href='viewreceiptdetails.php?id=" . $row['id'] . "' style='font-size:15px; border:2px solid #fff; font-weight:bold;'>View</a>
    </td>";
    echo "</tr>";
    $serial++;
}
?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Main Content -->
    <?php
    include('include/foot.php');
    ?>
