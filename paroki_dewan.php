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
                    <!-- HANDLE BANNER PAROKI --->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <?php
                            $query_paroki_assets    = mysqli_query($con,"SELECT * FROM paroki_asset WHERE id='1' AND code='1'")or die (mysqli_error($con));
                            $data_paroki_assets     = mysqli_fetch_array($query_paroki_assets);
                            $banner_paroki_assets   = $data_paroki_assets['url_img'];
                            if($banner_paroki_assets!='')
                            {
                                $banner_paroki  = $base_assets.$banner_paroki_assets;
                            }
                            else
                            {
                                $banner_paroki  = "";
                            }
                            ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>FOTO BANNER <font color='red'>*</font></label> <br>
                                    (1820 x 700 px) JPG/JPEG/PNG
                                </div>
                                <?php
                                if($banner_paroki!="")
                                {
                                ?>    
                                    <form id="formbanner">
                                        <img src="<?php echo $banner_paroki ?>" id="imgbanner" style="width: 100%;">
                                        <button id="btnreplacebanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">REPLACE</button>
                                        <div id="uploadbanner" class="dropzone" style="display:none">
                                            <div class="dz-message">
                                                <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                <b>.JPG  .JPEG  .PNG</b><br>
                                                Drop files to upload <br>
                                                or <font color='#88A8D4'><b>Browse Files...</b></font>
                                            </div>
                                        </div>
                                        <br>
                                        <button id="btnsavebanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display:none">SAVE</button>
                                        &nbsp&nbsp&nbsp&nbsp&nbsp
                                        <button id="btncancelbanner" type="button" class="btn" style="background-color: rgb(233, 0, 0); color: rgb(255, 255, 255); font-weight: bold; margin: 15px 0px;display:none">CANCEL</button>
                                    </form>    
                                <?php
                                }
                                else
                                {
                                ?>
                                    <form id="formuploadbanner">
                                        <div id="uploadbanner" class="dropzone">
                                            <div class="dz-message">
                                                <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                <b>.JPG  .JPEG  .PNG</b><br>
                                                Drop files to upload <br>
                                                or <font color='#88A8D4'><b>Browse Files...</b></font>
                                            </div>
                                        </div>
                                        <br>
                                        <button id="btnsavebanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                    </form>
                                <?php
                                }
                                ?>    
                            </div>
                        </div>
                    </div>
                    <!-- HANDLE PERIODE PAROKI --->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="">
                        <!-- /.card-header -->
                            <?php
                            $query_paroki_periode   = mysqli_query($con,"SELECT * FROM paroki_asset WHERE id='2' AND code='2'")or die (mysqli_error($con));
                            $data_paroki_periode    = mysqli_fetch_array($query_paroki_periode);
                            $paroki_periode         = $data_paroki_periode['url_img'];
                            ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>PERIODE JABATAN <font color='red'>*</font></label> 
                                </div>
                                <form id="formperiode">
                                    <input type="text" class="form-control" placeholder="Type something here...." name="periodeparoki" value="<?php echo $paroki_periode ?>">
                                    <br>
                                    <button id="btnsaveperiode" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                </form>   
                            </div>
                        </div>
                    </div>
                    <!-- HANDLE PAROKI LIST --->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="">
                        <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row" id=list-paroki>
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
                                                    <button type="button" class="btn" style="background-color:#9C9C9C;color: #ffffff;font-weight: bold;" id="delete_selected">DELETE SELECTED</button>
                                                    <button type="button" class="btn" style="background-color:#ffffff;color: #9C9C9C;font-weight: bold;border-color: #9C9C9C;margin-left: 20px;" onclick="clearAll()">CLEAR SELECTION</button>
                                                </td> 
                                                <td width="50%" style="text-align: right;">
                                                    <button type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;" data-toggle="modal" data-target="#modaladdparoki">ADD NEW</button>
                                                </td>
                                            </tr>
                                        </table>
                                        <br><br>
                                    </div> 
                                    <?php
                                    $query_paroki_list      = mysqli_query($con,"SELECT * FROM paroki_staff WHERE visible='Y' order by sortid ASC")or die (mysqli_error($con));
                                    $sum_paroki_list        = mysqli_num_rows($query_paroki_list);
                                    if($sum_paroki_list>0)
                                    {
                                        while($data_paroki=mysqli_fetch_array($query_paroki_list))
                                        {
                                            $id_paroki          = $data_paroki['id'];
                                            $sortid_paroki      = $data_paroki['sortid'];
                                            $name_paroki        = $data_paroki['name'];
                                            $position_paroki    = $data_paroki['position'];
                                            $photo_data         = $data_paroki['url_img'];
                                            if($photo_data!="")
                                            {
                                                $photo_paroki   = $base_assets."".str_replace(" ", "%20",$photo_data);
                                            }
                                            else
                                            {
                                                $photo_paroki   = "https://placehold.co/500x500";
                                            }
                                            $paroki_json      = array(
                                                'id_paroki'      => $id_paroki,
                                                'name_paroki'    => $name_paroki,
                                                'position_paroki'=> $position_paroki,
                                                'photo_paroki'   => $photo_paroki                                     
                                            );
                                    ?>
                                            <div class="col-md-3" id="<?php echo $sortid_paroki ?>" data-id="<?php echo $id_paroki ?>" data-sec="<?php echo $sortid_paroki ?>">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-body pt-3">
                                                        <input type="checkbox" class="parokicheckbox" name="parokicheckbox[]" data-paroki="<?php echo $id_paroki ?>" style="position: absolute;width: 30px;height: 30px;">
                                                        <img class="dataparoki" src=<?php echo $photo_paroki ?> width="100%" data-toggle="modal" data-target="#modaldetailparoki" data-paroki='<?php echo json_encode($paroki_json) ?>'>
                                                    </div>
                                                    <div class="card-footer" style="text-align:right">
                                                        <input type="hidden" name="id_paroki" value="<?php echo $id_paroki ?>">
                                                        <input type="hidden" name="delete_paroki">
                                                        <button id="btndeleteparoki" type="button" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;margin-top: 25px;" class="btn-sm" data-paroki-2='<?php echo json_encode($paroki_json) ?>'><i class="nav-icon fas fa-trash"></i></button>
                                                    </div>
                                                </div>
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
            </section>  
        </div>
        <!-- START MODAL FORM ADD PAROKI -->
        <div class="modal fade" id="modaladdparoki" style="pointer-events: none;">
            <div class="modal-dialog" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-body" style="padding: 40px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="formaddparoki">
                                        <div class="card-body">    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>FOTO PENGURUS <font color='red'>*</font></label> <br>
                                                        (500 x 500 px) JPG/JPEG/PNG
                                                    </div>
                                                    <div id="photo_paroki" class="dropzone">
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
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">NAMA <font color='red'>*</font></label>
                                                                <input type="text" name="name_paroki" class="form-control" placeholder="Type something here...."  <?php if(isset($err_upnama) && $err_upnama==1){ echo "style='border-color: red;'"; } ?> required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">JABATAN <font color='red'>*</font></label>
                                                                <input type="text" name="position_paroki" class="form-control" placeholder="Type something here...." <?php if(isset($err_upjabatan) && $err_upjabatan==1){ echo "style='border-color: red;'"; } ?> required>
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
                                                                            <button id="btnaddparoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                                                            &nbsp&nbsp
                                                                            <a href="" onclick="return confirm('Are you sure you want to cancel ?')"><button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">CANCEL</button></a>
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
        <!-- END MODAL FORM ADD PAROKI -->
        <!-- START MODAL FORM DETAIL PAROKI -->
        <div class="modal fade" id="modaldetailparoki" style="pointer-events: none;">
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
                                                <img src="" id="detail_photo_paroki" width="300px">
                                                <input type="hidden" name="id_paroki">
                                                <input type="hidden" name="delete_photo_paroki">
                                                <!--<button id="btndeletephotoparoki" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin-top: 15px;" onclick="return confirm('Are you sure you want to delete this item ?')">DELETE</button>-->
                                                <button id="btnreplacephotoparoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin-top: 15px;">REPLACE</button>
                                                <form id="formdetailparoki">
                                                    <input type="hidden" name="id_paroki">
                                                    <div id="photo_paroki" class="dropzone">
                                                        <div class="dz-message">
                                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                            <b>.JPG  .JPEG  .PNG</b><br>
                                                            Drop files to upload <br>
                                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                                        </div>
                                                    </div>
                                                    <button id="btnupdatephotoparoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin-top: 15px;">SAVE</button>
                                                    <button id="btncancelphotoparoki" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin-top: 15px;margin-left:10px;display:none">CANCEL</button>
                                                </form>  
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id_paroki">
                                                                <input type="hidden" name="edit_paroki">
                                                                <label class="form-label">NAMA <font color='red'>*</font></label>
                                                                <input type="text" name="name_paroki" class="form-control" placeholder="Type something here....">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">JABATAN <font color='red'>*</font></label>
                                                                <input type="text" name="position_paroki" class="form-control" placeholder="Type something here....">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <table border=0 width="100%">
                                                                <tr>
                                                                    <td style="text-align: right;">
                                                                        <a href="" onclick="return confirm('Are you sure you want to cancel ?')"><button type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;">CANCEL</button></a>
                                                                        &nbsp&nbsp
                                                                        <button id="btnupdatedetailparoki" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                                                    </td> 
                                                                </tr>
                                                            </table>
                                                        </div>             
                                                    </div>
                                                </div>   
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
        <!-- END MODAL FORM DETAIL PAROKI -->
        <!-- START MODAL WARNING DELETE PAROKI -->
        <div class="modal fade" id="notifwarningdeleteparoki">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                    <img src="assets/dist/img/icon_warning.png" style="width: 70px;">
                        <br><br>
                        <h5> Apakah anda yakin untuk menghapus data ?</h5>
                        <input type="hidden" name="id_paroki">
                        <table width="100%">
                            <tr>
                                <td width="25%"> 
                                    <button id="btnmodalcancel" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;">CANCEL</button>
                                </td>
                                <td width="75%" style="text-align:right"> 
                                    <button id="btnmodalok" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">OK</button>
                                </td>
                            </tr>
                        </table>     
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- START REPLACE BANNER -->
        <script>
            $("#formbanner #btnreplacebanner").click(function()
            {
                $("#formbanner #uploadbanner").show();
                $("#formbanner #btncancelbanner").show();
                $("#formbanner #btnsavebanner").show();
                $("#formbanner #imgbanner").hide();
                $("#formbanner #btnreplacebanner").hide();
            });
        </script>
        <!-- END REPLACE BANNER -->
        
        <!-- START CANCEL REPLACE BANNER -->
        <script>
            $("#formbanner #btncancelbanner").click(function()
            {
                $("#formbanner #uploadbanner").hide();
                $("#formbanner #btncancelbanner").hide();
                $("#formbanner #btnsavebanner").hide();
                $("#formbanner #imgbanner").show();
                $("#formbanner #btnreplacebanner").show();
            });
        </script>
        <!-- END CANCEL REPLACE BANNER -->

        <!-- START DROPZONE UPLOAD BANNER PAROKI -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone('div#uploadbanner', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'bannerparoki',
                clickable: true,
                thumbnailWidth:500,
                thumbnailHeight:190,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-paroki-assets.php',
                init: function () {

                    var myDropzone = this;
                    // Update selector to match your button
                    $("#btnsavebanner").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#formuploadbanner").serializeArray();
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
                    if(response.error_status==1)
                    {
                        notifmodal(response.error_message,'failed');
                    }
                    console.log(data,status);
                    return _results;
                },
                successmultiple: function (file, response) {
                    if(response.error_status==0)
                    {
                        notifmodal(response.error_message,'success');
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                        /*$("#formuploadbanner #upload_banner").hide();
                        $("#formuploadbanner #btnsavebanner").hide();
                        $("#formbanner #imgbanner").attr('src', response.banner).show();
                        $("#formbanner #btndeletebanner").show();*/
                    }
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
        <!-- END DROPZONE & NOTIF UPLOAD BANNER PAROKI -->  
        <!-- START SAVE PERIODE PAROKI -->
        <script>
            $("#btnsaveperiode").click(function()
            {
                $.post('ajax-paroki-assets.php',
                {
                    update_periode:$("#formperiode input[name=periodeparoki]").val()
                },
                function(data,status)
                {
                    if(data.error_status=='1')
                    {
                        notifmodal(data.error_message,'failed');    
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    }
                    else
                    {
                        notifmodal(data.error_message,'success');
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    }
                    console.log(data,status);
                }
                );
            });   
        </script>  
        <!-- END SAVE PERIODE PAROKI -->
        <!-- START DROPZONE ADD PAROKI LIST -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone2 = new Dropzone('#modaladdparoki div#photo_paroki', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'add_paroki',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-paroki-assets.php',
                init: function () {

                    var myDropzone2 = this;
                    // Update selector to match your button
                    $("#modaladdparoki #btnaddparoki").click(function (e) {
                        e.preventDefault();
                        myDropzone2.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#modaladdparoki #formaddparoki").serializeArray();
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
                    if(response.error_status==1)
                    {
                        toastr['error'](response.error_message);
                        var delay = 3000;
                    }
                    console.log(data,status);
                    return _results;
                },
                successmultiple: function (file, response) {
                    if(response.error_status==0)
                    {
                        toastr['success'](response.error_message);
                        var delay = 3000;
                        setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, delay);
                    }
                    else
                    {
                        toastr['error'](response.error_message);
                        var delay = 3000;
                    }
                    console.log(file, response);
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
        <!-- END DROPZONE ADD PAROKI LIST -->
        <!-- START DATA DETAIL PAROKI LIST -->
        <script>
            $(document).on("click", ".dataparoki", function () {
                var me      = $(this);
                var data    = me.attr('data-paroki');
                var jdata   = JSON.parse(data);
                $("#modaldetailparoki input[name=id_paroki]").val( jdata.id_paroki);
                $("#modaldetailparoki input[name=name_paroki]").val( jdata.name_paroki);
                $("#modaldetailparoki input[name=position_paroki]").val( jdata.position_paroki);
                if(jdata.photo_paroki.includes("placehold.co")===true)
                {
                    $("#modaldetailparoki #detail_photo_paroki").hide();
                    $("#modaldetailparoki #btndeletephotoparoki").hide();
                    $("#modaldetailparoki #photo_paroki").show();
                    $("#modaldetailparoki #btnupdatephotoparoki").show();
                }    
                else
                {
                    $("#modaldetailparoki #detail_photo_paroki").attr('src', jdata.photo_paroki).show();
                    $("#modaldetailparoki #btndeletephotoparoki").show();
                    $("#modaldetailparoki #photo_paroki").hide();
                    $("#modaldetailparoki #btnupdatephotoparoki").hide();
                }    
            });
        </script>
        <!-- END DATA DETAIL PAROKI LIST -->
        <!-- START DELETE PHOTO PAROKI -->
        <script>
            $("#btndeletephotoparoki").click(function()
            {
                $.post('ajax-paroki-assets.php',
                {
                    id_paroki:$("#modaldetailparoki input[name=id_paroki]").val(),
                    delete_photo_paroki:$("#modaldetailparoki input[name=delete_photo_paroki]").val()
                },
                function(data,status)
                {
                    if(data.error_status=='1')
                    {
                        toastr['error'](data.error_message);
                        var delay = 3000;
                    }
                    else
                    {
                        toastr['success'](data.error_message);
                        var delay = 3000;
                        $("#modaldetailparoki #detail_photo_paroki").hide();
                        $("#modaldetailparoki #btndeletephotoparoki").hide();
                        $("#formdetailparoki #photo_paroki").show();
                        $("#modaldetailparoki #btnupdatephotoparoki").show();
                    }
                    console.log(data,status);
                }
                );
            });   
        </script>
        <!-- END DELETE PHOTO PAROKI -->
        <!-- START DROPZONE UPDATE PAROKI LIST -->    
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone3 = new Dropzone('#modaldetailparoki div#photo_paroki', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'update_photo_paroki',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-paroki-assets.php',
                init: function () {

                    var myDropzone3 = this;
                    // Update selector to match your button
                    $("#modaldetailparoki #btnupdatephotoparoki").click(function (e) {
                        e.preventDefault();
                        myDropzone3.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#modaldetailparoki #formdetailparoki").serializeArray();
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
                    if(response.error_status==1)
                    {
                        toastr['error'](response.error_message);
                        var delay = 3000;
                    }
                    console.log(data,status);
                    return _results;
                },
                successmultiple: function (file, response) {
                    if(response.error_status==0)
                    {
                        toastr['success'](response.error_message);
                        var delay = 3000;
                        $("#modaldetailparoki #detail_photo_paroki").attr('src', response.new_photo).show();
                        $("#modaldetailparoki #btndeletephotoparoki").show();
                        $("#formdetailparoki #photo_paroki").hide();
                        $("#modaldetailparoki #btnupdatephotoparoki").hide();
                    }
                    else
                    {
                        toastr['error'](response.error_message);
                        var delay = 3000;
                    }
                    console.log(file, response);
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
        <!-- END DROPZONE UPDATE PAROKI LIST -->
        <!-- START UPDATE DATA PAROKI LIST -->
        <script>
            $("#btnupdatedetailparoki").click(function()
            {
                $.post('ajax-paroki-assets.php',
                {
                    id_paroki:$("#modaldetailparoki input[name=id_paroki]").val(),
                    name_paroki:$("#modaldetailparoki input[name=name_paroki]").val(),
                    position_paroki:$("#modaldetailparoki input[name=position_paroki]").val(),
                    edit_paroki:$("#modaldetailparoki input[name=edit_paroki]").val()
                },
                function(data,status)
                {
                    if(data.error_status==1)
                    {
                        toastr['error'](data.error_message);
                        var delay = 3000;
                    }
                    else
                    {
                        toastr['success'](data.error_message);
                        var delay = 3000;
                    }
                    console.log(data,status);
                }
                );
            });   
        </script> 
        <!-- END UPDATE DATA PAROKI LIST -->
        
        <!-- START DELETE DATA PAROKI LIST -->
        <script>
            $("#list-paroki #btndeleteparoki").click(function()
            {
                var me2      = $(this);
                var data2    = me2.attr('data-paroki-2');
                var jdata2   = JSON.parse(data2);
                $("#notifwarningdeleteparoki input[name=id_paroki]").val( jdata2.id_paroki);
                $("#notifwarningdeleteparoki").modal("show");
            });
            
            $("#notifwarningdeleteparoki #btnmodalcancel").click(function()
            {
                $("#notifwarningdeleteparoki").modal("hide");
            });

            $("#notifwarningdeleteparoki #btnmodalok").click(function()
            {
                /*
                var me2      = $(this);
                var data2    = me2.attr('data-paroki-2');
                var jdata2   = JSON.parse(data2);
                */
                $.post('ajax-paroki-assets.php',
                {
                    id_paroki:$("#notifwarningdeleteparoki input[name=id_paroki]").val(),
                    delete_paroki:true
                },
                function(data,status)
                {
                    if(data.error_status==1)
                    {
                        notifmodal(data.error_message,'failed');
                        //toastr['error'](data.error_message);
                        var delay = 3000;
                    }
                    else
                    {
                        notifmodal(data.error_message,'success');
                        //toastr['success'](data.error_message);
                        setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, 3000);
                    }
                    console.log(data,status);
                }
                );
            });   
        </script> 
        <!-- END DELETE DATA PAROKI LIST -->
        <!-- START CHANGE SORT DEWAN PAROKI -->
        <script type="text/javascript">
            var parokilist  = document.querySelector('#list-paroki');
            var sortable    = Sortable.create(parokilist,{
            onUpdate: function (/**Event*/evt) {
                arr = [];index=0
                $('.col-md-3').each(function(item){
                arr.push({id:$(this).attr('data-id'),sort:index++})
                })
                    updatelistparoki(arr);
                },

            });
            
            function updatelistparoki(data) {
                $.ajax({
                    url:"change_sort.php",
                    type:'post',
                    data:{position:data,table:'paroki_staff'},
                    success:function(){
                        //alert('your change successfully saved');
                        //location.reload();
                    }
                })
            }
        </script>
        <!-- START CHANGE SORT DEWAN PAROKI -->

        <!-- START REPLACE PHOTO PAROKI -->
        <script>
            $("#modaldetailparoki #btnreplacephotoparoki").click(function()
            {
                $("#modaldetailparoki #detail_photo_paroki").hide();
                $("#modaldetailparoki #btnreplacephotoparoki").hide();
                $("#formdetailparoki #photo_paroki").show();
                $("#modaldetailparoki #btnupdatephotoparoki").show();
                $("#modaldetailparoki #btncancelphotoparoki").show();
            });
        </script>
        <!-- END REPLACE PHOTO PAROKI -->

        <!-- START CANCEL REPLACE PHOTO PAROKI -->
        <script>
            $("#modaldetailparoki #btncancelphotoparoki").click(function()
            {
                $("#modaldetailparoki #detail_photo_paroki").show();
                $("#modaldetailparoki #btnreplacephotoparoki").show();
                $("#formdetailparoki #photo_paroki").hide();
                $("#modaldetailparoki #btnupdatephotoparoki").hide();
                $("#modaldetailparoki #btncancelphotoparoki").hide();
            });
        </script>
        <!-- END CANCEL REPLACE PHOTO PAROKI -->

        <!-- START CLEAR CHECKBOX -->
        <script>
 
            // Create function of check/uncheck box
            function clearAll() {

                let inputs = document.querySelectorAll('.parokicheckbox');

                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].checked = false;
                }
            }

        </script>
        <!-- END CLEAR CHECKBOX -->

        <!-- START DELETE CHECKBOX -->
        <script>
            $('#delete_selected').on('click', function(e) { 
                var paroki = [];
                $(".parokicheckbox:checked").each(function() {  
                    paroki.push($(this).data('paroki'));
                });	
                if(paroki.length <=0)  {  
                    alert("Please select records.");  
                }
                else
                {
                    WRN_PAROKI_DELETE = "Are you sure you want to delete "+(paroki.length>1?"these":"this")+" row?";  
                    var checked = confirm(WRN_PAROKI_DELETE);  
                    if(checked == true) {			
                        var selected_values = paroki.join(","); 
                        $.ajax({ 
                            type: "POST",  
                            url: "ajax-paroki-assets.php?action=delete_selected_paroki",  
                            cache:false,  
                            data: 'paroki_id='+selected_values,  
                            success: function(response) {	
                                notifmodal(response.error_message,'success');
                                setTimeout(function(){ window.location ='index.php?p=paroki_dewan'; }, 3000);									
                            }   
                        });				
                    }
                }
            });    
        </script>
        <!-- END CLEAR CHECKBOX -->