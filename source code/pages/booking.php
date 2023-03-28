
<?php
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('../connect.php');
if(isset($_POST["btn_save"])){

/*echo "<pre>"; */
extract($_POST);
$roomname=explode(',',$_POST['roomname']);
/*print_r($roomname[1]); */
$tax=explode(',',$_POST['tax']);
/*print_r($tax[1]); */
?>

<?php $earlier = new DateTime($_POST['fromdate']);
$later = new DateTime($_POST['todate']);

$diff = $later->diff($earlier)->format("%a");
/*echo "$diff";echo "<br>";*/
/*
$sql = "SELECT * FROM `tbl_booking`";
$result=$conn->query($sql);
    while($row=$result->fetch_assoc()){
  $sql2 = "SELECT * FROM `tbl_rooms`WHERE id='".$row['roomname']."'";
    $result2=$conn->query($sql2);
    $row2=$result2->fetch_assoc();*/

    
    $totalamount = 0.0;
$totalamountperday = $_POST['kidno'] * $roomname[2] + $_POST['adultno'] * $roomname[1]   ;echo "<br>"; /*}*/ $totalamount = $totalamountperday * $diff;
/*echo $totalamount; */
   $taxamount = 0.0;
   $num = $totalamount * $tax[1];
   $deno = 100;
   $total1 = $num / $deno;
   $taxamount = $totalamount + $total1;
  // $paid = 0.0;
   /*echo if($paid!=Null){
  $sql = "INSERT INTO `tbl_booking`(`name`, `roomname`, `kidno`, `adultno`, `fromdate`, `todate`,`taxamount`, `totalamount`, `paid`) VALUES ('$name', '$roomname[0]', '$kidno', '$adultno', '$fromdate', '$todate', '$taxamount', '$totalamount', '$paid')";
} echo "<pre>"; print_r($sql) exit; else{
  $paid = 0;
  $sql = "INSERT INTO `tbl_booking`(`name`, `roomname`, `kidno`, `adultno`, `fromdate`, `todate`,`taxamount`, `totalamount`, `paid`) VALUES ('$name', '$roomname[0]', '$kidno', '$adultno', '$fromdate', '$todate', '$taxamount', '$totalamount', '$paid')";
}*/
   /*echo $taxamount; */
} 

$paid = 0;

   $sql = "INSERT INTO `tbl_booking`(`name`, `roomname`, `kidno`, `adultno`, `fromdate`, `todate`,`taxamount`, `totalamount`, `paid`, `created_date` ) VALUES ('$name', '$roomname[0],', '$kidno', '$adultno', '$fromdate', '$todate', '$taxamount', '$totalamount', '$paid', CURDATE())";

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

