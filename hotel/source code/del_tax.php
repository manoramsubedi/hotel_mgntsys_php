<?php require_once('check_login.php');?>
<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM `tbl_tax` WHERE id='".$_GET["id"]."'";
$res = $conn->query($sql) ;
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>
//alert("Delete Successfully");
window.location = "view_tax.php";
</script>

