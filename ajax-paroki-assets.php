<?php
include("config.php");
include("session.php");
//include("session.php");
if(isset($_FILES['bannerparoki']))
{
    if($_FILES['bannerparoki']['name']!='')
    {
        $ekstensi_diperbolehkan  = array('png','jpg','jpeg');
        $nama_banner             = $_FILES['bannerparoki']['name'][0];
        $x_banner                = explode('.', $nama_banner);
        $ekstensi_banner         = strtolower(end($x_banner));
        $ukuran_banner           = $_FILES['bannerparoki']['size'][0];
        $file_tmp_banner         = $_FILES['bannerparoki']['tmp_name'][0];
        $file_directory_banner   = "assets/dist/img/paroki/".$nama_banner;
        $file_db_banner          = "dist/img/paroki/".$nama_banner;
        $banner_info             = getimagesize($file_tmp_banner);
        $banner_width            = $banner_info[0];
        $banner_height           = $banner_info[1];
        if(file_exists("assets/dist/img/paroki/".$nama_banner))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($banner_width<='1815' && $banner_width>='1825') && ($banner_height<='695' && $banner_height>='705'))
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (1820 X 600)'
                );
            }
            else
            {
                $upload_file   = @move_uploaded_file($file_tmp_banner, $file_directory_banner);
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
                    $update_banner  = mysqli_query($con,"UPDATE paroki_asset SET url_img='$file_db_banner',update_by='$user',update_date='$now' WHERE id='1' AND code='1'") or die (mysqli_error($con));
                    //var_dump($update_banner);
                    //exit();
                    if($update_banner!=1)
                    {
                        unlink($file_directory_banner);
                        http_response_code(410);
                            $response_json       = array(
                            'error_status'   => 1,
                            'error_message'  => 'Gambar gagal di upload ke server'
                        );
                    }
                    else
                    {
                        $response_json       = array(
                            'error_status'   => 0,
                            'error_message'  => 'Perubahan anda telah berhasil disimpan',
                            'banner'         => $new_banner   
                        );
                    }
                }    
            }    
        }    
    }
}
if(isset($_POST['delete_banner']))
{
    $file_directory_banner = $_POST['delete_banner'];
    $delete_banner       = mysqli_query($con,"UPDATE paroki_asset SET url_img='',update_by='$user',update_date='$now' WHERE id='1' AND code='1'") or die (mysqli_error($con));
    if($delete_banner!=1)
    {
        $response_json       = array(
            'error_status'   => 0,
            'error_message'  => 'Penghapusan data gagal diproses'
        );
    }
    else
    {
        unlink($file_directory_banner);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Penghapusan data telah berhasil diproses'
        );
    }
}    
header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>