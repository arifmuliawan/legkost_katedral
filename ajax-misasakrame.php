<?php
include("config.php");
include("session.php");
//include("session.php");
//print_r($_POST);
//exit();
if(isset($_POST['reset_schedule_misa']))
{
    $scheduleid         = $_POST['scheduleid'];
    $select_schedule    = mysqli_query($con,"SELECT * FROM misa_schedule WHERE id='$scheduleid' AND visible='Y'") or die (mysqli_error($con));
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
        $reset_schedule      = mysqli_query($con,"UPDATE misa_schedule SET schedule='$data_reset',update_by='$user', update_date='$now' WHERE id='$scheduleid'") or die (mysqli_error($con));
        if($reset_schedule!=1)
        {
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Reset data gagal diproses'
            );
        }
        else
        {
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Reset data telah berhasil diproses'
            );
        }
    } 
}
if(isset($_POST['publish_misakhusus']))
{
    $misakhususid   = $_POST['misakhususid'];
    $pubish_start   = $_POST['publish_start'];
    $pubish_end     = $_POST['publish_end'];
    if($pubish_start=="" && $pubish_end=="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Tanggal Mulai & Tanggal Berakhir Harus Terisi'
        );
    }
    elseif($pubish_start=="" && $pubish_end!="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Tanggal Mulai Harus Terisi'
        );
    }
    elseif($pubish_start!="" && $pubish_end=="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Tanggal Berakhir Harus Terisi'
        );
    }
    else
    {
        $update_misakhusus  = mysqli_query($con,"UPDATE misa_khusus SET publish_start='$pubish_start', publish_end='$pubish_end', update_by='$user', update_date='$now' WHERE id='$misakhususid'") or die (mysqli_error($con));
        if($update_misakhusus!=1)
        {
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Perubahan data gagal disimpan'
            );
        }
        else
        {
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Perubahan data berhasil disimpan'
            ); 
        }
    }
}

header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>