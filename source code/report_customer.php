<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');

 date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');?>

<!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Customer Report</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Customer Report</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <form class="form-horizontal" method="POST" name="bookingreportform" enctype="multipart/form-data">

                  <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">

                  <div class="form-group">
                      <div class="row">
                         <label class="col-sm-3 control-label">From Date  :</label>
                            <div>
                                <input type="date" name="fromDate" class="form-control" placeholder="fromDate">
                            </div>
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <div class="row">
                         <label class="col-sm-3 control-label">To Date  :</label>
                            <div>
                                <input type="date" name="toDate" class="form-control" placeholder="toDate">
                            </div>
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <div class="row">
                         
                            <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;<input type="submit" name="Done" value="Done">  
                            </div>
                      </div>
                  </div>

                  
                </form>
                <!-- /# row -->
              <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Customer Report</h4>
                                
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                  <th>Sr.No.</th>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Birth Date</th>
                                                <th>Contact No.</th>
                                                <th>Address</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>Sr.No.</th>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Birth Date</th>
                                                <th>Contact No.</th>
                                                <th>Address</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    if(isset($_POST['Done']))
                                    {
                                      $fromDate = $_POST['fromDate'];
                                      $toDate = $_POST['toDate'];
                                      $sql = "SELECT * FROM `tbl_customer` WHERE created_date BETWEEN '".$_POST['fromDate']."' AND '".$_POST['toDate']."' ";
                                   /* }
                                    else
                                    {
                                      $sql = "SELECT * FROM `tbl_customer`";
                                    }
                                    
*/                                     $result = $conn->query($sql);
                                     $i=1;
                                     while($row = $result->fetch_assoc()) { 

                                      ?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['birthdate']; ?></td>
                                                <td><?php echo $row['contact']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo $row['created_date']; ?></td>
                                            </tr>
                                          <?php $i++; } ?>
                                        </tbody> <?php  } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       
                <!-- /# row -->

                <!-- End PAge Content -->
           

<?php include('footer.php');?>

<link rel="stylesheet" href="popup_style.css">
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