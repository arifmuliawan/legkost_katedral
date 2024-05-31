<?php
include("config.php");
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
            if(($banner_width>='1815' && $banner_width<='1825') && ($banner_height>='590' && $banner_height<='600'))
            {
                $up_img          = move_uploaded_file($file_tmp_banner, $file_directory_banner);
                if($up_img==1)
                {
                    $update_banner  = mysqli_query($con,"UPDATE paroki_data SET url_img='$name_banner' WHERE id='1' AND code='1'") or die (mysqli_error($con));
                    if($update_banner==1)
                    {
                        $response_json       = array(
                            'error_status'   => 0,
                            'error_message'  => 'Perubahan anda telah berhasil disimpan'
                        );
                    }
                    else
                    {
                        http_response_code(412);
                        $response_json       = array(
                            'error_status'   => 1,
                            'error_message'  => 'Perubahan anda gagal disimpan'
                        );
                    }
                }
            }
            else
            {
                http_response_code(411);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (1820 X 600)'
                );
            }    
        }    
    }
}
header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>