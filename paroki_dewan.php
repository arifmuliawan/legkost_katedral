<?php
if(isset($_FILES['banner']))
{
    if($_FILES['banner']['name']!='')
    {
        $ekstensi_diperbolehkan  = array('png','jpg','jpeg');
        $nama_banner             = $_FILES['banner']['name'];
        $x_banner                = explode('.', $nama_banner);
        $ekstensi_banner         = strtolower(end($x_banner));
        $ukuran_banner           = $_FILES['banner']['size'];
        $file_tmp_banner         = $_FILES['banner']['tmp_name'];
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
        <div class="modal fade" id="successmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                        <img src="<?php echo $base_assets ?>dist/img/icon_success.png" style="width: 70px;">
                        <br><br>
                        <h5> Perubahan anda telah berhasil disimpan </h5> 
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
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">
                                <form id="imageUploadFormBannerParoki">
                                    <div class="form-group">
                                        <label>FOTO BANNER *</label>
                                        (1820 x 595 px) JPG/JPEG/PNG
                                    </div>
                                    <div id="imageUploadBannerParoki" class="dropzone"></div>
                                    <br>
                                    <button id="uploaderBtnBannerParoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                    &nbsp&nbsp
                                    <button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">DELETE</button>
                                </form>
                            </div>
                        <!--</form>-->                    
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">PERIODE JABATAN *</label>
                                                <input type="text" name="periode_paroki" class="form-control" placeholder="Type something here....">
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
                                                    <button type="submit" class="btn" name="submit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button>
                                                </td> 
                                            </tr>
                                        </table>
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

        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone('div#imageUploadBannerParoki', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 3,
                paramName: 'banner',
                clickable: true,
                thumbnailWidth:500,
                thumbnailHeight:500,
                url: '<?php echo $base_current ?>',
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
                    $("#successModal").modal("show");
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