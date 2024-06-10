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
    $misakhususid        = $_POST['misakhususid'];
    $input_publish_start = $_POST['publish_start'];
    $input_publish_end   = $_POST['publish_end'];
    if($input_publish_start=="" && $input_publish_end=="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Tanggal Mulai & Tanggal Berakhir Harus Terisi'
        );
    }
    elseif($input_publish_start=="" && $input_publish_end!="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Tanggal Mulai Harus Terisi'
        );
    }
    elseif($input_publish_start!="" && $input_publish_end=="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Tanggal Berakhir Harus Terisi'
        );
    }
    else
    {
        $exp_publish_start  = explode("/",$input_publish_start);
        $ds                 = $exp_publish_start[0];
        $ms                 = $exp_publish_start[1];
        $ys                 = $exp_publish_start[2];
        $publish_start      = $ys.'-'.$ms.'-'.$ds;
        $exp_publish_end    = explode("/",$input_publish_end);
        $de                 = $exp_publish_end[0];
        $me                 = $exp_publish_end[1];
        $ye                 = $exp_publish_end[2];
        $publish_end        = $ye.'-'.$me.'-'.$de;
        $update_misakhusus  = mysqli_query($con,"UPDATE misa_khusus SET publish_start='$publish_start', publish_end='$publish_end', update_by='$user', update_date='$now' WHERE id='$misakhususid'") or die (mysqli_error($con));
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

if(isset($_POST['detail_misakhusus']))
{
    $misakhususid           = $_POST['misakhususid'];
    $misakhusustitle        = $_POST['misakhusustitle'];
    $misakhususdesc         = $_POST['misakhususdesc'];
    $misakregisurl          = $_POST['misakregisurl'];
    if(empty($misakhususdesc))
    {
        $error               = 1;
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Deskripsi tidak boleh kosong'
        );
    }
    if(empty($misakregisurl))
    {
        $error               = 1;
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Link Registrasi tidak boleh kosong'
        );
    }
    if(empty($misakhusustitle))
    {
        $error               = 1;
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Judul tidak boleh kosong'
        );
    }
    if(empty($error))
    {
        $update_misakhusus  = mysqli_query($con,"UPDATE misa_khusus SET title='$misakhusustitle', description='$misakhususdesc', regis_url='$misakregisurl', update_by='$user', update_date='$now' WHERE id='$misakhususid'") or die (mysqli_error($con));
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

if(isset($_FILES['upload_kregisimg']))
{
    $misakhususid               = 1;
    if($_FILES['upload_kregisimg']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['upload_kregisimg']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['upload_kregisimg']['size'][0];
        $file_tmp_image         = $_FILES['upload_kregisimg']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/misa/".$nama_image;
        $file_db_image          = "dist/img/misa/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        print_r($image_height);
        exit();
        if(file_exists("assets/dist/img/misa/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($image_width>='190' && $image_width<='200') && ($image_height>='190' && $image_height<='200'))
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (195 X 195)'
                );
            }
            else
            {
                $upload_file   = @move_uploaded_file($file_tmp_image, $file_directory_image);
                if($upload_file===false)
                {
                    http_response_code(410);
                        $response_json       = array(
                        'error_status'   => 1,
                        'error_message'  => 'Gambar gagal di upload ke server'
                    );
                    return;
                }
                else
                {
                    $update_misakhusus  = mysqli_query($con,"UPDATE misa_khusus SET regis_img='$file_db_image', update_by='$user', update_date='$now' WHERE id='$misakhususid'") or die (mysqli_error($con));
                    if($update_misakhusus!=1)
                    {
                        unlink($file_directory_image);
                        http_response_code(410);
                            $response_json   = array(
                            'error_status'   => 1,
                            'error_message'  => 'Gambar gagal di upload ke server'
                        );
                    }
                    else
                    {
                        $response_json       = array(
                            'error_status'   => 0,
                            'error_message'  => 'Penambahan data telah berhasil disimpan',
                            'kregis_img'     => $base_assets.$file_db_image
                        );
                    }
                }    
            }    
        }    
    }
} 

if(isset($_FILES['upload_kscheduleimg']))
{
    $misakhususid               = 1;
    if($_FILES['upload_kscheduleimg']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['upload_kscheduleimg']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['upload_kscheduleimg']['size'][0];
        $file_tmp_image         = $_FILES['upload_kscheduleimg']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/misa/".$nama_image;
        $file_db_image          = "dist/img/misa/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        if(file_exists("assets/dist/img/misa/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($image_width>='875' && $image_width<='885') && ($image_height>='1245' && $image_height>='1255'))
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (880 X 1250)'
                );
            }
            else
            {
                $upload_file   = @move_uploaded_file($file_tmp_image, $file_directory_image);
                if($upload_file===false)
                {
                    http_response_code(410);
                        $response_json       = array(
                        'error_status'   => 1,
                        'error_message'  => 'Gambar gagal di upload ke server'
                    );
                    return;
                }
                else
                {
                    $update_misakhusus  = mysqli_query($con,"UPDATE misa_khusus SET schedule_img='$file_db_image', update_by='$user', update_date='$now' WHERE id='$misakhususid'") or die (mysqli_error($con));
                    if($update_misakhusus!=1)
                    {
                        unlink($file_directory_image);
                        http_response_code(410);
                            $response_json   = array(
                            'error_status'   => 1,
                            'error_message'  => 'Gambar gagal di upload ke server'
                        );
                    }
                    else
                    {
                        $response_json       = array(
                            'error_status'   => 0,
                            'error_message'  => 'Penambahan data telah berhasil disimpan',
                            'kregis_img'     => $base_assets.$file_db_image
                        );
                    }
                }    
            }    
        }    
    }
} 

header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>