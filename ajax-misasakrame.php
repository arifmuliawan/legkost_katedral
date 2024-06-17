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
            if(($image_width<='190' && $image_width>='200') && ($image_height<='190' && $image_height>='200'))
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
            if(($image_width<='875' && $image_width>='885') && ($image_height<='1245' && $image_height>='1255'))
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

if(isset($_POST['add_sakramen']))
{
    $categoryid     = $_POST['categoryid'];
    $title          = $_POST['title'];
    $link           = $_POST['link'];
    $query_sort     = mysqli_query($con,"SELECT * from `sakramen_list` WHERE categoryid='$categoryid' AND visible!='D' order by sortid DESC LIMIT 1")or die (mysqli_error($con));
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
    $insert_sakramen    = mysqli_query($con,"INSERT INTO `sakramen_list`(`sortid`, `categoryid`, `title`, `link`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$new_sort','$categoryid','$title','$link','Y','$user','$now','$user','$now')")or die (mysqli_error($con));
    if($insert_sakramen!=1)
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

if(isset($_POST['edit_sakramen']))
{
    $categoryid     = $_POST['categoryid_sakramen'];
    $id             = $_POST['id_sakramen'];
    $title          = $_POST['title_sakramen'];
    $link           = $_POST['link_sakramen'];
    $update_sakramen= mysqli_query($con,"UPDATE `sakramen_list` SET title='$title', link='$link', update_by='$user', update_date='$now' WHERE categoryid='$categoryid' AND id='$id'")or die (mysqli_error($con));
    if($update_sakramen!=1)
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
            'error_message'  => 'Perubahan data berhasil disimpan'
        );
    }
}    

if(isset($_POST['delete_sakramen']))
{
    $categoryid     = $_POST['categoryid'];
    $id             = $_POST['id'];
    $sortid         = $_POST['sortid'];
    $delete_sakramen= mysqli_query($con,"DELETE FROM `sakramen_list` WHERE id='$id' AND categoryid='$categoryid'")or die (mysqli_error($con));
    if($delete_sakramen!=1)
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Data gagal dihapus'
        );
    }
    else
    {
        $query_sakramen = mysqli_query($con,"SELECT * FROM `sakramen_list` WHERE categoryid='$categoryid' AND sortid>$sortid")or die (mysqli_error($con));
        $sum_sakramen   = mysqli_num_rows($query_sakramen);
        if($sum_sakramen>0)
        {
            while($data_sakramen=mysqli_fetch_array($query_sakramen))
            {
                $id_sakramen        = $data_sakramen['id'];
                $sortid_sakramen    = $data_sakramen['sortid'];
                $newsort_sakramen   = $sortid_sakramen-1;
                $update_sakramen    = mysqli_query($con,"UPDATE `sakramen_list` SET sortid='$newsort_sakramen' WHERE id='$id_sakramen' AND categoryid='$categoryid'")or die (mysqli_error($con));
            }
        }
        $response_json       = array(
            'error_status'   => 0,
            'error_message'  => 'Data telah berhasil dihapus'
        );
    }
}  

if(isset($_POST['add_perkawinan']))
{
    $nama_pria          = $_POST['nama_pria'];
    $paroki_pria        = $_POST['paroki_pria'];
    $nama_wanita        = $_POST['nama_wanita'];
    $paroki_wanita      = $_POST['paroki_wanita'];
    $input_publish_start= $_POST['publish_start'];
    $exp_publish_start  = explode("/",$input_publish_start);
    $ds                 = $exp_publish_start[0];
    $ms                 = $exp_publish_start[1];
    $ys                 = $exp_publish_start[2];
    $publish_start      = $ys.'-'.$ms.'-'.$ds;
    $insert_perkawinan  = mysqli_query($con,"INSERT INTO `perkawinan_list`(`nama_pria`, `paroki_pria`, `nama_wanita`, `paroki_wanita`, `pengumuman`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$nama_pria','$paroki_pria','$nama_wanita','$paroki_wanita','$publish_start','Y','$user','$now','$user','$now')")or die (mysqli_error($con));
    if($insert_perkawinan!=1)
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
            'error_message'  => 'Perubahan data berhasil disimpan'
        );
    }
}

if(isset($_POST['edit_perkawinan']))
{
    $id                 = $_POST['id'];
    $nama_pria          = $_POST['nama_pria'];
    $paroki_pria        = $_POST['paroki_pria'];
    $nama_wanita        = $_POST['nama_wanita'];
    $paroki_wanita      = $_POST['paroki_wanita'];
    $input_publish_start= $_POST['publish_start'];
    $exp_publish_start  = explode("/",$input_publish_start);
    $ds                 = $exp_publish_start[0];
    $ms                 = $exp_publish_start[1];
    $ys                 = $exp_publish_start[2];
    $publish_start      = $ys.'-'.$ms.'-'.$ds;
    $update_perkawinan  = mysqli_query($con,"UPDATE `perkawinan_list` SET `nama_pria`='$nama_pria',`paroki_pria`='$paroki_pria',`nama_wanita`='$nama_wanita',`paroki_wanita`='$paroki_wanita',`pengumuman`='$publish_start',`update_by`='$user',`update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
    if($update_perkawinan!=1)
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
            'error_message'  => 'Perubahan data berhasil disimpan'
        );
    }
}

if(isset($_FILES['katekese_thumbnail']))
{
    if($_FILES['katekese_thumbnail']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['katekese_thumbnail']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['katekese_thumbnail']['size'][0];
        $file_tmp_image         = $_FILES['katekese_thumbnail']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/katekese/".$nama_image;
        $file_db_image          = "dist/img/katekese/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        if(file_exists("assets/dist/img/katekese/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($image_width>='245' && $image_width<='255') && ($image_height>='245' && $image_height<='255'))
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

if(isset($_FILES['katekese_banner']))
{
    if($_FILES['katekese_banner']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_image             = $_FILES['katekese_banner']['name'][0];
        $x_image                = explode('.', $nama_image);
        $ekstensi_image         = strtolower(end($x_image));
        $ukuran_image           = $_FILES['katekese_banner']['size'][0];
        $file_tmp_image         = $_FILES['katekese_banner']['tmp_name'][0];
        $file_directory_image   = "assets/dist/img/katekese/".$nama_image;
        $file_db_image          = "dist/img/katekese/".$nama_image;
        $image_info             = getimagesize($file_tmp_image);
        $image_width            = $image_info[0];
        $image_height           = $image_info[1];
        if(file_exists("assets/dist/img/katekese/".$nama_image))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($image_width>='895' && $image_width<='905') && ($image_height>='445' && $image_height<='455'))
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

if(isset($_POST['draf_katekese']))
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
        $insert_draf    = mysqli_query($con,"INSERT INTO `katekese`(`title`, `highlight`, `description`, `publish_date`, `thumb_img`, `banner_img`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$title','$highlight','$description','$publish','$thumb_img','$banner_img','D','$user','$now','$user','$now')")or die (mysqli_error($con));
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
        $update_draf    = mysqli_query($con,"UPDATE `katekese` SET `title`='$title',`highlight`='$highlight',`description`='$description',`publish_date`='$publish',`thumb_img`='$thumb_img', `banner_img`='$banner_img',`update_by`='$user', `update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
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

if(isset($_POST['publish_katekese']))
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
        $insert_publish    = mysqli_query($con,"INSERT INTO `katekese`(`title`, `highlight`, `description`, `publish_date`, `thumb_img`, `banner_img`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$title','$highlight','$description','$publish','$thumb_img','$banner_img','P','$user','$now','$user','$now')")or die (mysqli_error($con));
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
        $update_publish    = mysqli_query($con,"UPDATE `katekese` SET `title`='$title',`highlight`='$highlight',`description`='$description',`publish_date`='$publish',`thumb_img`='$thumb_img', `banner_img`='$banner_img',`visible`='P',`update_by`='$user', `update_date`='$now' WHERE id='$id'")or die (mysqli_error($con));
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

if(isset($_POST['delete_katekese']))
{
    $id         = $_POST['id'];
    $thumb_img  = $_POST['thumb'];
    $banner_img = $_POST['banner'];
    if($id!=0)
    {
        $delete_katekese    = mysqli_query($con,"DELETE FROM `katekese` WHERE id='$id'")or die (mysqli_error($con));
        if($delete_katekese!=1)
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