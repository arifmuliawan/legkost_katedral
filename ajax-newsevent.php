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
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (450 X 450)'
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
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (850 X 450)'
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
    if($_POST['publish']=="")
    {
        $publish_data   = "01/01/2000";
    }
    else
    {
        $publish_data   = $_POST['publish'];
    }
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
    if($_POST['publish']=="")
    {
        $publish_data   = "01/01/2000";
    }
    else
    {
        $publish_data   = $_POST['publish'];
    }
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

if(isset($_FILES['acara_gallery']))
{
    $aid    = $_GET['aid'];
    if($_FILES['acara_gallery']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['acara_gallery']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['acara_gallery']['size'][0];
        $file_tmp_image         = $_FILES['acara_gallery']['tmp_name'][0];
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
            if(($image_width>='695' && $image_width<='705') && ($image_height>='355' && $image_height<='365'))
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
                    $query_sort     = mysqli_query($con,"SELECT * from `acara_galeri` WHERE acaraid='$aid' order by sortid DESC LIMIT 1")or die (mysqli_error($con));
                    $sum_sort       = mysqli_num_rows($query_sort);
                    if($sum_sort<=0)
                    {
                        $last_sort      = 0;
                        $new_sort       = $last_sort;
                    }
                    else
                    {
                        $data_sort      = mysqli_fetch_array($query_sort);
                        $last_sort      = $data_sort['sortid'];
                        $new_sort       = $last_sort+1;
                    }
                    $insert_gallery     = mysqli_query($con,"INSERT INTO `acara_galeri`(`sortid`, `acaraid`, `img`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$new_sort','$aid','$file_db_image','$user','$now','$user','$now')") or die (mysqli_error($con));
                    if($insert_gallery!=1)
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
                            'error_message'  => 'Penambahan data telah berhasil disimpan'
                        );
                    }    
                } 
            }
            else
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (700 X 360)'
                );   
            }    
        }    
    }
}

if(isset($_POST['delete_gallery']))
{
    $id             = $_POST['id'];
    $sortid         = $_POST['sortid'];
    $acaraid        = $_POST['acaraid'];
    $img_data       = "assets/".$_POST['img'];
    $gallery_img    = str_replace("%20"," ",$img_data);
    if($id!=0)
    {
        $delete_gallery    = mysqli_query($con,"DELETE FROM `acara_galeri` WHERE id='$id' AND acaraid='$acaraid'")or die (mysqli_error($con));
        if($delete_gallery!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Data gagal dihapus'
            );
        }
        else
        {
            $query_gallery      = mysqli_query($con,"SELECT * FROM `acara_galeri` WHERE acaraid='$acaraid' AND sortid>$sortid")or die (mysqli_error($con));
            $sum_gallery        = mysqli_num_rows($query_gallery);
            if($sum_gallery>0)
            {
                while($data_gallery_oth   = mysqli_fetch_array($query_gallery))
                {
                    $id_gallery_oth     = $data_gallery_oth['id'];
                    $acaraid_gallery_oth= $data_gallery_oth['acaraid'];
                    $sortid_gallery_oth = $data_gallery_oth['sortid'];
                    $new_sort           = $sortid_gallery_oth-1;
                    $update_gallery_oth = mysqli_query($con,"UPDATE `acara_galeri` SET sortid='$new_sort' WHERE id='$id_gallery_oth' AND acaraid='$acaraid_gallery_oth'")or die (mysqli_error($con));
                }
                unlink($gallery_img);
                $response_json       = array(
                    'error_status'   => 0,
                    'error_message'  => 'Data berhasil dihapus'
                );
            }
            else
            {
                unlink($gallery_img);
                $response_json       = array(
                    'error_status'   => 0,
                    'error_message'  => 'Data berhasil dihapus'
                );
            }
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

if(isset($_POST['draf_warta']))
{
    $id             = $_POST['id'];
    $doc_data       = $_POST['doc_data'];
    if($_POST['publish']=="")
    {
        $publish_data   = "01/01/2000";
    }
    else
    {
        $publish_data   = $_POST['publish'];
    }
    $exp_publish    = explode("/",$publish_data);
    $ds             = $exp_publish[0];
    $ms             = $exp_publish[1];
    $ys             = $exp_publish[2];
    $publish        = $ys.'-'.$ms.'-'.$ds;
    $title          = $_POST['title'];
    if($id==0)
    {
        $insert_draf    = mysqli_query($con,"INSERT INTO `warta`(`title`, `publish_date`, `doc`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$title','$publish','$doc_data','D','$user','$now','$user','$now')")or die (mysqli_error($con));
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
        $update_draf    = mysqli_query($con,"UPDATE `warta` SET `title`='$title',`publish_date`='$publish',`doc`='$doc_data',`update_by`='$user', `update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
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

if(isset($_FILES['warta_doc']))
{
    $id_warta   = $_POST['id'];
    if($_FILES['warta_doc']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('pdf');
        $nama_image             = $_FILES['warta_doc']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['warta_doc']['size'][0];
        $file_tmp_image         = $_FILES['warta_docy']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/warta/".$nama_image;
        $file_db_image          = "dist/img/warta/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        if(file_exists("assets/dist/img/warta/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if($ukuran_image>='100000000')
            {
                $upload_file   = @move_uploaded_file($file_tmp_image, $file_directory_image);
                if($upload_file===false)
                {
                    http_response_code(410);
                        $response_json       = array(
                        'error_status'   => 1,
                        'error_message'  => 'Document gagal di upload ke server'
                    );
                    return;
                }
                else
                {
                    $response_json       = array(
                        'error_status'   => 0,
                        'error_message'  => 'Penambahan data telah berhasil disimpan',
                        'doc_data'       => $base_assets.$file_db_image
                    );   
                } 
            }
            else
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Size Document maksimal 100MB'
                );   
            } 
        }
    }        
}    

if(isset($_POST['publish_warta']))
{
    $id             = $_POST['id'];
    $doc_data       = $_POST['doc_data'];
    if($_POST['publish']=="")
    {
        $publish_data   = "01/01/2000";
    }
    else
    {
        $publish_data   = $_POST['publish'];
    }
    $exp_publish    = explode("/",$publish_data);
    $ds             = $exp_publish[0];
    $ms             = $exp_publish[1];
    $ys             = $exp_publish[2];
    $publish        = $ys.'-'.$ms.'-'.$ds;
    $title          = $_POST['title'];
    if($id==0)
    {
        $insert_publish    = mysqli_query($con,"INSERT INTO `warta`(`title`, `publish_date`, `doc`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$title','$publish','$doc_data','P','$user','$now','$user','$now')")or die (mysqli_error($con));
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
        $update_publish    = mysqli_query($con,"UPDATE `acara` SET `title`='$title',`publish_date`='$publish',`doc`='$doc_data',`visible`='P',`update_by`='$user', `update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
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

if(isset($_POST['delete_warta']))
{
    $id             = $_POST['id'];
    $doc_data       = explode($base_url,$_POST['doc_data']);
    $doc            = str_replace("%20"," ",$doc_data[1]);
    if($id!=0)
    {
        $delete_warta    = mysqli_query($con,"DELETE FROM `warta` WHERE id='$id'")or die (mysqli_error($con));
        if($delete_warta!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Data gagal dihapus'
            );
        }
        else
        {
            unlink($doc);
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