<?php
if(isset($_POST['submit_banner']))
{
    print_r($_FILES);
    exit();
    $fullname           = $_POST['fullname'];
    if($_FILES['photo']['name']!='')
    {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $nama_photo             = $_FILES['photo']['name'];
        $x_photo                = explode('.', $nama_photo);
        $ekstensi_photo         = strtolower(end($x_photo));
        $ukuran_photo           = $_FILES['photo']['size'];
        $file_tmp_photo         = $_FILES['photo']['tmp_name'];
        $file_directory_photo   = "assets/dist/img/company/".$nama_photo;
        $file_db_photo          = "dist/img/company/".$nama_photo;
        $photo_info             = getimagesize($file_tmp_photo);
        $photo_width            = $photo_info[0];
        $photo_height           = $photo_info[1];
        if(in_array($ekstensi_photo, $ekstensi_diperbolehkan) === true)
        {
            if(($photo_width>='350' && $photo_width<='360') && ($photo_height>='425' && $photo_height<='435'))
            {          
                move_uploaded_file($file_tmp_photo, $file_directory_photo);
                $name_photo     = $file_db_photo; 
            }
            else
            {
                $error          = 1;
                $msg_photo      = "Your Resolution image is not compatible";
            }
        }    
        else
        {
            $error              = 1;
            $msg_photo          = "Your image file is not compatible";
        }
    }
    else
    {
        $name_photo             = "";
    }  
}
?>          
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="margin: 24px">DEWAN PAROKI</h1>
                            <p style="margin: 24px;color: red;font-size: 14px;">KOLOM DENGAN TANDA * WAJIB DIISI</p>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" class="dropzone needsclick" id="dropzone-basic">
                                            <label>FOTO BANNER *</label>
                                            <br> 
                                            <div style="margin-bottom: 25px;margin-top: -10px;font-size: 13px;">(1820 x 595 px) JPG/JPEG/PNG</div>
                                            <div class="dropzone dz-clickable border rounded bg-light p-3">
                                                <div class="dz-default dz-message text-center">
                                                    <i class="fas fa-upload" style="font-size: 2rem;"></i>
                                                    <div class="mt-3" style="font-weight: bold;">.JPG   .JPEG   .PNG </div>
                                                    <div class="mt-1">Drop files to upload </div>
                                                    <div class="mt-1" style="color: #88A8D4;font-weight: bold;">or Browse Files...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn" name="submit_banner" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                        &nbsp&nbsp
                                        <a href='index.php?p=paroki_dewan'><button type="button" class="btn" style="background-color:#ff0000;color: #ffffff;font-weight: bold;border-color: #88A8D4;"> DELETE </button></a>
                                    </div>
                                </div>
                            </div>
                        </form>                    
                        </div>
                        <!-- /.card -->
                        </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>    