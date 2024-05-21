<?php
    include('config.php');
    include('session.php');
    $now            = date('Y-m-d H:i:s');
    $wegep          = $_POST['wegeb'];
    $id             = $_POST['id'];
    $tbname         = $_POST['tbname'];
    $update 	    = mysqli_query($con,"UPDATE $tbname SET visible='$wegep',update_date='$now' WHERE id='$id'")or die('ERROR: '. mysqli_error($con));;
    if($update==1)
    {
        //update Log//
        if($tbname=='admin')
        {
            $log_menu   = "Admin Management";
            $query_edt  = mysqli_query($con,"SELECT * from admin WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['username'];
        }    
        if($tbname=='menu')
        {
            $log_menu   = "Menu Management";
            $query_edt  = mysqli_query($con,"SELECT * from menu WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['menu'];
        }
        $log_action = "Edit";
        $log_text   = "Edit visible ".$wegep." - ".$user_edt."  Successfully!";
        $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$user','$now')")or die (mysqli_error($con));
    }
    echo "$wegep|$id|$tbname|$update|$now";
    
?>