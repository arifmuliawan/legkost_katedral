<?php
$data_edit      = "last_logout='".$now."'";
$update 	    = mysqli_query($con,"UPDATE admin SET $data_edit,update_by='$user',update_date='$now' WHERE username='$user'")or die (mysqli_error($con));
//update Log//
$log_menu   = "Logout";
$log_action = "Logout";
$log_text   = "Logout Success";
$update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$user','$now')")or die (mysqli_error($con));
session_unset();
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
?>