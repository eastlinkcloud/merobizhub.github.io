<!-- admintop -->
<?php
session_start();
$title = 'Resellerwallet List';
include('include/connection.php');
include('include/top.php');
include('include/salestop.php');
?>
<!-- content start -->
<h4>Resellerwallet List</h4>
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
                        <th>Receipt</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php

$query = "SELECT * FROM resellerwallet  WHERE salesmanager_id=$_SESSION[myuser]";
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
    echo "<td>
    <a href='{$row['profile_img']}' target='_blank'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-eye-fill text-primary' viewBox='0 0 16 16'>
    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
    </svg></a>
    <a href='{$row['profile_img']}' download><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-file-earmark-arrow-down' viewBox='0 0 16 16'>
    <path d='M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z'/>
    <path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/>
  </svg></a>
</td>";
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
                      <div class='row'>
                      <div class='col-4'>Requested By</div><div class='col-auto'>{$row['requested_by']}</div><hr></div>  
                      <div class='row'>
                      <div class='col-4'>Customer Name</div><div class='col-auto'>{$row['customer_name']}</div><hr></div>
                      <div class='row'>
                      <div class='col-4'>Amount</div><div class='col-auto'>{$row['anumber']}</div><hr></div>
                      <div class='row'>
                      <div class='col-4'>Amount in Word</div><div class='col-auto'>{$row['aword']}</div><hr></div>
                      <div class='row'>
                      <div class='col-4'>Date of Payment</div><div class='col-auto'>{$row['date']}</div><hr></div>
                      <div class='row'>
                      <div class='col-4'>Contact</div><div class='col-auto'>{$row['contactnumber']}</div><hr></div>
                      <div class='row'>
                      <div class='col-4'>Email</div><div class='col-auto'>{$row['email']}</div><hr></div>
                      <div class='row'>
                      <div class='col-4'>CreatedAt</div><div class='col-auto'>" . date('Y-m-d', strtotime($row['created_at'])) . "</div><hr>
                      </div>
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
      </script></td>";
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
