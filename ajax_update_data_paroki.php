<?php
    include("config.php");
    $id_paroki      = $_POST['id_paroki'];
    $nama_paroki    = $_POST['nama_paroki'];
    $jabatan_paroki = $_POST['jabatan_paroki'];
    $update_paroki  = mysqli_query($con,"UPDATE paroki_staff SET `name`='$nama_paroki', `position`='$jabatan_paroki',`update_date`='$now' WHERE id='$id_paroki'")or die (mysqli_error($con));
    if($update_paroki==1)
    {
        $update_json      = array(
            'update_status' => 1
        );
    }
    else
    {
        $update_json      = array(
            'update_status' => 0
        );
    }
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($update_json);
?>