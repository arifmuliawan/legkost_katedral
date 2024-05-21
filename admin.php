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
                                    <tbody>
                                        <?php
                                        if($sum_query>0)
                                        {
                                            $no=1;
                                            while($data_query=mysqli_fetch_array($query))
                                            {
                                                $id         = $data_query['id'];
                                                $username   = $data_query['username'];
                                                $password   = "**********";
                                                $access     = $data_query['access'];
                                                $last_login = $data_query['last_login'];
                                                $last_logout= $data_query['last_logout'];
                                                $visible    = $data_query['visible'];
                                                if($visible=='Y')
                                                {
                                                    $icon_visible   = 'fa fa-unlock';
                                                    $color_visible  = 'success';
                                                    $text_visible   = 'Active';
                                                    $check_visible  = '';
                                                    $value_visible  = 'N';
                                                }
                                                else
                                                {
                                                    $icon_visible   = 'fa fa-lock';
                                                    $color_visible  = 'danger';
                                                    $text_visible   = 'InActive';
                                                    $check_visible  = 'checked';
                                                    $value_visible  = 'Y';
                                                }
                                                if ($no % 2 == 0)
                                                {
                                                    $clr_row = "background-color: #D9D9D9B2;";
                                                }
                                                else
                                                {
                                                    $clr_row = "background-color: #ffffff;";
                                                }
                                        ?>
                                                <tr style="<?php echo $clr_row ?>">
                                                    <td><?php echo $username ?></td>
                                                    <td><?php echo $password ?></td>
                                                    <td><?php echo $last_login ?></td>
                                                    <td><?php echo $last_logout ?></td>
                                                    <td style="min-width: 130px;display: flex;align-items: center;justify-content: center;">
                                                        <?php
                                                        if(in_array(3,$arr_usracc))
                                                        {
                                                        ?>    
                                                            <a href="index.php?p=admin_form&a=3&id=<?php echo $id ?>">
                                                                <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>    
                                                        &nbsp&nbsp&nbsp
                                                        <?php
                                                        if(in_array(4,$arr_usracc))
                                                        {
                                                        ?>
                                                            <a href="index.php?p=admin&a=4&id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>  
                                                        <!--<button type="button" class="btn btn-sm btn-<?php echo $color_visible ?>" style="pointer-events: none;"><i class="<?php echo $icon_visible ?>"></i> <?php echo $text_visible ?> </button>-->
                                                        <?php
                                                        if(in_array(3,$arr_usracc))
                                                        {
                                                            $stt_form   ='';
                                                        }
                                                        else
                                                        {
                                                            $stt_form   ='disabled';   
                                                        }    
                                                        ?>
                                                        <form id="checkgo" method="post" style="margin-left: 12px;">
                                                            <input type="hidden" name="id" value="<?php echo $id ?>" id="id<?php echo $id ?>">
                                                            <input type="hidden" name="tbname" value="admin" id="tbname<?php echo $id ?>">
                                                            <div class="button r" id="button-1">
                                                                <input type="checkbox" onchange="doThis<?php echo $id ?>(this)" name="wegeb" id="wegep<?php echo $id ?>" value="<?php echo $value_visible ?>" class="checkbox" <?php echo $check_visible ?>  <?php echo $stt_form ?>/>
                                                                <div class="knobs"></div>
                                                                <div class="layer"></div>
                                                            </div>
                                                        </form>  
                                                        <script>
                                                            function doThis<?php echo $id ?>(checkbox){
                                                            var wegeb   = document.getElementById("wegep<?php echo $id ?>").value
                                                            var id      = document.getElementById("id<?php echo $id ?>").value
                                                            var tbname  = document.getElementById("tbname<?php echo $id ?>").value
                                                            var info = {wegeb: wegeb,id: id,tbname: tbname};
                                                            $.ajax({
                                                                type : "POST",
                                                                url : "change_visible.php",
                                                                data : info,
                                                                success: function(){
                                                                    document.getElementById("wegep<?php echo $id ?>").value = wegeb == 'Y'?'N':'Y'  
                                                                },
                                                                error: function(){
                                                                     document.getElementById("wegep<?php echo $id ?>").value = wegeb
                                                                }
                                                                });
                                                                return false;
                                                            }   
                                                        </script>   
                                                    </td>
                                                </tr>
                                        <?php
                                                $no++;
                                            }
                                        }
                                        ?>            
                                    </tbody>
                                    </table>
                                    <br><br><br>    
                                    <table class="table table-bordered">
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Last Login</th>
                                        <th>Last Logout</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody class="row_position">
                                    <?php
                                        if($sum_query>0)
                                        {
                                            $no=1;
                                            while($data_query=mysqli_fetch_array($query))
                                            {
                                                $id         = $data_query['id'];
                                                $sortid     = $data_query['sortid'];
                                                $username   = $data_query['username'];
                                                $password   = "**********";
                                                $access     = $data_query['access'];
                                                $last_login = $data_query['last_login'];
                                                $last_logout= $data_query['last_logout'];
                                                $visible    = $data_query['visible'];
                                                if($visible=='Y')
                                                {
                                                    $icon_visible   = 'fa fa-unlock';
                                                    $color_visible  = 'success';
                                                    $text_visible   = 'Active';
                                                    $check_visible  = '';
                                                    $value_visible  = 'N';
                                                }
                                                else
                                                {
                                                    $icon_visible   = 'fa fa-lock';
                                                    $color_visible  = 'danger';
                                                    $text_visible   = 'InActive';
                                                    $check_visible  = 'checked';
                                                    $value_visible  = 'Y';
                                                }
                                                if ($no % 2 == 0)
                                                {
                                                    $clr_row = "background-color: #D9D9D9B2;";
                                                }
                                                else
                                                {
                                                    $clr_row = "background-color: #ffffff;";
                                                }
                                        ?>
                                                <tr style="<?php echo $clr_row ?>" id="<?php echo $id ?>>
                                                    <td><?php echo $username ?></td>
                                                    <td><?php echo $password ?></td>
                                                    <td><?php echo $last_login ?></td>
                                                    <td><?php echo $last_logout ?></td>
                                                    <td style="min-width: 130px;display: flex;align-items: center;justify-content: center;">
                                                        <?php
                                                        if(in_array(3,$arr_usracc))
                                                        {
                                                        ?>    
                                                            <a href="index.php?p=admin_form&a=3&id=<?php echo $id ?>">
                                                                <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>    
                                                        &nbsp&nbsp&nbsp
                                                        <?php
                                                        if(in_array(4,$arr_usracc))
                                                        {
                                                        ?>
                                                            <a href="index.php?p=admin&a=4&id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>  
                                                        <!--<button type="button" class="btn btn-sm btn-<?php echo $color_visible ?>" style="pointer-events: none;"><i class="<?php echo $icon_visible ?>"></i> <?php echo $text_visible ?> </button>-->
                                                        <?php
                                                        if(in_array(3,$arr_usracc))
                                                        {
                                                            $stt_form   ='';
                                                        }
                                                        else
                                                        {
                                                            $stt_form   ='disabled';   
                                                        }    
                                                        ?>
                                                        <form id="checkgo" method="post" style="margin-left: 12px;">
                                                            <input type="hidden" name="id" value="<?php echo $id ?>" id="id<?php echo $id ?>">
                                                            <input type="hidden" name="tbname" value="admin" id="tbname<?php echo $id ?>">
                                                            <div class="button r" id="button-1">
                                                                <input type="checkbox" onchange="doThis<?php echo $id ?>(this)" name="wegeb" id="wegep<?php echo $id ?>" value="<?php echo $value_visible ?>" class="checkbox" <?php echo $check_visible ?>  <?php echo $stt_form ?>/>
                                                                <div class="knobs"></div>
                                                                <div class="layer"></div>
                                                            </div>
                                                        </form>  
                                                        <script>
                                                            function doThis<?php echo $id ?>(checkbox){
                                                            var wegeb   = document.getElementById("wegep<?php echo $id ?>").value
                                                            var id      = document.getElementById("id<?php echo $id ?>").value
                                                            var tbname  = document.getElementById("tbname<?php echo $id ?>").value
                                                            var info = {wegeb: wegeb,id: id,tbname: tbname};
                                                            $.ajax({
                                                                type : "POST",
                                                                url : "change_visible.php",
                                                                data : info,
                                                                success: function(){
                                                                    document.getElementById("wegep<?php echo $id ?>").value = wegeb == 'Y'?'N':'Y'  
                                                                },
                                                                error: function(){
                                                                     document.getElementById("wegep<?php echo $id ?>").value = wegeb
                                                                }
                                                                });
                                                                return false;
                                                            }   
                                                        </script>   
                                                    </td>
                                                </tr>
                                        <?php
                                                $no++;
                                            }
                                        }
                                        ?>
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