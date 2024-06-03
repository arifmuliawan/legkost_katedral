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
                        $new_banner          = $base_assets.$file_db_banner;
                        $response_json       = array(
                            'error_status'   => 0,
                            'error_message'  => 'Perubahan data telah berhasil disimpan',
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
            'error_status'   => 1,
            'error_message'  => 'Penghapusan data gagal diproses'
        );
    }
    else
    {
        unlink($file_directory_banner);
        $response_json       = array(
            'error_status'   => 0,
            'error_message'  => 'Penghapusan data telah berhasil diproses'
        );
    }
} 

if(isset($_POST['update_periode']))
{
    $periode_paroki = $_POST['update_periode'];
    if($periode_paroki=="")
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Data periode paroki wajib diisi'
        );
    }
    else
    {
        $update_banner  = mysqli_query($con,"UPDATE paroki_asset SET url_img='$periode_paroki',update_by='$user',update_date='$now' WHERE id='2' AND code='2'") or die (mysqli_error($con));
        if($update_banner!=1)
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Data gagal disimpan'
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

if(isset($_FILES['add_paroki']))
{   
    $name_paroki        = $_POST['name_paroki'];
    $position_paroki    = $_POST['position_paroki'];
    if($name_paroki=="" && $position_paroki=="")
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Kolom nama & jabatan tidak boleh kosong'
        );
    }
    elseif($name_paroki=="" && $position_paroki!="")
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Kolom nama tidak boleh kosong'
        );
    }
    elseif($name_paroki!="" && $position_paroki=="")
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Kolom jabatan tidak boleh kosong'
        );
    }
    else
    {
        if($_FILES['add_paroki']['name'][0]!='')
        {
            $ekstensi_diperbolehkan = array('png','jpg','jpeg');
            $nama_photo             = $_FILES['add_paroki']['name'][0];
            $x_photo                = explode('.', $nama_photo);
            $ekstensi_photo         = strtolower(end($x_photo));
            $ukuran_photo           = $_FILES['add_paroki']['size'][0];
            $file_tmp_photo         = $_FILES['add_paroki']['tmp_name'][0];
            $file_directory_photo   = "assets/dist/img/paroki/".$nama_photo;
            $file_db_photo          = "dist/img/paroki/".$nama_photo;
            $photo_info             = getimagesize($file_tmp_photo);
            $photo_width            = $photo_info[0];
            $photo_height           = $photo_info[1];
            if(file_exists("assets/dist/img/paroki/".$nama_photo))
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
                );
            }
            else
            {
                if(($photo_width<='495' && $photo_width>='505') && ($photo_height<='495' && $photo_height>='505'))
                {
                    http_response_code(410);
                    $response_json       = array(
                        'error_status'   => 1,
                        'error_message'  => 'Resolusi Gambar Tidak Sesuai (500 X 500)'
                    );
                }
                else
                {
                    $upload_file   = @move_uploaded_file($file_tmp_photo, $file_directory_photo);
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
                        $query_sort         = mysqli_query($con,"SELECT * from `paroki_staff` WHERE visible!='D' order by sortid DESC LIMIT 1")or die (mysqli_error($con));
                        $sum_sort           = mysqli_num_rows($query_sort);
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
                        $insert_paroki      = mysqli_query($con,"INSERT INTO `paroki_staff`(`sortid`, `name`, `position`, `url_img`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$new_sort','$name_paroki','$position_paroki','$file_db_photo','Y','$user','$now','$user','$now')")or die (mysqli_error($con));
                        if($insert_paroki!=1)
                        {
                            unlink($file_directory_photo);
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
            }    
        }
    }    
}

if(isset($_POST['delete_photo_paroki']))
{
    $id_paroki = $_POST['id_paroki'];
    $select_paroki  = mysqli_query($con,"SELECT * FROM paroki_staff WHERE id='$id_paroki' AND visible='Y'") or die (mysqli_error($con));
    $sum_paroki     = mysqli_num_rows($select_paroki);
    if($sum_paroki<=0)
    {
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Data tidak ditemukan'
        );
    }
    else
    {
        $data_paroki    = mysqli_fetch_array($select_paroki);
        $photo_paroki   = 'assets/'.$data_paroki['url_img'];
        $update_paroki  = mysqli_query($con,"UPDATE paroki_staff SET url_img='',update_by='$user',update_date='$now' WHERE id='$id_paroki'") or die (mysqli_error($con));
        if($update_paroki!=1)
        {
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Photo gagal dihapus'
            );
        }
        else
        {
            unlink($photo_paroki);
            $response_json       = array(
                'error_status'   => 0,
                'error_message'  => 'Photo berhasil dihapus'
            );
        }
    }        
} 

if(isset($_FILES['update_photo_paroki']))
{   
    $id_paroki  = $_POST['id_paroki'];
    if($_FILES['update_photo_paroki']['name'][0]!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_photo             = $_FILES['update_photo_paroki']['name'][0];
        $x_photo                = explode('.', $nama_photo);
        $ekstensi_photo         = strtolower(end($x_photo));
        $ukuran_photo           = $_FILES['update_photo_paroki']['size'][0];
        $file_tmp_photo         = $_FILES['update_photo_paroki']['tmp_name'][0];
        $file_directory_photo   = "assets/dist/img/paroki/".$nama_photo;
        $file_db_photo          = "dist/img/paroki/".$nama_photo;
        $photo_info             = getimagesize($file_tmp_photo);
        $photo_width            = $photo_info[0];
        $photo_height           = $photo_info[1];
        if(file_exists("assets/dist/img/paroki/".$nama_photo))
        {
            http_response_code(410);
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Nama file sudah digunakan, silahkan upload kembali dengan nama file berbeda'
            );
        }
        else
        {
            if(($photo_width<='495' && $photo_width>='505') && ($photo_height<='495' && $photo_height>='505'))
            {
                http_response_code(410);
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Resolusi Gambar Tidak Sesuai (500 X 500)'
                );
            }
            else
            {
                $upload_file   = @move_uploaded_file($file_tmp_photo, $file_directory_photo);
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
                    $update_photo_paroki     = mysqli_query($con,"UPDATE paroki_staff SET url_img='$file_db_photo' WHERE id='$id_paroki'")or die (mysqli_error($con));
                    if($update_photo_paroki!=1)
                    {
                        unlink($file_directory_photo);
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
                            'new_photo'      => $base_assets.$file_db_photo
                        );
                    }
                }    
            }    
        }    
    }
}

if(isset($_POST['edit_paroki']))
{
    print_r($_POST);
    exit();
    $id_paroki      = $_POST['id_paroki'];
    $name_paroki    = $_POST['name_paroki'];
    $position_paroki= $_POST['position_paroki'];
    if($name_paroki=="" && $position_paroki=="")
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Kolom nama & jabatan tidak boleh kosong'
        );
    }
    elseif($name_paroki=="" && $position_paroki!="")
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Kolom nama tidak boleh kosong'
        );
    }
    elseif($name_paroki!="" && $position_paroki=="")
    {
        http_response_code(410);
        $response_json       = array(
            'error_status'   => 1,
            'error_message'  => 'Kolom jabatan tidak boleh kosong'
        );
    }
    else
    {
        $select_paroki  = mysqli_query($con,"SELECT * FROM paroki_staff WHERE id='$id_paroki' AND visible='Y'") or die (mysqli_error($con));
        $sum_paroki     = mysqli_num_rows($select_paroki);
        if($sum_paroki<=0)
        {
            $response_json       = array(
                'error_status'   => 1,
                'error_message'  => 'Data tidak ditemukan'
            );
        }
        else
        {
            $update_paroki  = mysqli_query($con,"UPDATE paroki_staff SET name_paroki='$name_paroki',position_paroki='$position_paroki',update_by='$user',update_date='$now' WHERE id='$id_paroki'") or die (mysqli_error($con));
            if($update_paroki!=1)
            {
                $response_json       = array(
                    'error_status'   => 1,
                    'error_message'  => 'Perubahan data gagal disimpan'
                );
            }
            else
            {
                unlink($photo_paroki);
                $response_json       = array(
                    'error_status'   => 0,
                    'error_message'  => 'perubahan data berhasil disimpan'
                );
            }
        } 
    }           
}

header("Content-type: application/json; charset=utf-8");
echo json_encode($response_json);
?>