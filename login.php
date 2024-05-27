<?php
require('config.php');
function getRandomStringRandomInt($length = 16)
{
    $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pieces = [];
    $max = mb_strlen($stringSpace, '8bit') - 1;
    for ($i = 0; $i < $length; ++ $i) {
        $pieces[] = $stringSpace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
$now=date("Y-m-d H:i:s");
if(isset($_POST['submit']))
{
	$username 			= $_POST['username'];
	$password 			= $_POST['password'];
	if($username=="")
	{
		$msg 	        = "Username is required";
	}
	if($password=="")
	{
		$msg 	        = "Password is required";
	}
	if($username!=""&&$password!="")
	{
		$pass 			= md5($password);
		if($username!='developer')
		{	
			$query 	    = mysqli_query($con,"SELECT * from admin WHERE username='$username' AND password='$pass' AND visible='Y' AND block_login<'$now'")or die (mysqli_error($con));
		}
		else
		{
			$query 		= mysqli_query($con,"SELECT * from admin WHERE username='$username' AND password='$pass' AND block_login<'$now'")or die (mysqli_error($con));
		}	
		$sum_query 		= mysqli_num_rows($query);
		if($sum_query>0)
		{
			$data       = mysqli_fetch_array($query);
            if($data['menu']!="")
            {
                $token                  = getRandomStringRandomInt();
                //$_SESSION["token"]      = $token;
                setcookie("token", $token, time() + (3600 * 3), "/");
                //setcookie("token", $token, time() + (300), "/");
                //$_SESSION["username"]   = $username;
                setcookie("username", $username, time() + (3600 * 3), "/");
                //setcookie("username", $username, time() + (300), "/");
                $end_time               = date('Y-m-d H:i:s', strtotime('+3 hours', strtotime($now)));//date('Y-m-d').' 23:59:59';
                $expired_time           = date('Y-m-d H:i:s', strtotime('-3 days', strtotime($now)));
                $query_login_log 	    = mysqli_query($con,"SELECT * from login_log WHERE username='$username' AND end_time>='$now'")or die (mysqli_error($con));
                $sum_login_log          = mysqli_num_rows($query_login_log);
                if($sum_log<=3)
                {
                    //update Log//
                    $log_menu               = "Login";
                    $log_action             = "Login";
                    $log_text               = "Login Success";
                    $update_log             = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$username','$now')")or die (mysqli_error($con));
                    $update 	            = mysqli_query($con,"UPDATE admin SET last_login='$now',failed_login='0' WHERE username='$username'");
                    $insert_login_log       = mysqli_query($con,"INSERT INTO `login_log`(`username`, `token`, `start_time`, `end_time`, `create_by`, `create_date`) VALUES ('$username','$token','$now' ,'$end_time','$username','$now')");
                    $delete_log             = mysqli_query($con,"DELETE FROM `login_log` WHERE end_time < '$expired_time'");
                    $idmenu                 = explode("/", $data['menu']);
                    foreach ($idmenu as $idmenu) 
                    {
                        $query_menu = mysqli_query($con,"SELECT * from menu WHERE id='$idmenu' AND visible='Y'")or die (mysqli_error($con));
                        $sum_menu   = mysqli_num_rows($query_menu);
                        if($sum_menu>0)
                        {
                            $data_menu  = mysqli_fetch_array($query_menu);
                            $file_menu  = $data_menu['file'];
                            header("location: index.php?p=".$file_menu);
                            break;
                        }    
                    }
                }
                else
                {
                    $msg 		    = "To Login, first logout from another device";
                    //update Log//
                    $log_menu       = "Login";
                    $log_action     = "Login";
                    $log_text       = "Login Failed - To Login, first logout from another device";
                    $update_log     = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$username','$now')")or die (mysqli_error($con));
                }    
            }
            else
            {
                $msg        = "Sorry You don't Have Access to Any Menu";
                //update Log//
                $log_menu   = "Login";
                $log_action = "Login";
                $log_text   = "Login Failed - Sorry You do not Have Access to Any Menu";
                $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$username','$now')")or die (mysqli_error($con));
            }    
		}
		else
		{
            $query_failed     = mysqli_query($con,"SELECT * from admin WHERE username='$username'")or die (mysqli_error($con));
            $sum_failed       = mysqli_num_rows($query_failed);
            if($sum_failed>0)
            {
                $data_failed      = mysqli_fetch_array($query_failed);
                $failed_login     = $data_failed['failed_login'];
                $block_login      = $data_failed['block_login'];
            }
            else
            {
                $failed_login     = 0;
                $block_login      = "0000-00-00 00:00:00";
            }
            if($failed_login<3)
            {
                $new_failed   = $failed_login+1;  
                $update       = mysqli_query($con,"UPDATE admin SET failed_login='$new_failed' WHERE username='$username'")or die (mysqli_error($con));  
                if($block_login>$now)
                {
                    $msg          = "Sorry, Your Account has been blocked due to security reasons, Try again after 10 minutes";
                } 
                else
                {
                    $msg          = "The username or password is incorrect"; 
                }  
                //update Log//
                $log_menu   = "Login";
                $log_action = "Login";
                $log_text   = "Login Failed - ".$msg;
                $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$username','$now')")or die (mysqli_error($con));  
            } 
            else
            {
                if($block_time<=$now)
                {
                    $block_user   = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($now)));  
                    $update       = mysqli_query($con,"UPDATE admin SET failed_login='0',block_login='$block_user' WHERE username='$username'")or die (mysqli_error($con));
                }     
                $msg          = "Sorry, Your Account has been blocked due to security reasons, Try again after 10 minutes";
                //update Log//
                $log_menu   = "Login";
                $log_action = "Login";
                $log_text   = "Login Failed - ".$msg;
                $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$username','$now')")or die (mysqli_error($con));
            }
		}
	}	
}
else
{
    $username 			= "";
	$password 			= "";
    $msg 		        = "Sign in to start your session";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LederHaus Administrator</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets//plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-color:88A8D4;background-size:cover">
    <div class="login-box">
        <div class="login-logo">
            <img src="assets/dist/img/Logo_Katedral.png" width="300px">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                
                <p class="login-box-msg">
                    <?php echo $msg ?>
                </p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $username ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" class="btn btn-primary btn-block" name="submit" style="background-color: #88A8D4;border-color: #88A8D4;">Login</button>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
