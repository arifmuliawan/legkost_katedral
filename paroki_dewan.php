<?php
$query_banner       = mysqli_query($con,"SELECT * FROM paroki_data WHERE id='1' AND code='1' AND visible='Y'")or die (mysqli_error($con));
$sum_banner         = mysqli_num_rows($query_banner);
if($sum_banner>0)
{
    $data_banner    = mysqli_fetch_array($query_banner);
    $url_img        = $data_banner['url_img'];
    if($url_img!="")
    {
        $banner_image   = $base_assets."".$url_img;
    }
    else
    {
        $banner_image   = "";
    }
}
else
{
    $banner_image   = "";
}
$query_periode      = mysqli_query($con,"SELECT * FROM paroki_data WHERE id='2' AND code='2' AND visible='Y'")or die (mysqli_error($con));
$sum_periode        = mysqli_num_rows($query_periode);
if($sum_periode>0)
{
    $data_periode   = mysqli_fetch_array($query_periode);
    $periode_paroki = $data_periode['url_img'];
}
else
{
    $periode_paroki = "";
}    
if((isset($action)) && $action==4)
{
    $delete_banner  = mysqli_query($con,"UPDATE paroki_data SET url_img='' WHERE id='1' AND code='1'")or die (mysqli_error($con));
    if($delete_banner==1)
    {
        echo "
            <script type='text/javascript'>
                $(window).on('load', function() {
                    $('#deletemodal').modal('show');
                });
                var delay = 2000;
                setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
            </script>
        ";
    }
    else
    {
        $err_delbanner  = 1;
        $msg_delbanner  = "Data Gagal Dihapus";
        echo "
        <script type='text/javascript'>
            $(window).on('load', function() {
                $('#failedmodal').modal('show');
            });
            var delay = 2000;
            setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
        </script>
        ";
    }
}
if(isset($_POST['submit_periode']))
{
    $periode_paroki    = $_POST['periode_paroki'];
    if($periode_paroki!="")
    {
        $update_periode  = mysqli_query($con,"UPDATE paroki_data SET url_img='$periode_paroki' WHERE id='2' AND code='2'")or die (mysqli_error($con));
        if($update_periode==1)
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
            $err_upperiode  = 1;
            $msg_upperiode  = "Data Gagal Disimpan";
            echo "
            <script type='text/javascript'>
                $(window).on('load', function() {
                    $('#failedmodal').modal('show');
                });
                var delay = 2000;
                setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
            </script>
            ";
        }
    }
    else
    {
        $err_upperiode  = 1;
        $msg_upperiode  = "Data Periode Jabatan Tidak Boleh Kosong";
        echo "
        <script type='text/javascript'>
            $(window).on('load', function() {
                $('#failedmodal').modal('show');
            });
            var delay = 2000;
            setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
        </script>
        ";
    }
}
if(isset($_POST['submit_deletephotoparoki']))
{
    $id_paroki      = $_POST['id_paroki'];
    $delete_photo   = mysqli_query($con,"UPDATE paroki_staff SET url_img='' WHERE id='$id_paroki'")or die (mysqli_error($con));
    if($delete_photo)
    {
        echo "
            <script type='text/javascript'>
                $('#successmodal').modal('show');
                var delay = 2000;
                $('#successmodal').modal('hide');
                $('#updateparokimodal').modal('show');
            </script>
        ";
    }
}
?>
        <style>
            .dropzone
            {
                padding : 20px 20px;
            }

            .dropzone.dz-clickable
            {
                text-align: center;
            }

            #imageUploadBannerParoki .dz-preview .dz-image
            {
                width: 1456px;
                height: 560px;
            }

            #imageUploadStaffParoki
            {
                padding : 0 !important;
            }

            #imageUploadStaffParoki .dz-preview
            {
                margin: 0 !important;
            }
            
            #imageUploadStaffParoki .dz-preview .dz-image
            {
                width: 300px;
                height: 300px;
            }
        </style>    
        <div class="modal fade" id="successmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                        <img src="<?php echo $base_assets ?>dist/img/icon_success.png" style="width: 70px;">
                        <br><br>
                        <h5> Perubahan Anda Telah Berhasil Disimpan </h5> 
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="failedmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                        <img src="<?php echo $base_assets ?>dist/img/icon_failed.png" style="width: 70px;">
                        <br><br>
                        <h5> 
                            <?php
                            if($err_delbanner==1)
                            {
                                echo $msg_delbanner;
                            }
                            if($err_upperiode==1)
                            {
                                echo $msg_upperiode;
                            }
                            else
                            {
                                echo "[ERROR] Data Tidak Berhasil Disimpan";
                            }
                            ?>
                        </h5>
                        <br>
                        <button type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;border-color: #88A8D4;" data-dismiss="modal" aria-label="Close"> CLOSE </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="deletemodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                        <img src="<?php echo $base_assets ?>dist/img/icon_success.png" style="width: 70px;">
                        <br><br>
                        <h5> Data Berhasil Dihapus </h5> 
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
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
                        <div class="card" style="">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">    
                                <form id="imageUploadFormBannerParoki">
                                    <div class="form-group">
                                        <label>FOTO BANNER <font color='red'>*</font></label> <br>
                                        (1456 x 560 px) JPG/JPEG/PNG
                                    </div>
                                    <?php
                                    if($banner_image!="")
                                    {
                                    ?>    
                                        <img src='<?php echo $banner_image ?>' width='100%'> <br>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <div id="imageUploadBannerParoki" class="dropzone">
                                            <div class="dz-message">
                                                <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                <b>.JPG  .JPEG  .PNG</b><br>
                                                Drop files to upload <br>
                                                or <font color='#88A8D4'><b>Browse Files...</b></font>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>    
                                    <br>
                                    <button id="uploaderBtnBannerParoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                    &nbsp&nbsp
                                    <a href="index.php?p=paroki_dewan&a=4" onclick="return confirm('Are you sure you want to delete this item ?')"><button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">DELETE</button></a>
                                </form>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">PERIODE JABATAN <font color='red'>*</font></label>
                                                <input type="text" name="periode_paroki" class="form-control" placeholder="Type something here...." value="<?php echo $periode_paroki ?>" <?php if(isset($err_upperiode) && $err_upperiode==1){ echo "style='border-color: red;'"; } ?> required>
                                            </div>
                                        </div>
                                    </div>               
                                </div>
                                <div class="card-footer" style="background-color: unset;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table border=0 width="100%">
                                            <tr>
                                                <td style="text-align: right;">
                                                    <button type="submit" class="btn" name="submit_periode" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button>
                                                </td> 
                                            </tr>
                                        </table>
                                    </div>
                                </div>        
                            </div>
                            </form> 
                        <!--</form>-->                    
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card">
                        <!-- /.card-header 
                            <form action="" method="post" enctype="multipart/form-data">-->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">DAFTAR PENGURUS <font color='red'>*</font></label><br>
                                                Pilih salah satu pengurus untuk mengubah detail.<br><br>     
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <table border=0 width="100%">
                                                <tr>
                                                    <td width="50%" style="text-align: left;">
                                                        <button type="button" class="btn" style="background-color:#9C9C9C;color: #ffffff;font-weight: bold;">DELETE SELECTED</button>
                                                        <button type="button" class="btn" style="background-color:#ffffff;color: #9C9C9C;font-weight: bold;">CLEAR SELECTION</button>
                                                    </td> 
                                                    <td width="50%" style="text-align: right;">
                                                        <button type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;" data-toggle="modal" data-target="#addparokimodal">ADD NEW</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 40px;">
                                            
                                            <div class="row">
                                                <div class="paroki_position" style="display: flex;width: 100%;">
                                                <?php
                                                $query_staff    = mysqli_query($con,"SELECT * FROM paroki_staff WHERE visible='Y' order by sortid ASC")or die (mysqli_error($con));
                                                $sum_staff      = mysqli_num_rows($query_staff);
                                                if($sum_staff>0)
                                                {
                                                    while($data_staff=mysqli_fetch_array($query_staff))
                                                    {
                                                        $id_staff       = $data_staff['id'];
                                                        $sortid_staff   = $data_staff['sortid'];
                                                        $name_staff     = $data_staff['name'];
                                                        $position_staff = $data_staff['position'];
                                                        $photo_data     = $data_staff['url_img'];
                                                        if($photo_data!="")
                                                        {
                                                            $photo_staff= $base_assets."".$photo_data;
                                                        }
                                                        else
                                                        {
                                                            $photo_staff= "";
                                                        }
                                                        $data_json      = array(
                                                            'id_staff'      => $id_staff,
                                                            'name_staff'    => $name_staff,
                                                            'position_staff'=> $position_staff,
                                                            'photo_staff'   => $photo_staff
                                                        );
                                                ?>  
                                                        <div class="col-md-2" style="margin: 10px;cursor: grab;" id="<?php echo $sortid_staff ?>" data-id="<?php echo $id_staff ?>" data-sec="<?php echo $sortid_staff ?>">
                                                            <img class="datastaff" src="<?php echo $photo_staff ?>" style="width:100%" data-toggle="modal" data-target="#updateparokimodal" data-staff='<?php echo json_encode($data_json) ?>'>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                </div>  
                                            </div>      
                                        </div>
                                    </div>               
                                </div>
                                <div class="modal fade" id="addparokimodal" style="pointer-events: none;">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-body" style="padding: 40px;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form id="imageUploadFormStaffParoki">
                                                        <div class="card-body">    
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>FOTO PENGURUS <font color='red'>*</font></label> <br>
                                                                    (500 x 500 px) JPG/JPEG/PNG
                                                                </div>
                                                                <div id="imageUploadStaffParoki" class="dropzone">
                                                                    <div class="dz-message">
                                                                        <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                                        <b>.JPG  .JPEG  .PNG</b><br>
                                                                        Drop files to upload <br>
                                                                        or <font color='#88A8D4'><b>Browse Files...</b></font>
                                                                    </div>
                                                                </div> 
                                                            </div>    
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                <input type="hidden" name="id_paroki">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">NAMA <font color='red'>*</font></label>
                                                                            <input type="text" name="nama_paroki" class="form-control" placeholder="Type something here...."  <?php if(isset($err_upnama) && $err_upnama==1){ echo "style='border-color: red;'"; } ?> required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">JABATAN <font color='red'>*</font></label>
                                                                            <input type="text" name="jabatan_paroki" class="form-control" placeholder="Type something here...." <?php if(isset($err_upjabatan) && $err_upjabatan==1){ echo "style='border-color: red;'"; } ?> required>
                                                                        </div>
                                                                    </div>             
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="card-footer" style="background-color: unset;">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <table border=0 width="100%">
                                                                                <tr>
                                                                                    <td style="text-align: right;">
                                                                                        <button id="uploaderBtnStaffParoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                                                                        &nbsp&nbsp
                                                                                        <a href="" onclick="return confirm('Are you sure you want to delete this item ?')"><button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">CANCEL</button></a>
                                                                                    </td> 
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>    
                                                        </div>
                                                        </div>      
                                                        </form>    
                                                    </div>  
                                                </div>    
                                            </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="updateparokimodal">
                                    <div class="modal-dialog" style="max-width: 800px;">
                                        <div class="modal-content">
                                            <div class="modal-body" style="padding: 40px;">
                                                <div class="card-body">
                                                    <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-body">    
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>FOTO PENGURUS <font color='red'>*</font></label> <br>
                                                                    (500 x 500 px) JPG/JPEG/PNG
                                                                </div>
                                                                <img src="" id="photo_paroki" width="300px" style="display: none;">
                                                                <form method="POST" action="">
                                                                    <input type="hidden" name="id_paroki">
                                                                    <input type="submit" name="submit_deletephotoparoki" value="DELETE" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">
                                                                </form>    
                                                                <form id="imageUpdateFormStaffParoki">
                                                                <div id="imageUpdateStaffParoki" class="dropzone">
                                                                    <div class="dz-message">
                                                                        <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                                        <b>.JPG  .JPEG  .PNG</b><br>
                                                                        Drop files to upload <br>
                                                                        or <font color='#88A8D4'><b>Browse Files...</b></font>
                                                                    </div>
                                                                </div>
                                                                <button id="updateBtnStaffParoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                                                </form>  
                                                            </div>
                                                            <div class="col-md-6">
                                                                <form method="POST" action="">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="id_paroki">
                                                                                <label class="form-label">NAMA <font color='red'>*</font></label>
                                                                                <input type="text" name="nama_paroki" class="form-control" placeholder="Type something here...."  <?php if(isset($err_upnama) && $err_upnama==1){ echo "style='border-color: red;'"; } ?> required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label">JABATAN <font color='red'>*</font></label>
                                                                                <input type="text" name="jabatan_paroki" class="form-control" placeholder="Type something here...." <?php if(isset($err_upjabatan) && $err_upjabatan==1){ echo "style='border-color: red;'"; } ?> required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table border=0 width="100%">
                                                                                <tr>
                                                                                    <td style="text-align: right;">
                                                                                        <a href="" onclick="return confirm('Are you sure you want to cancel ?')"><button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">CANCEL</button></a>
                                                                                        &nbsp&nbsp
                                                                                        <input type="submit" name="submit_editparoki" value="SAVE" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">
                                                                                    </td> 
                                                                                </tr>
                                                                            </table>
                                                                        </div>             
                                                                    </div>
                                                                </div>
                                                                </form>    
                                                            </div>       
                                                        </div>
                                                        </div>   
                                                    </div> 
                                                </div>     
                                                </div>    
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            <!--</form>-->                 
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>    
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone('div#imageUploadBannerParoki', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'bannerparoki',
                clickable: true,
                thumbnailWidth:1456,
                thumbnailHeight:560,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax_upload.php',
                init: function () {

                    var myDropzone = this;
                    // Update selector to match your button
                    $("#uploaderBtnBannerParoki").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#imageUploadFormBannerParoki").serializeArray();
                        $.each(data, function (key, el) {
                            formData.append(el.name, el.value);
                        });
                        console.log(formData);

                    });
                },
                error: function (file, response){
                    if ($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                },
                successmultiple: function (file, response) {
                    console.log(file, response);
                    $('#successmodal').modal('show');
                    var delay = 2000;
                    setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    //$("#successModal").modal("show");
                },
                completemultiple: function (file, response) {
                    console.log(file, response, "completemultiple");
                    //$modal.modal("show");
                },
                reset: function () {
                    console.log("resetFiles");
                    this.removeAllFiles(true);
                }
            });
        </script>

        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone2 = new Dropzone('#addparokimodal div#imageUploadStaffParoki', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'staffparoki',
                clickable: true,
                thumbnailWidth:300,
                thumbnailHeight:300,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax_upload.php',
                init: function () {

                    var myDropzone2 = this;
                    // Update selector to match your button
                    $("#addparokimodal #uploaderBtnStaffParoki").click(function (e) {
                        e.preventDefault();
                        myDropzone2.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#addparokimodal #imageUploadFormStaffParoki").serializeArray();
                        $.each(data, function (key, el) {
                            formData.append(el.name, el.value);
                        });
                        console.log(formData);

                    });
                },
                error: function (file, response){
                    if ($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                },
                successmultiple: function (file, response) {
                    console.log(file, response);
                    $('#addparokimodal').modal('hide');
                    $('#successmodal').modal('show');
                    var delay = 2000;
                    setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    //$("#successModal").modal("show");
                },
                completemultiple: function (file, response) {
                    console.log(file, response, "completemultiple");
                    //$modal.modal("show");
                },
                reset: function () {
                    console.log("resetFiles");
                    this.removeAllFiles(true);
                }
            });
                
        </script>

        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone3 = new Dropzone('#updateparokimodal div#imageUpdateStaffParoki', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'updatestaffparoki',
                clickable: true,
                thumbnailWidth:300,
                thumbnailHeight:300,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax_upload.php',
                init: function () {

                    var myDropzone2 = this;
                    // Update selector to match your button
                    $("#updateparokimodal #updateBtnStaffParoki").click(function (e) {
                        e.preventDefault();
                        myDropzone2.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#updateparokimodal #imageUpdateFormStaffParoki").serializeArray();
                        $.each(data, function (key, el) {
                            formData.append(el.name, el.value);
                        });
                        console.log(formData);

                    });
                },
                error: function (file, response){
                    if ($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                },
                successmultiple: function (file, response) {
                    console.log(file, response);
                    $('#addparokimodal').modal('hide');
                    $('#successmodal').modal('show');
                    var delay = 2000;
                    setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    //$("#successModal").modal("show");
                },
                completemultiple: function (file, response) {
                    console.log(file, response, "completemultiple");
                    //$modal.modal("show");
                },
                reset: function () {
                    console.log("resetFiles");
                    this.removeAllFiles(true);
                }
            });
                
        </script>

        <script>
            $(document).on("click", ".datastaff", function () {
                var me      = $(this);
                var data    = me.attr('data-staff');
                var jdata   = JSON.parse(data);
                $("#updateparokimodal input[name=id_paroki]").val( jdata.id_staff);
                $("#updateparokimodal input[name=nama_paroki]").val( jdata.name_staff);
                $("#updateparokimodal input[name=jabatan_paroki]").val( jdata.position_staff);
                if(jdata.url_img!="")
                {
                    $("#updateparokimodal #photo_paroki").attr('src', jdata.photo_staff).show();
                    $("#updateparokimodal #btndeletephoto").show();
                    $("#updateparokimodal #imageUpdateStaffParoki").hide();
                    $("#updateparokimodal #updateBtnStaffParoki").hide();
                }    
                else
                {
                    $("#updateparokimodal #photo_paroki").hide();
                    $("#updateparokimodal #btndeletephoto").hide();
                    $("#updateparokimodal #imageUpdateStaffParoki").show();
                    $("#updateparokimodal #updateBtnStaffParoki").show();
                }    
            });
        </script>