        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">KATEKESE</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section> 

            <!-- Main content -->
            <section class="content" id="katekeselist">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12" style="text-align:right">
                            <?php
                            $katekese_json    = array(
                                'id_katekese' => 0
                            );    
                            ?>    
                            <button type="button" id="btnformkatekese" data-katekese='<?php echo json_encode($katekese_json) ?>' class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                Add New
                            </button>
                        </div>
                        <!-- left column -->
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <table width="100%">
                                <tr>
                                    <td width="20%">
                                        <img src="https://placehold.co/250" width="80%">
                                    </td> 
                                    <td width="65%">
                                        27 Agustus 2024 <br>
                                        <h5> katekese sakramen penguatan </h5>
                                    </td>
                                    <td width="15%">
                                        <button type="button" class="btnedit" title="Edit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" data-toggle="modal" data-target="#modaldetailperkawinan" data-perkawinan='<?php echo json_encode($perkawinan_json) ?>'>
                                            <i class="fa fa-edit" style="color: #fff;"></i>
                                        </button>
                                        &nbsp&nbsp&nbsp
                                        <button type="button" class="btndelete" title="Delete" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                            <i class="fa fa-trash" style="color: #fff;"></i>
                                        </button>
                                    </td> 
                                </tr>
                            </table>           
                        </div>
                    </div>    
                </div> 
            </section> 
            <!-- Main content -->
            <section class="content" id="katekeseform" style="display:none;margin-right: 50px;">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">THUMBNAIL <font color="red">*</font></label><br>
                                <font size="3">(250 x 250 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <img id="thumb_img"><br>
                                <button id="btnreplacethumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                <div id="uploadthumb" class="dropzone">
                                    <div class="dz-message">
                                        <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                        <b>.JPG  .JPEG  .PNG</b><br>
                                        Drop files to upload <br>
                                        or <font color='#88A8D4'><b>Browse Files...</b></font>
                                    </div>
                                </div>
                                <button id="btnuploadthumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">BANNER<font color="red">*</font></label><br>
                                <font size="3">(900 x 450 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <div id="uploadbanner" class="dropzone">
                                    <div class="dz-message">
                                        <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                        <b>.JPG  .JPEG  .PNG</b><br>
                                        Drop files to upload <br>
                                        or <font color='#88A8D4'><b>Browse Files...</b></font>
                                    </div>
                                </div>
                                <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                            </div>     
                        </div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">TANGGAL KATEKESE<font color="red">*</font></label>
                                <input type="text" class="form-control" name='publist_start' placeholder="dd/mm/yyyy" id="dp1">
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">JUDUL KATEKESE<font color="red">*</font></label>
                                <input type="text" class="form-control" name='title' placeholder="Type something here....">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">DESKRIPSI SINGKAT<font color="red">*</font></label>
                                <input type="text" class="form-control" name='highlight' placeholder="Type something here....">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">ISI KATEKESE<font color="red">*</font></label>
                                <textarea class="ckeditor" id="editordesc" name="editordesc" placeholder="Type something here...." style="margin-top: 0px; margin-bottom: 0px; height: 400px;" > </textarea>
                            </div>     
                        </div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;text-align:left">
                            <button id="btncancel" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;">CANCEL</button>
                        </div>
                        <div class="col-md-6" style="flex: unset;margin-left: 125px;text-align:right">
                            <button id="btnsavedraft" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">SAVE TO DRAFT</button>
                            &nbsp&nbsp&nbsp
                            <button id="btnsavepublish" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">SAVE TO PUBLISH</button>
                        </div>
                    </div>    
                </div> 
            </section>           
        </div>

        <!-- START ACTIVE FORM KATEKESE -->
        <script>
            $("#katekeselist #btnformkatekese").click(function()
            {
                var me      = $(this);
                var data    = me.attr('data-katekese');
                var jdata   = JSON.parse(data);
                if(jdata.id_katekese==0)
                {
                    $("#katekeselist").hide();
                    $("#katekeseform").show();
                    $("#katekeseform #thumb_img").hide();
                    $("#katekeseform #btnreplacethumb").hide();
                }   
                else
                {
                    $.post('ajax-misasakrame.php',
                    {
                        id:jdata.id_katekese,
                        detail_katekese:true
                    },
                    function(data,status)
                    {
                        if(data.error_status==1)
                        {
                            toastr['error'](data.error_message);
                        }
                        else
                        {
                            $("#katekeselist").hide();
                            $("#katekeseform").show();
                        }
                        console.log(data,status);
                    }
                    );
                } 
            });
        </script>
        <!-- END ACTIVE FORM KATEKESE -->
        
        <!-- START CANCEL FORM KATEKESE -->
        <script>
            $("#katekeseform #btncancel").click(function()
            {
                $("#katekeselist").show();
                $("#katekeseform").hide();
            });
        </script>
        <!-- END CANCEL FORM KATEKESE -->

        <!-- START DROPZONE UPLOAD THUMBNAIL -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone('#katekeseform div#uploadthumb', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'katekese_thumbnail',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-misasakrame.php',
                init: function () {

                    var myDropzone = this;
                    // Update selector to match your button
                    $("#katekeseform #btnuploadthumb").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#katekeseform").serializeArray();
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
                        $("#katekeselist").hide();
                        $("#katekeseform").show();
                        $("#katekeseform #uploadthumb").hide();
                        $("#katekeseform #btnuploadthumb").hide();
                        $("#katekeseform #thumb_img").attr('src', response.thumb_img).show();
                        $("#katekeseform #btnreplacethumb").show();
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
        <!-- END DROPZONE UPLOAD REGISTER -->