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
        $up_img                  = move_uploaded_file($file_tmp_banner, $file_directory_banner);
        $name_banner     = $file_db_banner;
    }
    else
    {
        $name_banner             = "";
    }
    $update_banner  = mysqli_query($con,"UPDATE paroki_data SET url_img='$name_banner' WHERE id='1' AND code='1'");
    if($update_banner==1)
    {
        echo "
            <script type='text/javascript'>
                $(window).on('load', function() {
                    $('#successmodal').modal('show');
                });
                var delay = 2000;
                setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
            </script>
        ";
    }
    else
    {
        echo "GAGAL UPLOAD";
        exit();
    }
}
if(isset($_FILES['staffparoki']))
{
    $nama_paroki    = $_POST['nama_paroki'];
    $jabatan_paroki = $_POST['jabatan_paroki'];
    if($_FILES['staffparoki']['name']!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_photo             = $_FILES['staffparoki']['name'][0];
        $x_photo                = explode('.', $nama_photo);
        $ekstensi_photo         = strtolower(end($x_photo));
        $ukuran_photo           = $_FILES['staffparoki']['size'][0];
        $file_tmp_photo         = $_FILES['staffparoki']['tmp_name'][0];
        $file_directory_photo   = "assets/dist/img/paroki/".$nama_photo;
        $file_db_photo          = "dist/img/paroki/".$nama_photo;
        $photo_info             = getimagesize($file_tmp_photo);
        $photo_width            = $photo_info[0];
        $photo_height           = $photo_info[1];
        $up_img                 = move_uploaded_file($file_tmp_photo, $file_directory_photo);
        if($up_img==1)
        {
            $name_photo         = $file_db_photo;
        }
        else
        {
            echo "
                <script type='text/javascript'>
                    $('#failedmodal').modal('show');
                </script>
            ";
            exit();
        }
    }
    else
    {
        $name_photo             = "";
    }
    $query_sort                 = mysqli_query($con,"SELECT * from `paroki_staff` WHERE visible!='D' order by sortid DESC LIMIT 1")or die (mysqli_error($con));
    $sum_sort                   = mysqli_num_rows($query_sort);
    if($sum_sort<=0)
    {
        $last_sort              = 0;
        $new_sort               = $last_sort;
    }
    else
    {
        $data_sort              = mysqli_fetch_array($query_sort);
        $last_sort              = $data_sort['sortid'];
        $new_sort               = $last_sort+1;
    }
    $insert_paroki  = mysqli_query($con,"INSERT INTO `paroki_staff`(`sortid`, `name`, `position`, `url_img`, `visible`, `create_by`, `create_date`, `update_by`, `update_date`) VALUES ('$new_sort','$nama_paroki','$jabatan_paroki','$name_photo','Y','$user','$now','$user','$now')")or die (mysqli_error($con));
    if($insert_paroki==1)
    {
        echo "
            <script type='text/javascript'>
                $('#successmodal').modal('show');
                var delay = 2000;
                setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
            </script>
        ";
    }
    else
    {
        echo "
            <script type='text/javascript'>
                $('#failedmodal').modal('show');
            </script>
        ";
    }
}   

if(isset($_FILES['updatestaffparoki']))
{
    $id_paroki    = $_POST['id_paroki'];
    if($_FILES['updatestaffparoki']['name']!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_photo             = $_FILES['updatestaffparoki']['name'][0];
        $x_photo                = explode('.', $nama_photo);
        $ekstensi_photo         = strtolower(end($x_photo));
        $ukuran_photo           = $_FILES['updatestaffparoki']['size'][0];
        $file_tmp_photo         = $_FILES['updatestaffparoki']['tmp_name'][0];
        $file_directory_photo   = "assets/dist/img/paroki/".$nama_photo;
        $file_db_photo          = "dist/img/paroki/".$nama_photo;
        $photo_info             = getimagesize($file_tmp_photo);
        $photo_width            = $photo_info[0];
        $photo_height           = $photo_info[1];
        $up_img                 = move_uploaded_file($file_tmp_photo, $file_directory_photo);
        if($up_img==1)
        {
            $name_photo         = $file_db_photo;
            $update_paroki      = mysqli_query($con,"UPDATE `paroki_staff` SET url_img='$name_photo',update_by='$user',update_date='$now' WHERE id='$id_paroki'")or die (mysqli_error($con));
            if($update_paroki==1)
            {
                echo "
                    <script type='text/javascript'>
                        $('#successmodal').modal('show');
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    </script>
                ";
            }
            else
            {
                echo "
                <script type='text/javascript'>
                    $('#failedmodal').modal('show');
                </script>
                ";
                exit();
            }
        }
        else
        {
            echo "
                <script type='text/javascript'>
                    $('#failedmodal').modal('show');
                </script>
            ";
            exit();
        }
    }
}    
?>