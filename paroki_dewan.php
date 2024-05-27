<?php
$query_banner   = mysqli_query($con,"SELECT * FROM banner WHERE id='1' AND code='1' AND visible='Y'");
$sum_banner     = mysqli_num_rows($query_banner);
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
if((isset($action)) && $action==4)
{
    $delete_banner  = mysqli_query($con,"UPDATE banner SET url_img='' WHERE id='1' AND code='1'");
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
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">    
                                <form id="imageUploadFormBannerParoki">
                                    <div class="form-group">
                                        <label>FOTO BANNER *</label>
                                        (1820 x 595 px) JPG/JPEG/PNG
                                    </div>
                                    <?php
                                    if($banner_image!="")
                                    {
                                    ?>    
                                        <img src='<?php echo $banner_image ?>' width='50%'> <br>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <div id="imageUploadBannerParoki" class="dropzone"></div>
                                    <?php
                                    }
                                    ?>    
                                    <br>
                                    <button id="uploaderBtnBannerParoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                    &nbsp&nbsp
                                    <a href="index.php?p=paroki_dewan&a=4"><button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">DELETE</button></a>
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
                paramName: 'bannerparoki',
                clickable: true,
                thumbnailWidth:500,
                thumbnailHeight:500,
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
                    $(window).on('load', function() 
                    {
                        $('#successmodal').modal('show');
                    });
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