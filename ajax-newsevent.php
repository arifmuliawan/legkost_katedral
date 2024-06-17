<?php
include("config.php");
include("session.php");
//include("session.php");
//print_r($_POST);
//exit();
if(isset($_FILES['acara_thumbnail']))
{
    if($_FILES['acara_thumbnail']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['acara_thumbnail']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['acara_thumbnail']['size'][0];
        $file_tmp_image         = $_FILES['acara_thumbnail']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/news/".$nama_image;
        $file_db_image          = "dist/img/news/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        if(file_exists("assets/dist/img/news/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($image_width>='445' && $image_width<='455') && ($image_height>='445' && $image_height<='455'))
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
                    $response_json       = array(
                        'error_status'   => 0,
                        'error_message'  => 'Penambahan data telah berhasil disimpan',
                        'thumb_img'     => $base_assets.$file_db_image
                    );
                } 
            }
            else
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (250 X 250)'
                );   
            }    
        }    
    }
}

if(isset($_FILES['acara_banner']))
{
    if($_FILES['acara_banner']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['acara_banner']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['acara_banner']['size'][0];
        $file_tmp_image         = $_FILES['acara_banner']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/news/".$nama_image;
        $file_db_image          = "dist/img/news/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        if(file_exists("assets/dist/img/news/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($image_width>='845' && $image_width<='855') && ($image_height>='445' && $image_height<='455'))
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
                    $response_json       = array(
                        'error_status'   => 0,
                        'error_message'  => 'Penambahan data telah berhasil disimpan',
                        'banner_img'     => $base_assets.$file_db_image
                    );
                } 
            }
            else
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (900 X 450)'
                );   
            }    
        }    
    }
}

if(isset($_POST['draf_acara']))
{
    $id             = $_POST['id'];
    $thumb_img      = $_POST['thumb_img'];
    $banner_img     = $_POST['banner_img'];
    $publish_data   = $_POST['publish'];
    $exp_publish    = explode("/",$publish_data);
    $ds             = $exp_publish[0];
    $ms             = $exp_publish[1];
    $ys             = $exp_publish[2];
    $publish        = $ys.'-'.$ms.'-'.$ds;
    $title          = $_POST['title'];
    $highlight      = $_POST['highlight'];
    $description    = $_POST['description'];
    if($id==0)
    {
        $insert_draf    = mysqli_query($con,"INSERT INTO `acara`(`title`, `highlight`, `description`, `publish_date`, `thumb_img`, `banner_img`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$title','$highlight','$description','$publish','$thumb_img','$banner_img','D','$user','$now','$user','$now')")or die (mysqli_error($con));
        if($insert_draf!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Penambahan data gagal disimpan'
            );
        }
        else
        {
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Penambahan data telah berhasil disimpan'
            );
        }
    }
    else
    {
        $update_draf    = mysqli_query($con,"UPDATE `acara` SET `title`='$title',`highlight`='$highlight',`description`='$description',`publish_date`='$publish',`thumb_img`='$thumb_img', `banner_img`='$banner_img',`update_by`='$user', `update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
        if($update_draf!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Perubahan data gagal disimpan'
            );
        }
        else
        {
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Perubahan data telah berhasil disimpan'
            );
        }
    }
}

if(isset($_POST['publish_acara']))
{
    $id             = $_POST['id'];
    $thumb_img      = $_POST['thumb_img'];
    $banner_img     = $_POST['banner_img'];
    $publish_data   = $_POST['publish'];
    $exp_publish    = explode("/",$publish_data);
    $ds             = $exp_publish[0];
    $ms             = $exp_publish[1];
    $ys             = $exp_publish[2];
    $publish        = $ys.'-'.$ms.'-'.$ds;
    $title          = $_POST['title'];
    $highlight      = $_POST['highlight'];
    $description    = $_POST['description'];
    if($id==0)
    {
        $insert_publish    = mysqli_query($con,"INSERT INTO `acara`(`title`, `highlight`, `description`, `publish_date`, `thumb_img`, `banner_img`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$title','$highlight','$description','$publish','$thumb_img','$banner_img','P','$user','$now','$user','$now')")or die (mysqli_error($con));
        if($insert_publish!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Penambahan data gagal disimpan'
            );
        }
        else
        {
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Penambahan data telah berhasil disimpan'
            );
        }
    }
    else
    {
        $update_publish    = mysqli_query($con,"UPDATE `acara` SET `title`='$title',`highlight`='$highlight',`description`='$description',`publish_date`='$publish',`thumb_img`='$thumb_img', `banner_img`='$banner_img',`visible`='P',`update_by`='$user', `update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
        if($update_publish!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Perubahan data gagal disimpan'
            );
        }
        else
        {
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Perubahan data telah berhasil disimpan'
            );
        }
    }
}

if(isset($_POST['delete_acara']))
{
    $id             = $_POST['id'];
    $thumb_data     = explode($base_url,$_POST['thumb']);
    $banner_data    = explode($base_url,$_POST['banner']);
    $thumb_img      = str_replace("%20"," ",$thumb_data[1]);
    $banner_img     = str_replace("%20"," ",$banner_data[1]);
    if($id!=0)
    {
        $delete_acara    = mysqli_query($con,"DELETE FROM `acara` WHERE id='$id'")or die (mysqli_error($con));
        if($delete_acara!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Data gagal dihapus'
            );
        }
        else
        {
            unlink($thumb_img);
            unlink($banner_img);
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Data berhasil dihapus'
            );
        }
    }
    else
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Data tidak ditemukan'
        );
    }
} 

header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>