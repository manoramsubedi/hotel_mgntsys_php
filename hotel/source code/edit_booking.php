<?php require_once('check_login.php');?>
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

if(isset($_POST["submit"]))
{
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

$paid=0;
 $q1="UPDATE `tbl_booking` SET `name`='$name',`roomname`='$roomname[0]',`kidno`='$kidno',`adultno`='$adultno',`fromdate`='$fromdate',`todate`='$todate',`taxamount`='$taxamount',`totalamount`='$totalamount', `paid`='$paid', `created_date`='CURDATE()' WHERE `id`='".$_GET['id']."'";
    //$q2=$conn->query($q1);
    if ($conn->query($q1) === TRUE) { echo "string";
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_booking.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_booking.php";
</script>
<?php
}
}
?>
<?php
$que="SELECT * FROM `tbl_booking` WHERE id='".$_GET["id"]."'";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
     $sql2 = "SELECT * FROM `tbl_customer` WHERE id='".$row['name']."'";
     $result2=$conn->query($sql2);
     $row2=$result2->fetch_assoc();
     $sql3 = "SELECT * FROM `tbl_rooms` WHERE id='".$row['roomname']."'";
     $result3=$conn->query($sql3);
     $row3=$result3->fetch_assoc();
    //print_r($row);
    extract($row);
$name = $row2['name'];
$roomname = $row3['roomname'];
$kidno = $row['kidno'];
$adultno = $row['adultno'];
$fromdate = $row['fromdate'];
$todate = $row['todate'];
$taxamount = $row['taxamount'];
$totalamount = $row['totalamount'];
$paid = $row['paid'];
}

?>         <!-- Page wrapper  -->
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Room Booking</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Room Booking</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->     
                                
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                              
                                <div class="form-validation">
                                    
                                    <form class="form-valide"  method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">
                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Customer Name:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                 <select class="form-control" id="val-skill" name="name" required="">
                                                    <option value="">--Select Customer--</option>
                                                   <?php  
                                                            $c1 = "SELECT * FROM `tbl_customer`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"];?>">
                                                                        <?php echo $row['name'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-skill">Room Name : <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="val-skill" name="roomname" required=""  onchange="calculate();" onkeyup="calculate();">
                                                    <option value="">--Select Room--</option>
                                                    <?php  
                                                            $c1 = "SELECT * FROM `tbl_rooms`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"].','.$row['peradultprice'].','.$row['perkidprice'];?>">
                                                                        <?php echo $row['roomname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                </select>
                                                <!-- <select class="form-control" id="val-skill" name="roomname" required="">
                                                    <option value="">Please select</option>
                                                    <option value="Deluxe"<?php if($roomname=='Deluxe'){ echo "Selected";}?>>Deluxe</option>
                                                    <option value="Superior"<?php if($roomname=='Superior'){ echo "Selected";}?>>Superior</option>
                                                    <option value="Single"<?php if($roomname=='Single'){ echo "Selected";}?>>Single</option>
                                                    <option value="Double"<?php if($roomname=='Double'){ echo "Selected";}?>>Double</option>
                                                    <option value="Triple"<?php if($roomname=='Triple'){ echo "Selected";}?>>Triple</option>
                                                    <option value="Quad"<?php if($roomname=='Quad'){ echo "Selected";}?>>Quad</option>
                                                </select> -->
                                            </div>
                                        </div>
                                       
                                      <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">No of Adults<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="adultno" value="<?php echo $adultno; ?>" placeholder="No of Adults"  required="" onchange="calculate();" onkeyup="calculate();">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">No of Kid:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="kidno" value="<?php echo $kidno; ?>" placeholder="No of Kid"  required="" onchange="calculate();" onkeyup="calculate();">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">From Date :<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" id="val-digits" name="fromdate" value="<?php echo $fromdate; ?>" placeholder="From Date" required="" onchange="calculate();" onkeyup="calculate();">
                                            </div>
                                        </div>

                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">To Date : <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" id="val-digits" name="todate" value="<?php echo $todate; ?>" placeholder="To Date" required="" onchange="calculate();" onkeyup="calculate();">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-skill">Tax Name : <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="val-skill" name="tax" required=""  onchange="calculate();" onkeyup="calculate();">
                                                    <option value="">--Select tax--</option>
                                                    <?php  
                                                            $c1 = "SELECT * FROM `tbl_tax`";
                                                            $result = $conn->query($c1);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = mysqli_fetch_array($result)) {?>
                                                                    <option value="<?php echo $row["id"].','.$row['percentage'].','.$row['taxname'];?>">
                                                                        <?php echo $row['taxname'];?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            } else {
                                                            echo "0 results";
                                                                }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Total Amount<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="totalamount" value="<?php echo $totalamount; ?>" placeholder="Total Amount"  required="" onchange="calculate();" onkeyup="calculate();" readonly>
                                            </div>
                                        </div>


                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Payable Amount<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="taxamount" value="<?php echo $taxamount; ?>" placeholder="Payable Amount"  required="" onchange="calculate();" onkeyup="calculate();" readonly>
                                            </div>
                                        </div>

                                        <!--  <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Advance Paid<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="paid" value="<?php echo $paid; ?>" placeholder="Advance Paid"  required="" onchange="calculate();" onkeyup="calculate();" readonly>
                                            </div>
                                        </div> -->


                                         <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
                <!-- /# row -->
                <!-- End PAge Content -->
        </div>
            <!-- End Container fluid  -->
            <!-- End Bread crumb -->
 
<?php include('footer.php');?>

