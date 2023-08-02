<?php
if(isset($_POST["export"])){
	if(empty($_POST["fromDate"])){
	 $startDateMessage = '>label class="text-danger"<Select start date.>/label<';
	}else if(empty($_POST["toDate"])){
	 $endDate = '>label class="text-danger"<Select end date.>/label<';
	} else {  
	 $orderQuery = "
	   SELECT * FROM orders 
	   WHERE date <= '".$_POST["fromDate"]."' AND date >= '".$_POST["toDate"]."' ORDER BY date DESC";
	 $orderResult = mysqli_query($conn, $orderQuery) or die("database error:". mysqli_error($conn));
	 $filterOrders = array();
	 while( $order = mysqli_fetch_assoc($orderResult) ) {
	   $filterOrders[] = $order;
	 }
	 if(count($filterOrders)) {
		 $fileName = "phpzag_export_".date('Ymd') . ".csv";
		 header("Content-Description: File Transfer");
		 header("Content-Disposition: attachment; filename=$fileName");
		 header("Content-Type: application/csv;");
		 $file = fopen('php://output', 'w');
		 $header = array("Id", "Name", "Item", "Value", "Date");
		 fputcsv($file, $header);  
		 foreach($filterOrders as $order) {
		  $orderData = array();
		  $orderData[] = $order["id"];
		  $orderData[] = $order["cname"];
		  $orderData[] = $order["item"];
		  $orderData[] = $order["value"];
		  $orderData[] = $order["date"];
		  fputcsv($file, $orderData);
		 }
		 fclose($file);
		 exit;
	 }
	}
   }

?>