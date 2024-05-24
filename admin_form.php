<script src="<?php echo $base_assets ?>plugins/toastr/toastr.min.js"></script>
<?php
/*
Information Form Code :
1 : Username    3 : Access
2 : Password    4 : Menu
*/
function generate_password()
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $gen_password = substr( str_shuffle( $chars ), 0, 12 );
    return $gen_password;
}
if($action=='2')
{
    //print_r($_POST);
    //exit();
    $icon_form              = "fa-plus";
    $title_form             = "New Data";
    $card_form              = "primary";
    $username               = "";
    $password               = generate_password();
    $arr_access             = array();
    $arr_menu               = array();
    $visible                = "Y";
    $form_status_username   = "required";
    $form_status_password   = "disabled";
    $form_status_access     = "";
    $form_status_menu       = "";
    if(isset($_POST['submit']))
    {
        $username 		    = $_POST['username'];
        $password 			= $_POST['password'];
        if(isset($_POST['access']))
        {    
            $access_adm     = $_POST['access'];
            $arr_access     = $access_adm;
            $arr_access2    = implode("/", $access_adm);
        }
        else
        {
            $arr_access     = array();
            $arr_access2    = "";
        }    
        if(isset($_POST['menu']))
        {    
            $menu_adm       = $_POST['menu'];
            $arr_menu       = $menu_adm;
            $arr_menu2      = implode("/", $menu_adm);
        }
        else
        {
            $arr_menu       = array();
            $arr_menu2      = "";
        }  
        $visible 			= 'Y';
        if($username!=""&&$password!="")
        {
            $query_username = mysqli_query($con,"SELECT * FROM admin WHERE username='$username' AND visible!='D'");
            $sum_username   = mysqli_num_rows($query_username);
            if($sum_username==0)
            {
                $pass 			    = md5($password);
                $query_sort         = mysqli_query($con,"SELECT * from admin WHERE visible!='D' order by sortid DESC LIMIT 1")or die (mysqli_error($con));
                $sum_sort           = mysqli_num_rows($query_sort);
                if($sum_sort<=0)
                {
                    $last_sort      = 0;
                    $new_sort       = $last_sort;
                }
                else
                {
                    $data_sort      = mysqli_fetch_array($query_sort);
                    $last_sort      = $data_sort['sortid'];
                    $new_sort       = $last_sort+1;
                }
                $input 	            = mysqli_query($con,"INSERT into admin (sortid,username,password,access,menu,visible,failed_login,last_login,last_logout,block_login,create_by,create_date,update_by,update_date) VALUES ('$new_sort','$username','$pass','$arr_access2','$arr_menu2','$visible',0,'2001-01-01 00:00:00','2001-01-01 00:00:00','2001-01-01 00:00:00','$user','$now','$user','$now')")or die (mysqli_error($con));
                if($input==1)
                {
                    //update Log//
                    $log_menu   = "Admin Management";
                    $log_action = "Add";
                    $log_text   = "Add ".$username." Successfully!";
                    $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$user','$now')")or die (mysqli_error($con));
                    echo "
                    <script type='text/javascript'> 
                        toastr['success']('Submited Successfully!');
                        toastr.options = {
                            'showDuration': '3000'
                        }
                        var delay = 5000; 
                        setTimeout(function(){ window.location ='index.php?p=admin'; }, delay);
                    </script>";
                    //echo "<script type='text/javascript'> alert('Submited Successfully!');</script>";
                    //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=admin">';setTimeout(window.location.href='index.php?p=admin', 5000);
                }
            }
            else
            {
                echo "
                    <script type='text/javascript'> 
                        toastr['danger']('Submited Failed!');
                        toastr.options = {
                            'showDuration': '3000'
                        }
                        var delay = 5000;
                    </script>";
                $msg_username       = "username is available, please use another username";
            }    
        }	
    }
}
if($action=='3')
{
    $id         = $_GET['id'];
    $icon_form  = "fa-pen";
    $title_form = "Detail Data";
    $card_form  = "info";
    $query      = mysqli_query($con,"SELECT * from admin WHERE id='$id'")or die (mysqli_error($con));
    $data_query = mysqli_fetch_array($query);
    $username   = $data_query['username'];
    if(empty($form) || $form!='1')
    {
        $password   = $data_query['password'];
    }
    else
    {
        $password   = generate_password();   
    }
    $access_adm = $data_query['access'];
    $arr_access = explode("/", $access_adm);
    $menu_adm   = $data_query['menu'];
    $arr_menu   = explode("/", $menu_adm);
    if(isset($_POST['submit']))
    {
        $username 		    = $_POST['username'];
        $password 			= $_POST['password'];
        if(isset($_POST['access']))
        {    
            $access_adm     = $_POST['access'];
            $arr_access     = $access_adm;
            $arr_access2    = implode("/", $access_adm);
        }
        else
        {
            $arr_access     = array();
            $arr_access2    = "";
        }    
        if(isset($_POST['menu']))
        {    
            $menu_adm       = $_POST['menu'];
            $arr_menu       = $menu_adm;
            $arr_menu2      = implode("/", $menu_adm);
        }
        else
        {
            $arr_menu       = array();
            $arr_menu2      = "";
        }
        $update 	        = mysqli_query($con,"UPDATE admin SET $data_edit,update_by='$user',update_date='$now' WHERE id='$id'")or die (mysqli_error($con));
        if($update==1)
        {
            //update Log//
            $log_menu   = "Admin Management";
            $log_action = "Edit";
            $log_text   = "Edit ".$log_edit."  Successfully!";
            $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$user','$now')")or die (mysqli_error($con));
           /* echo "
                <script type='text/javascript'> 
                    toastr['success']('Updated Successfully!');
                    toastr.options = {
                        'showDuration': '3000'
                    }
                    setTimeout(window.location.href='index.php?p=admin_form&a=3&id=".$id.", 5000);
                </script>";*/
            echo "<script type='text/javascript'> alert('Updated Successfully!');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=admin_form&a=3&id='.$id.'">';
        }	
    }
    if(empty($form))
    {
        $form_status_username   = "disabled";
        $form_status_password   = "disabled";
        $form_status_access     = "disabled";
        $form_status_menu       = "disabled";
        $form                   = "";
    }
    elseif($form=='1')
    {
        $form_status_username   = "required";
        $form_status_password   = "disabled";
        $form_status_access     = "disabled";
        $form_status_menu       = "disabled";
    }
    elseif($form=='2')
    {
        $form_status_username   = "disabled";
        $form_status_password   = "required";
        $form_status_access     = "disabled";
        $form_status_menu       = "disabled";
    }
    elseif($form=='3')
    {
        $form_status_username   = "disabled";
        $form_status_password   = "disabled";
        $form_status_access     = "";
        $form_status_menu       = "disabled";
    }
    elseif($form=='4')
    {
        $form_status_username   = "disabled";
        $form_status_password   = "disabled";
        $form_status_access     = "disabled";
        $form_status_menu       = "";
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
                            <h1>USER MANAGEMENT</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5" id='f1'>
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Type something here...." value="<?php echo $username ?>" <?php echo $form_status_username ?>>
                                            <?php
                                            if(isset($msg_username))
                                            {
                                            ?>    
                                                <font color="red"><b>ERROR : <?php echo $msg_username ?></b></font>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>       
                                    <div class="col-md-5" id='f2'>
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <?php
                                            if($action==2 && empty($form))
                                            {
                                            ?>    
                                                <input type="hidden" name="password" value="<?php echo $password ?>">    
                                                <input type="text" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $password ?>" <?php echo $form_status_password ?>>
                                            <?php
                                            }
                                            elseif($action==3 && $form=="2")
                                            {
                                            ?>    
                                                <input type="hidden" name="password" value="<?php echo $password ?>">    
                                                <input type="text" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $password ?>" <?php echo $form_status_password ?>>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>    
                                                <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $password ?>" <?php echo $form_status_password ?>>
                                            <?php
                                            }    
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5" id='f3'>
                                        <div class="form-group">
                                            <label class="form-label">Access</label>
                                            <!-- checkbox -->
                                            <div class="form-group clearfix">
                                              <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxDanger1" name="access[]" value="2" <?php if(in_array('2', $arr_access)){ echo "checked"; } ?> <?php echo $form_status_access ?>>
                                                <label for="checkboxDanger3">
                                                  &nbsp ADD
                                                </label>
                                              </div>
                                              &nbsp&nbsp&nbsp
                                              <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary2" name="access[]" value="3" <?php if(in_array('3', $arr_access)){ echo "checked"; } ?> <?php echo $form_status_access ?>>
                                                <label for="checkboxPrimary3">
                                                  &nbsp EDIT
                                                </label>
                                              </div>
                                              &nbsp&nbsp&nbsp
                                              <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary3" name="access[]" value="4" <?php if(in_array('4', $arr_access)){ echo "checked"; } ?> <?php echo $form_status_access ?>>
                                                <label for="checkboxPrimary3">
                                                  &nbsp DELETE
                                                </label>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-11" id='f4'>
                                        <div class="form-group">
                                            <table border=0 width="100%">
                                            <tr style="height: 50px;">
                                                <th> MENU </th>
                                                <th style="text-align: right;"><input type="checkbox" onchange="checkAll(this)" name="menuall[]" <?php echo $form_status_menu ?> style="margin-right: 20px;"></th>
                                            </tr>
                                            <?php
                                            if($username=='developer')
                                            {
                                                $access_code    ="";
                                            }
                                            else
                                            {
                                                $access_code    ="AND access='0'";    
                                            }
                                            $query_menu_act = mysqli_query($con,"SELECT * from menu WHERE parentid='0' AND visible='Y' $access_code order by sortid ASC")or die (mysqli_error($con));
                                            $sum_menu_act   = mysqli_num_rows($query_menu_act);
                                            if($sum_menu_act>0)
                                            {
                                                $no=1;
                                                while($data_menu_act=mysqli_fetch_array($query_menu_act))
                                                {
                                                    $id_menu_act        = $data_menu_act['id'];
                                                    $name_menu_act      = $data_menu_act['menu'];
                                                    if ($no % 2 == 0)
                                                    {
                                                        $clr_row = "background-color: #ffffff;";
                                                    }
                                                    else
                                                    {
                                                        $clr_row = "background-color: #D9D9D9B2;";
                                                    }
                                            ?>
                                                    <tr style="height: 50px;<?php echo $clr_row ?>">
                                                        <td style="font-size: large;"> &nbsp <?php echo $name_menu_act ?> </td>
                                                        <td style="text-align: right;"> <input type="checkbox" name="menu[]" style="margin-right: 20px;" value="<?php echo $id_menu_act ?>" <?php if(in_array($id_menu_act, $arr_menu)){ echo "checked"; } ?> <?php echo $form_status_menu ?>> </td>
                                                    </tr>    
                                            <?php
                                                    $query_submenu_act  = mysqli_query($con,"SELECT * from menu WHERE parentid='$id_menu_act' AND visible='Y' $access_code $access_code order by sortid ASC")or die (mysqli_error($con));
                                                    $sum_submenu_act    = mysqli_num_rows($query_submenu_act);
                                                    if($sum_submenu_act>0)
                                                    {
                                                        while($data_submenu_act=mysqli_fetch_array($query_submenu_act))
                                                        {
                                                            $id_submenu_act        = $data_submenu_act['id'];
                                                            $name_submenu_act      = $data_submenu_act['menu'];
                                            ?>
                                                            <tr style="height: 50px;<?php echo $clr_row ?>">
                                                                <td style="font-size: large;"> &nbsp&nbsp&nbsp - <?php echo $name_submenu_act ?> </td>
                                                                <td style="text-align: right;"> <input type="checkbox" name="menu[]" style="margin-right: 20px;" value="<?php echo $id_submenu_act ?>" <?php if(in_array($id_submenu_act, $arr_menu)){ echo "checked"; } ?> <?php echo $form_status_menu ?>> </td>
                                                            </tr>
                                            <?php  
                                                        }
                                                    }
                                                    $no++;          
                                                }    
                                            }    
                                            ?> 
                                            </table>   
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div> 
                                </div>   
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer" style="background-color: unset;">
                                <div class="row">
                                    <div class="col-md-11">
                                        <table border=0 width="100%">
                                            <tr>
                                                <td>
                                                    <a href='index.php?p=admin'><button type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;border-color: #88A8D4;"> Back </button></a>
                                                </td>    
                                                <?php
                                                if($action==3)
                                                {
                                                ?>    
                                                    <td style="text-align: right;">
                                                        <a href='index.php?p=admin'><button type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;"> Edit </button></a>
                                                    </td>
                                                <?php    
                                                }
                                                else
                                                {
                                                ?>
                                                    <td style="text-align: right;">
                                                        <button type="submit" class="btn" name="submit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">Submit</button>
                                                    </td> 
                                                <?php
                                                }
                                                ?>       
                                            </tr>
                                        </table>
                                    </div>
                                </div>        
                            </div>   
                        </form>
                        </div>
                        <!-- /.card -->
                        </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>    