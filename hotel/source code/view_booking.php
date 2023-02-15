<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<link rel="stylesheet" href="popup_style.css">
<?php include('sidebar.php');

if(isset($_GET['id']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="del_booking.php?id=<?php echo $_GET['id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view_booking.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
  <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Booking</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Booking</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                      <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Booking Details</h4>
                               
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Customer Name</th>
                                                <th>Room Name</th>
                                                <th style="width:15px">No of kid</th>
                                                <th style="width:15px">No of Adult</th>
                                                <th style="width:100px">From Date</th>
                                               <th style="width:100px">To Date</th>
                                               <th style="width:80px">Total Amount</th>
                                               <th style="width:80px">Payble Amount</th>
                                               <th style="width:80px"> Paid Amount</th>
                                               <th>Status</th>
                                              <!--  <th>Remain Amount</th> -->
                                               <th style="width:100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Customer Name</th>
                                                <th>Room Name</th>
                                                <th style="width:15px">No of kid</th>
                                                <th style="width:15px">No of Adult</th>
                                                <th style="width:100px">From Date</th>
                                               <th style="width:100px">To Date</th>
                                               <th style="width:80px">Total Amount</th>
                                               <th style="width:80px">Payble Amount</th>
                                               <th style="width:80px"> Paid Amount</th>
                                               <th>Status</th>
                                              <!--  <th>Remain Amount</th> -->
                                               <th style="width:100px">Action</th>
                                            </tr>
                                        </tfoot>                  
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    $sql = "SELECT * FROM `tbl_booking`";
                                     $result = $conn->query($sql);
                                  $i=1;
                                   while($row = $result->fetch_assoc()) { 
                                    $sql2 = "SELECT * FROM `tbl_customer` WHERE id='".$row['name']."'";
                                    $result2=$conn->query($sql2);
                                    $row2=$result2->fetch_assoc();
                                    $sql3 = "SELECT * FROM `tbl_rooms` WHERE id='".$row['roomname']."'";
                                    $result3=$conn->query($sql3);
                                    $row3=$result3->fetch_assoc();
                                  $sql4 = "SELECT SUM(amount) as amt from tbl_payment WHERE bookingid='".$row['id']."'";
                                    $result4=$conn->query($sql4);
                                    $row4=$result4->fetch_assoc();
                                      ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $row4['name']; ?></td>
                                                <td><?php echo $row3['roomname']; ?></td>
                                                <td><?php echo $row['kidno']; ?></td>
                                                <td><?php echo $row['adultno']; ?></td>
                                                <td><?php echo $row['fromdate']; ?></td>
                                                <td><?php echo $row['todate']; ?></td>
                                                <td><?php echo $row['totalamount']; ?></td>
                                                <td><?php echo $row['taxamount']; ?></td>
                                                <td><?php echo $row4['amt'] ?></td>
                                                <td><?php $row['paid']= $row4['amt'];
                                                if($row['paid']==0)
                                                { 
                                                  echo "Pending";
                                                }
                                                  elseif($row['taxamount']==$row4['amt'])
                                                    {
                                                      echo "Fully Paid";
                                                    }
                                                else{
                                                  echo "Partially Paid";
                                                } ?></td>
                                              
                                                <td>
                                                  <a href="edit_booking.php?id=<?=$row['id'];?>"class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                                  <a href="edit_payment.php?id=<?=$row['id'];?>"class="btn btn-xs btn-youtube">&#836z</a>
                                                  <a href="view_booking.php?id=<?=$row['id'];?>" class="btn btn-xs btn-instagram"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                          <?php  $i++;} 
                                          ?>

                                        </tbody>
                                    </table>
                                  </form>
                                </div>
                            </div>
                        </div>
               
                <!-- /# row -->

                <!-- End PAge Content -->
           

<?php include('footer.php');?>


<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script> 
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>