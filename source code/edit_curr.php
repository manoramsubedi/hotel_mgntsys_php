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
    $q1="UPDATE `tbl_currency` SET `currcode`='$currcode',`currsymbol`='$currsymbol' WHERE `id`='".$_GET['id']."'";
    //$q2=$conn->query($q1);
    if ($conn->query($q1) === TRUE) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_curr.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_curr.php";
</script>
<?php
}
}
?>
<?php
$que="SELECT * FROM `tbl_currency` WHERE id='".$_GET["id"]."'";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
    //print_r($row);
    extract($row);
$currcode = $row['currcode'];
$currsymbol = $row['currsymbol'];
}

?> 


<!-- Page wrapper  -->

         <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Customer Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Customer Management</li>
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
                                            <label class="col-lg-4 col-form-label" for="val-username">Currrency Code : <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-username" name="currcode" value="<?php echo $currcode; ?>" placeholder="Enter a Currrency Code.." required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-email">Currrency Symbol : <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-email" name="currsymbol" value="<?php echo $currsymbol; ?>" placeholder="Your valid Currrency Symbol.." required="">
                                            </div>
                                        </div>
                                       
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
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Customer Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Customer Management</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="customerform">

                                   <input type="hidden" name="currnt_date" class="form-control" value="<?php echo $currnt_date;?>">

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Currency Code</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="currcode" class="form-control" placeholder="Currency Code" id="event" onkeydown="return alphaOnly(event);" value="<?php echo $currcode; ?>" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Currency Symbol</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="currsymbol" class="form-control" placeholder="Currency Symbol" value="<?php echo $currsymbol; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                       
                                       <button type="submit" name="btn_update" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               
                <!-- /# row -->

                <!-- End PAge Content -->
    

<?php include('footer.php');?>

