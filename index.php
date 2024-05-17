<?php
include('config.php');
$timenow    = date("Y-m-d H:i:s");
if(isset($_COOKIE['username']) && isset($_COOKIE['token']))
{
    $user		= $_COOKIE['username'];
    $token      = $_COOKIE['token'];
}
else
{
    $user		= "";
    $token      = "";
}    
$query_log  = mysqli_query($con,"SELECT * from login_log WHERE username='$user' AND token='$token' AND start_time <= '$timenow' AND end_time >= '$timenow'")or die (mysqli_error($con));
$sum_log    = mysqli_num_rows($query_log);
if($sum_log<=0)
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
}
else
{ 
    if(isset($_GET['p']) && $_GET['p']=='logout')
    {
        //session_unset();
        setcookie("token", "", time() - (3600 * 3), "/");
        setcookie("username", "", time() - (3600 * 30), "/");
        $update_log = mysqli_query($con,"UPDATE admin SET last_logout='$timenow' WHERE username='$user'")or die (mysqli_error($con));
        $update_log = mysqli_query($con,"UPDATE login_log SET end_time='$timenow' WHERE username='$user' AND token='$token'")or die (mysqli_error($con));
        if($update_log==1)
        {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
        }    
    }
    else
    {
        if(empty($_GET['p']))
        {
            $page   = 'admin';
        }
        else
        {
            $page   = $_GET['p'];
        }
        if(isset($_GET['a']))
        {
            $action = $_GET['a'];
        }
        if(isset($_GET['id']))
        {
            $id     = $_GET['id'];
        }
        if(isset($_GET['f']))
        {
            $form   = $_GET['f'];
        }
        if(isset($_GET['tid']))
        {
            $tid    = $_GET['tid'];
        }
        if(isset($_GET['sid']))
        {
            $sid    = $_GET['sid'];
        }
        if(isset($_GET['pid']))
        {
            $pid = $_GET['pid'];
        }
        if(isset($_GET['prid']))
        {
            $prid = $_GET['prid'];
        }
        include('header.php');
        include('session.php');
        include('menu.php');
        include($page.'.php');    
        include('footer.php');
    }    
}    
?>