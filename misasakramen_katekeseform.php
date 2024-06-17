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
            <?php
            if($id!=0)
            {
                $query_katekese = mysqli_query($con,"SELECT * FROM katekese WHERE id='$id'")or die (mysqli_error($con));
                $sum_katekese   = mysqli_num_rows($query_katekese);
                if($sum_katekese==0)
                {
                    echo "Data Tidak Ditemukan";
                    exit();
                }
                else
                {
                    $data_katekese  = mysqli_fetch_array($query_katekese);
                    $thumb_img      = $data_katekese['thumb_img'];
                    $banner_img     = $data_katekese['banner_img'];
                    $data_publish   = $data_katekese['publish_date'];
                    $exp_publish    = explode("-",$publish_data);
                    $ds             = $exp_publish[2];
                    $ms             = $exp_publish[1];
                    $ys             = $exp_publish[0];
                    $publish_date   = $ds.'/'.$ms.'/'.$ys;
                    $title          = $data_katekese['title'];
                    $highlight      = $data_katekese['highlight'];
                    $description    = $data_katekese['description'];
                }
            }
            else
            {
                $thumb_img      = "";
                $banner_img     = "";
                $data_publish   = "";
                $exp_publish    = "";
                $ds             = "";
                $ms             = "";
                $ys             = "";
                $publish_date   = "";
                $title          = "";
                $highlight      = "";
                $description    = "";
            }
            ?> 
            <!-- Main content -->
            <!--<form methode="POST">-->  
            <section class="content" id="katekeseform" style="margin-right: 50px;">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">THUMBNAIL <font color="red">*</font></label><br>
                                <font size="3">(250 x 250 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <?php
                                if($thumb_img!="")
                                {
                                ?>    
                                    <img id="thumb_img" src="<?php echo $base_assets.$thumb_img ?>"><br>
                                    <button id="btnreplacethumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                    <div id="uploadthumb" class="dropzone" style="display:none">
                                        <div class="dz-message">
                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                            <b>.JPG  .JPEG  .PNG</b><br>
                                            Drop files to upload <br>
                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                        </div>
                                    </div>
                                    <button id="btnuploadthumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display:none">UPLOAD</button>
                                    <button id="btncancelthumb" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
                                <?php
                                }
                                else
                                {
                                ?>    
                                    <img id="thumb_img"><br>
                                    <button id="btnreplacethumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display:none" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                    <div id="uploadthumb" class="dropzone">
                                        <div class="dz-message">
                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                            <b>.JPG  .JPEG  .PNG</b><br>
                                            Drop files to upload <br>
                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                        </div>
                                    </div>
                                    <button id="btnuploadthumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                                    <button id="btncancelthumb" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;display:none" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
                                <?php
                                }
                                ?>    
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">BANNER<font color="red">*</font></label><br>
                                <font size="3">(900 x 450 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <?php
                                if($banner_img!="")
                                {
                                ?>    
                                    <img id="banner_img" src="<?php echo $base_assets.$banner_img ?>"><br>
                                    <button id="btnreplacebanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                    <div id="uploadbanner" class="dropzone" style="display:none">
                                        <div class="dz-message">
                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                            <b>.JPG  .JPEG  .PNG</b><br>
                                            Drop files to upload <br>
                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                        </div>
                                    </div>
                                    <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display:none">UPLOAD</button>
                                    <button id="btncancelbanner" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;display:none" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <img id="banner_img"><br>
                                    <button id="btnreplacebanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display:none" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                    <div id="uploadbanner" class="dropzone">
                                        <div class="dz-message">
                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                            <b>.JPG  .JPEG  .PNG</b><br>
                                            Drop files to upload <br>
                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                        </div>
                                    </div>
                                    <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                                    <button id="btncancelbanner" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;display:none" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
                                <?php
                                }
                                ?>
                            </div>     
                        </div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">TANGGAL KATEKESE<font color="red">*</font></label>
                                <input type="text" class="form-control" name='publist' placeholder="dd/mm/yyyy" id="dp1" value="<?php echo $publish_date ?>">
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">JUDUL KATEKESE<font color="red">*</font></label>
                                <input type="text" class="form-control" name='title' placeholder="Type something here...." value="<?php echo $title ?>">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">DESKRIPSI SINGKAT<font color="red">*</font></label>
                                <input type="text" class="form-control" name='highlight' placeholder="Type something here...." value="<?php echo $highlight ?>">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">ISI KATEKESE<font color="red">*</font></label>
                                <textarea class="ckeditor" id="editordesc" name="editordesc" placeholder="Type something here...." style="margin-top: 0px; margin-bottom: 0px; height: 400px;" > <?php echo $description ?> </textarea>
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
            <!--</form>-->
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

        <!-- START REPLACE THUMBNAIL -->
        <script>
            $("#katekeseform #btnreplacethumb").click(function()
            {
                $("#katekeseform #uploadthumb").show();
                $("#katekeseform #btnuploadthumb").show();
                $("#katekeseform #btncancelthumb").show();
                $("#katekeseform #btnreplacethumb").hide();
                $("#katekeseform #thumb_img").hide();
            });
        </script>
        <!-- END REPLACE THUMBNAIL -->
        
        <!-- START CANCEL REPLACE THUMBNAIL -->
        <script>
            $("#katekeseform #btncancelthumb").click(function()
            {
                $("#katekeseform #uploadthumb").hide();
                $("#katekeseform #btnuploadthumb").hide();
                $("#katekeseform #btncancelthumb").hide();
                $("#katekeseform #btnreplacethumb").show();
                $("#katekeseform #thumb_img").show();
            });
        </script>
        <!-- END CANCEL REPLACE THUMBNAIL -->

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

        <!-- START REPLACE BANNER -->
        <script>
            $("#katekeseform #btnreplacebanner").click(function()
            {
                $("#katekeseform #uploadbanner").show();
                $("#katekeseform #btnuploadbanner").show();
                $("#katekeseform #btncancelbanner").show();
                $("#katekeseform #btnreplacebanner").hide();
                $("#katekeseform #banner_img").hide();
            });
        </script>
        <!-- END REPLACE BANNER -->
        
        <!-- START CANCEL REPLACE BANNER -->
        <script>
            $("#katekeseform #btncancelbanner").click(function()
            {
                $("#katekeseform #uploadbanner").hide();
                $("#katekeseform #btnuploadbanner").hide();
                $("#katekeseform #btncancelbanner").hide();
                $("#katekeseform #btnreplacebanner").show();
                $("#katekeseform #banner_img").show();
            });
        </script>
        <!-- END CANCEL REPLACE BANNER -->
         
        <!-- START SAVE TO DRAFT FORM -->
        <script>
            $("#katekeseform #btnsavedraft").click(function()
            {
                var thumb_data      = document.getElementById("thumb_img").src;
                var banner_data     = document.getElementById("banner_img").src;
                var publish_data    = $("#katekeseform #dp1").val();
                var title_data      = $("#katekeseform input[name=title]").val();
                var highlight_data  = $("#katekeseform input[name=highlight]").val();
                var desc_data       = CKEDITOR.instances['editordesc'].getData();
                alert(banner_data);
                /*
                if(thumb_data=="https://katedralcms.legkostproject.com/index.php?p=misasakramen_katekeseform" || banner_data=="https://katedralcms.legkostproject.com/index.php?p=misasakramen_katekeseform")
                {
                    notifmodal('Mohon lengkapi thumbnail atau banner dahulu','failed');
                }
                else
                {
                    $.post('ajax-misasakrame.php',
                    {
                        thumb_img:thumb_data,
                        banner_img:banner_data,
                        publish:publish_data,
                        title:title_data,
                        highlight:highlight_data,
                        description:desc_data,
                        draf_katekese:true
                    },
                    function(data,status)
                    {
                        if(data.error_status==1)
                        {
                            toastr['error'](data.error_message);
                        }
                        else
                        {
                            toastr['success'](data.error_message);
                            setTimeout(function(){ window.location ='index.php?p=misasakramen_katekese'; });
                        }
                        console.log(data,status);
                    }
                }
                */    
            });
        </script>
        <!-- END SAVE TO DRAFT FORM -->

        <!-- START CANCEL FORM -->
        <script>
            $("#btncancel").click(function()
            {
                setTimeout(function(){ window.location ='index.php?p=misasakramen_katekese'; });
            });
        </script>
        <!-- END CANCEL FORM -->