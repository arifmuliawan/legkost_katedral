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
        if($tbname=='info_mng')
        {
            $query_edt  = mysqli_query($con,"SELECT * from info_mng WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['title_en'];
            $code_edt   = $data_edt['code'];
            if($code_edt==3)
            {
                $log_menu   = "Investor - NAV Management";
            }
        }
        if($tbname=='leader_position')
        {
            $log_menu   = "Company - Leadership Position Management";
            $query_edt  = mysqli_query($con,"SELECT * from leader_position WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['title_en'];
        }
        if($tbname=='leader_member')
        {
            $log_menu   = "Company - Leadership Member Management";
            $query_edt  = mysqli_query($con,"SELECT * from leader_member WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['fullname'];
        }
        if($tbname=='document_menu')
        {
            $log_menu   = "Document Menu Management";
            $query_edt  = mysqli_query($con,"SELECT * from document_menu WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['menu'];
        }
        if($tbname=='document_list')
        {
            $log_menu   = "Document List Management";
            $query_edt  = mysqli_query($con,"SELECT * from document_list WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['title_en'];
        }
        if($tbname=='devidend_mng')
        {
            $log_menu   = "Investor Management - Devidend Information";
            $query_edt  = mysqli_query($con,"SELECT * from devidend_mng WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['fiscal_year'];
        }
        if($tbname=='portfolio_mng')
        {
            $log_menu   = "Portfolio Management";
            $query_edt  = mysqli_query($con,"SELECT * from portfolio_mng WHERE id='$id'")or die (mysqli_error($con));
            $data_edt   = mysqli_fetch_array($query_edt);
            $user_edt   = $data_edt['client'];
        }
        $log_action = "Edit";
        $log_text   = "Edit visible ".$wegep." - ".$user_edt."  Successfully!";
        $update_log = mysqli_query($con,"INSERT into `log` (`menu`,`action`,`log`,`create_by`,`create_date`) VALUES ('$log_menu','$log_action','$log_text','$user','$now')")or die (mysqli_error($con));
    }
    echo "$wegep|$id|$tbname|$update|$now";
    
?>