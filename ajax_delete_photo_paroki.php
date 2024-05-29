<?php
    include("config.php");
    $id_paroki      = $_POST['id_paroki'];
    $delete_photo   = mysqli_query($con,"UPDATE paroki_staff SET url_img='' WHERE id='$id_paroki'")or die (mysqli_error($con));
    if($delete_photo==1)
    {
        $delete_json      = array(
            'delete_status' => 1,
            'delete_msg'    => "Delete Success"
        );
    }
    else
    {
        $delete_json      = array(
            'delete_status' => 0,
            'delete_msg'    => "Delete Failed"
        );
    }
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($delete_json);
?>