<?php require_once('check_login.php');?>
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

if(isset($_POST["btn_update"]))
{
    extract($_POST);
    $sql4 = "SELECT SUM(amount) as amt from tbl_payment WHERE bookingid='".$_GET["id"]."'";
                                    $result4 = $conn->query($sql4);
                                    $row4 = $result4->fetch_assoc();
   $paid_amount = $row4['amt'];
  
   $sql = "INSERT INTO `tbl_payment`(`bookingid`,`amount`,`datee`) VALUES ('$bookingid','$amount','$datee')";

 if ($conn->query($sql) === TRUE) {
      $_SESSION['success']=' Record Successfully Added';
    }    

    $q1="UPDATE `tbl_booking` SET `paid`='$paid_amount' WHERE `id`='".$_GET['id']."'";
    //$q2=$conn->query($q1);
    if ($conn->query($q1) === TRUE) {
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
     $sql3 = "SELECT * FROM `tbl_payment` WHERE id='".$row['id']."'";
     $result3=$conn->query($sql3);
     $row3=$result3->fetch_assoc();
      $sql4 = "SELECT SUM(amount) as amt from tbl_payment WHERE bookingid='".$_GET["id"]."'";
                                    $result4 = $conn->query($sql4);
                                    $row4 = $result4->fetch_assoc();
    //print_r($row);
    extract($row);
$bookingid = $row['id'];
$name = $row2['name'];
$amount = $result3->num_rows > 0 ? $row3['amount'] : 0;
$datee = $result3->num_rows > 0 ? $row3['datee'] : date('Y-m-d');
$totalamount = $row['totalamount'];
$taxamount = $row['taxamount'];
$paid =  $row4['amt'];
$paid_amount = $row4['amt'];
$remainamount = $row['taxamount']-$row4['amt'];
  


}


?>


        <!-- Page wrapper  -->
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">payment Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add payment Management</li>
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
                                <h4>Payment Details</h4>
                                <div class="form-validation">
                                    
                                    <form class="form-valide"  method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Customer Name:<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="name"  placeholder="Customer Name:" value="<?php echo $name; ?>" required="" onchange="calculate();" onkeyup="calculate();" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">booking id<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="bookingid"  placeholder="booking id" value="<?php echo $bookingid; ?>" required="" onchange="calculate();" onkeyup="calculate();" readonly>
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

                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">remain amount<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="remainamount" value="<?php echo $remainamount; ?>" placeholder="remain amount"  required="" onchange="calculate();" onkeyup="calculate();" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Insert amount<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" id="val-digits" name="amount" placeholder="amount" max="<?php echo $remainamount;?>" min="0" required="">
                                            </div>
                                        </div>
                                         <!-- <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Paying amount</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="amount" class="form-control" placeholder="Amount" max="<?php echo $remainamount;?>" min="0" required>
                                                </div>
                                            </div>
                                        </div> -->


                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">paid_amount<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-digits" name="paid_amount" value="<?php echo $paid_amount; ?>" placeholder="paid_amount"  required="" onchange="calculate();" onkeyup="calculate();" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-digits">Date<span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" id="val-digits" name="datee" placeholder="date" required="">
                                            </div>
                                        </div>

                                      
                                      
                                        

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" name="btn_update" class="btn btn-primary">Submit</button>
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
           
                                     




                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Payment Details</h4>
                                
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Booking No</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>Booking No</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    
                                    $sql = "SELECT * FROM `tbl_booking` join `tbl_payment` 
                                    On tbl_booking.id= tbl_payment.bookingid
                                    WHERE tbl_booking.id = '".$_GET['id']."'";
                                    
                                     $result = $conn->query($sql);
                                 
                                  while ($row = $result->fetch_assoc()) {
                                    
                                     $sql2 = "SELECT * FROM `tbl_payment` WHERE id='".$row['id']."'";
   
                               
                                     $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch_assoc();
                                
                                      ?>
                                            <tr>
                                                <td><?php echo $row['bookingid']; ?></td>
                                               
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['datee']; ?></td>
                                              
                                            </tr>
                                          <?php  }
                                          ?>

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   <!--  </div> -->
 
<?php include('footer.php');?>

