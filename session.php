<?php
$now 		= date('Y-m-d H:i:s');
$user		= $_COOKIE['username'];
$query		= mysqli_query($con,"SELECT * from admin WHERE username='$user'");
$sum_query	= mysqli_num_rows($query);
if($sum_query>0)
{
	$data_query	= mysqli_fetch_array($query);
	$username	= $data_query['username'];
	$visible	= $data_query['visible'];
	$arr_usrmenu= explode("/", $data_query['menu']);
	$arr_usracc	= explode("/", $data_query['access']);
}
else
{
	//session_unset();
    setcookie("username", "", time() - (86400 * 30), "/");
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
}
?>