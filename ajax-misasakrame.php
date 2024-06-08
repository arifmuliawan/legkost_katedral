<?php
include("config.php");
include("session.php");
//include("session.php");
//print_r($_POST);
//exit();
if(isset($_POST['reset_schedule_misa']))
{
    $scheduleid         = $_POST['scheduleid'];
    $select_schedule    = mysqli_query($con,"SELECT * FROM misa_schedule WHERE id='$schedule' AND visible='Y'") or die (mysqli_error($con));
    $sum_schedule       = mysqli_num_rows($select_schedule);
    if($sum_schedule<=0)
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Data tidak ditemukan'
        );
    }
    else
    {
        $data_reset          = '00:00:0:0|00:00:0:0|00:00:0:0|00:00:0:0|00:00:0:0|00:00:0:0|00:00:0:0|00:00:0:0';
        $reset_schedule      = mysqli_query($con,"UPDATE misa_schedule SET schedule='$data_reset' WHERE id='$scheduleid'") or die (mysqli_error($con));
        if($reset_schedule!=1)
        {
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Reset data gagal diproses'
            );
        }
        else
        {
            unlink($photo_paroki);
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Reset data telah berhasil diproses'
            );
        }
    } 
}

header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>