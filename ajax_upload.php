<?php
if(isset($_FILES['bannerparoki']))
{
    if($_FILES['bannerparoki']['name']!='')
    {
        $ekstensi_diperbolehkan  = array('png','jpg','jpeg');
        $nama_banner             = $_FILES['bannerparoki']['name'][0];
        $x_banner                = explode('.', $nama_banner);
        print_r($x_banner);
        exit();
        $ekstensi_banner         = strtolower(end($x_banner));
        $ukuran_banner           = $_FILES['bannerparoki']['size'][0];
        $file_tmp_banner         = $_FILES['bannerparoki']['tmp_name'][0];
        $file_directory_banner   = "assets/dist/img/".$nama_banner;
        $file_db_banner          = "dist/img/".$nama_banner;
        $banner_info             = getimagesize($file_tmp_banner);
        $banner_width            = $banner_info[0];
        $banner_height           = $banner_info[1];
        move_uploaded_file($file_tmp_banner, $file_directory_banner);
        $name_banner     = $file_db_banner;
    }
    else
    {
        $name_banner             = "";
    }
    $update_banner  = mysqli_query($con,"UPDATE banner SET url_img='$name_banner' WHERE id='1' AND code='1'");
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
?>