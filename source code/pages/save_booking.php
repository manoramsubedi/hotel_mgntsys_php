
<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');

extract($_POST);?>

		

	
<?php

   $sql = "INSERT INTO `tbl_booking`(`name`, `roomname`, `kidno`, `adultno`, `fromdate`, `todate`,`taxdiscount`, `totalamount`, `advance_paid`) VALUES ('$name', '$roomname', '$kidno', '$adultno', '$fromdate', '$todate', '$taxdiscount', '$totalamount', '$advance_paid')";

 if ($conn->query($sql) === TRUE) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_booking.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_booking.php";
</script>
<?php } ?>