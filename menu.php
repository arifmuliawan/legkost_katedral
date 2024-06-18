<?php
include('session.php');
if($username=='developer')
{
    $access_code    ="";
}
else
{
    $access_code    ="AND access='0'";    
}
$query_menu = mysqli_query($con,"SELECT * from menu WHERE parentid='0' AND visible='Y' $access_code order by sortid ASC")or die (mysqli_error($con));
?>    
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#88A8D4;position: fixed;">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <center>
                    <span class="brand-text font-weight-light">
                        <img src="assets/dist/img/Logo_Katedral.png" width="150px">
                    </span>
                </center>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="assets/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block" style="color:white"><?php echo strtoupper($user); ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <?php
                    while($data_menu=mysqli_fetch_array($query_menu))
                    {
                        $id_menu        = $data_menu['id'];
                        $name_menu      = $data_menu['menu'];
                        $file_menu      = $data_menu['file'];
                        $query_submenu  = mysqli_query($con,"SELECT * from menu WHERE parentid='$id_menu' AND visible='Y' $access_code order by sortid ASC")or die (mysqli_error($con));
                        $sum_submenu    = mysqli_num_rows($query_submenu);
                        if (in_array($id_menu, $arr_usrmenu))
                        {
                            if($sum_submenu<=0)
                            {    
                    ?>
                             <li class="nav-item">
                                <?php
                                if(preg_match("/$file_menu/i", $page))
                                {
                                    $act_menu    = "active";
                                    $act_bold    = "font-weight: bold;";
                                }
                                else
                                {
                                    $act_menu    = "";
                                    $act_bold    = "";
                                }
                                ?>
                                <a href="index.php?p=<?php echo $file_menu ?>" class="nav-link <?php echo $act_menu ?>" style="background-color: unset;box-shadow: unset;color:#fff;<?php echo $act_bold ?>">
                                    <p> <?php echo $name_menu ?> </p>
                                </a>
                            </li>
                    <?php 
                            }
                            else
                            {
                                if(preg_match("/$file_menu/i", $page)) 
                                {
                                    $drop_com   = "menu-is-opening menu-open";
                                    $disp_com   = "block";
                                    $bold_com   = 'style="color: #fff;background-color: unset;box-shadow: unset;font-weight: bold;color: #fff;"';
                                }
                                else
                                {
                                    $drop_com   = "";
                                    $disp_com   = "none";
                                    $bold_com   = 'style="color:#fff"';
                                }
                    ?>    
                                <li class="nav-item <?php echo $drop_com ?>">
                                    <a href="#" class="nav-link" <?php echo $bold_com ?>>
                                    <p>
                                        <?php echo $name_menu ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: <?php echo $disp_com ?>;">
                                        <?php
                                        while($data_submenu=mysqli_fetch_array($query_submenu))
                                        {
                                            $id_submenu     = $data_submenu['id'];
                                            $name_submenu   = $data_submenu['menu'];
                                            $file_submenu   = $data_submenu['file'];
                                            if (in_array($id_submenu, $arr_usrmenu))
                                            {
                                        ?>    
                                                <li class="nav-item">
                                                    <?php
                                                    if($page==$file_submenu)
                                                    {
                                                        $act_submenu = "active";
                                                        $act_bgclr   = 'style="color: #fff;background-color: unset;box-shadow: unset;font-weight: bold;color: #fff;"';
                                                        $act_icon    = "fa fa-circle nav-icon"; 
                                                    }
                                                    else
                                                    {
                                                        $act_submenu = "";
                                                        $act_bgclr   = "";
                                                        $act_icon    = "far fa-circle nav-icon";
                                                    }
                                                    ?>
                                                    <a href="index.php?p=<?php echo $file_submenu ?> " class="nav-link <?php echo $act_submenu ?>" <?php echo $act_bgclr ?> style="background-color: unset;box-shadow: unset;">
                                                    <i class="<?php echo $act_icon ?>"></i>
                                                    <p><?php echo $name_submenu ?></p>
                                                    </a>
                                                </li>
                    <?php 
                                            }
                                        }
                    ?>
                                    </ul>
                                </li>
                    <?php                                                           
                            }    
                        }   
                    }    
                    ?>
                    <li class="nav-item">
                        <a href="index.php?p=logout" class="nav-link" style="color:white">
                            <p> Logout </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>