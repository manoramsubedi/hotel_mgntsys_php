<?php require_once('check_login.php');?>
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>
 <?php include('connect.php');?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                </div>
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-6" style="margin-left: 300px">
                        <div class="card">
                            <div class="card-title">
                                <h4>Discount Details</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="form-horizontal" method="POST" action="pages/save_discount.php" name="discountform" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Discount Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="discountname" class="form-control" placeholder="Discount Name">
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Percentage</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="percentage" class="form-control" placeholder="Percentage" required="">
                                                </div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Expiry Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="expirydate" class="form-control" placeholder="Expiry Date" required="">
                                                </div>
                                        </div>

                                        <button type="submit" name="btn_save" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!-- /# row -->


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
         
</body>

</html>
<?php include('footer.php');?>