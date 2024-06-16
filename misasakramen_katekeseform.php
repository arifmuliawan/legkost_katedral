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
                                <img id="banner_img"><br>
                                <button id="btnreplacebanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
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
        <!-- END DROPZONE UPLOAD THUMBNAIL -->

        <!-- START DROPZONE UPLOAD BANNER -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone2 = new Dropzone('#katekeseform div#uploadbanner', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'katekese_banner',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-misasakrame.php',
                init: function () {

                    var myDropzone2 = this;
                    // Update selector to match your button
                    $("#katekeseform #btnuploadbanner").click(function (e) {
                        e.preventDefault();
                        myDropzone2.processQueue();
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
                        $("#katekeseform #uploadbanner").hide();
                        $("#katekeseform #btnuploadbanner").hide();
                        $("#katekeseform #banner_img").attr('src', response.banner_img).show();
                        $("#katekeseform #btnreplacebanner").show();
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
        <!-- END DROPZONE UPLOAD BANNER -->    