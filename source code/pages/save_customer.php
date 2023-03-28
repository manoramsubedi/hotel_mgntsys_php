
<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');

extract($_POST);
/*  echo */ $sql = "INSERT INTO `tbl_customer`(`name`, `email`, `gender`, `birthdate`, `contact`, `address`, `created_date`) VALUES ('$name', '$email', '$gender', '$birthdate', '$contact', '$address', CURDATE())";
//echo "<pre>";print_r($sql); exit;
 if ($conn->query($sql) === TRUE) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_customer.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_customer.php";
</script>
<?php } ?>