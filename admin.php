<?php
$query      = mysqli_query($con,"SELECT * from admin WHERE visible!='D'")or die (mysqli_error($con));
$sum_query  = mysqli_num_rows($query);
if(isset($action))
{
    if($action=='4')
    {
        $update     = mysqli_query($con,"UPDATE admin SET visible='D',update_by='$user',update_date='$now' WHERE id='$id'")or die (mysqli_error($con));
        $query_del  = mysqli_query($con,"SELECT * from admin WHERE id='$id'")or die (mysqli_error($con));
        $data_del   = mysqli_fetch_array($query_del);
        $user_del   = $data_del['username'];
        if($update==1)
        {
            //update Log//
            $log_menu   = "Admin Management";
            $log_action = "Delete";
            $log_text   = "Delete ".$user_del." Successfully!";
            $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$user','$now')")or die (mysqli_error($con));
            echo "<script type='text/javascript'> alert('Deleteted Successfully!');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=admin">';
        }
    }
}
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="margin: 24px">USER MANAGEMENT</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: unset;">
                                <div class="card-header" style="border-bottom: unset;">
                                    <div class="row">
                                        <div class="col-md-10">
                                            
                                        </div>
                                        <div class="col-md-2" style="text-align: end;">
                                            <?php
                                            if(in_array(2,$arr_usracc))
                                            {
                                            ?>    
                                                <a href="index.php?p=admin_form&a=2"><button type="button" class="btn" style="background-color: #88A8D4;color: #ffffff;"><i class="fa fa-plus"></i> New Data</button></a>
                                            <?php
                                            }
                                            ?>    
                                        </div>
                                    </div>
                                </div>        
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table" style="text-align: center;">
                                    <thead style="background-color: #88A8D4;color: #ffffff;">
                                        <tr>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Last Login</th>
                                            <th>Last Logout</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row_position">
                                        <tr style="" id="1">
                                        </tr>
                                                    
                                    </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->