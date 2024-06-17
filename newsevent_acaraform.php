        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">ACARA & BERITA</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            if($id!=0)
            {
                $query_acara = mysqli_query($con,"SELECT * FROM acara WHERE id='$id'")or die (mysqli_error($con));
                $sum_acara   = mysqli_num_rows($query_acara);
                if($sum_acara==0)
                {
                    echo "Data Tidak Ditemukan";
                    exit();
                }
                else
                {
                    $data_acara     = mysqli_fetch_array($query_acara);
                    $thumb_img      = $data_acara['thumb_img'];
                    $banner_img     = $data_acara['banner_img'];
                    $publish_data   = $data_acara['publish_date'];
                    $exp_publish    = explode("-",$publish_data);
                    $ds             = $exp_publish[2];
                    $ms             = $exp_publish[1];
                    $ys             = $exp_publish[0];
                    $publish_date   = $ds.'/'.$ms.'/'.$ys;
                    $title          = $data_acara['title'];
                    $highlight      = $data_acara['highlight'];
                    $description    = $data_acara['description'];
                    $status         = $data_acara['visible'];
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
                $status         = "";
            }
            ?> 
            <!-- Main content -->
            <!--<form methode="POST">-->  
            <section class="content" id="acaraform" style="margin-right: 50px;">
                <input type="hidden" name="acaraid" value="<?php echo $id ?>">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">THUMBNAIL <font color="red">*</font></label><br>
                                <font size="3">(450 x 450 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <?php
                                if($thumb_img!="")
                                {
                                ?>    
                                    <img id="thumb_img" src="<?php echo $thumb_img ?>"><br>
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
                                    <button id="btncancelthumb" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;display:none" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
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
                                <font size="3">(850 x 450 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <?php
                                if($banner_img!="")
                                {
                                ?>    
                                    <img id="banner_img" src="<?php echo $banner_img ?>"><br>
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
                                <label class="form-label">TANGGAL BERITA<font color="red">*</font></label>
                                <input type="text" class="form-control" name='publist' placeholder="dd/mm/yyyy" id="dp1" value="<?php echo $publish_date ?>">
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">JUDUL BERITA<font color="red">*</font></label>
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
                                <label class="form-label">ISI BERITA<font color="red">*</font></label>
                                <textarea class="ckeditor" id="editordesc" name="editordesc" placeholder="Type something here...." style="margin-top: 0px; margin-bottom: 0px; height: 400px;" > <?php echo $description ?> </textarea>
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">GALERI FOTO</label>
                                <div class="row">
                                    <?php
                                    $query_gallery  = mysqli_query($con,"SELECT * FROM acara_galeri WHERE id='$id' order by sortid ASC")or die (mysqli_error($con));
                                    $sum_gallery    = mysqli_num_rows($query_gallery);
                                    if($sum_gallery>0)
                                    {
                                        while($data_gallery=mysqli_fetch_array($query_gallery))
                                        {
                                            $id_gallery     = $data_gallery['id'];
                                            $sortid_gallery = $data_gallery['sortid'];
                                            $acaraid_gallery= $data_gallery['acaraid'];
                                            $img_gallery    = $data_gallery['img'];
                                            $gallery_json   = array(
                                                'id_gallery'     => $id_gallery,
                                                'sortid_gallery' => $sortid_gallery,
                                                'acaraid_gallery'=> $acaraid_gallery
                                            );
                                    ?>
                                            <div class="col-md-4">
                                                <img id="gallery_img" src="<?php echo $img_gallery ?>">
                                                <button id="btnuploadgallery" data-gallery='<?php echo json_encode($gallery_json) ?>' type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin: 15px 0px;">DELETE</button>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-md-4">
                                        <div id="uploadgallery" class="dropzone">
                                            <div class="dz-message">
                                                <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                <b>.JPG  .JPEG  .PNG</b><br>
                                                Drop files to upload <br>
                                                or <font color='#88A8D4'><b>Browse Files...</b></font>
                                            </div>
                                        </div>
                                        <button id="btnuploadgallery" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;text-align:left">
                            <button id="btncancel" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;">CANCEL</button>
                        </div>
                        <div class="col-md-6" style="flex: unset;margin-left: 125px;text-align:right">
                            <?php
                            if($status!='P')
                            {
                            ?>    
                                <button id="btnsavedraft" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">SAVE TO DRAFT</button>
                                &nbsp&nbsp&nbsp
                            <?php
                            }
                            ?>    
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
            myDropzone = new Dropzone('#acaraform div#uploadthumb', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'acara_thumbnail',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-newsevent.php',
                init: function () {

                    var myDropzone = this;
                    // Update selector to match your button
                    $("#acaraform #btnuploadthumb").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#acaraform").serializeArray();
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
                        $("#acaraform #uploadthumb").hide();
                        $("#acaraform #btnuploadthumb").hide();
                        $("#acaraform #thumb_img").attr('src', response.thumb_img).show();
                        $("#acaraform #btnreplacethumb").show();
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
            $("#acaraform #btnreplacethumb").click(function()
            {
                $("#acaraform #uploadthumb").show();
                $("#acaraform #btnuploadthumb").show();
                $("#acaraform #btncancelthumb").show();
                $("#acaraform #btnreplacethumb").hide();
                $("#acaraform #thumb_img").hide();
            });
        </script>
        <!-- END REPLACE THUMBNAIL -->
        
        <!-- START CANCEL REPLACE THUMBNAIL -->
        <script>
            $("#acaraform #btncancelthumb").click(function()
            {
                $("#acaraform #uploadthumb").hide();
                $("#acaraform #btnuploadthumb").hide();
                $("#acaraform #btncancelthumb").hide();
                $("#acaraform #btnreplacethumb").show();
                $("#acaraform #thumb_img").show();
            });
        </script>
        <!-- END CANCEL REPLACE THUMBNAIL -->

        <!-- START DROPZONE UPLOAD BANNER -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone2 = new Dropzone('#acaraform div#uploadbanner', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'acara_banner',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-newsevent.php',
                init: function () {

                    var myDropzone2 = this;
                    // Update selector to match your button
                    $("#acaraform #btnuploadbanner").click(function (e) {
                        e.preventDefault();
                        myDropzone2.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#acaraform").serializeArray();
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
                        $("#acaraform #uploadbanner").hide();
                        $("#acaraform #btnuploadbanner").hide();
                        $("#acaraform #banner_img").attr('src', response.banner_img).show();
                        $("#acaraform #btnreplacebanner").show();
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
            $("#acaraform #btnreplacebanner").click(function()
            {
                $("#acaraform #uploadbanner").show();
                $("#acaraform #btnuploadbanner").show();
                $("#acaraform #btncancelbanner").show();
                $("#acaraform #btnreplacebanner").hide();
                $("#acaraform #banner_img").hide();
            });
        </script>
        <!-- END REPLACE BANNER -->
        
        <!-- START CANCEL REPLACE BANNER -->
        <script>
            $("#acaraform #btncancelbanner").click(function()
            {
                $("#acaraform #uploadbanner").hide();
                $("#acaraform #btnuploadbanner").hide();
                $("#acaraform #btncancelbanner").hide();
                $("#acaraform #btnreplacebanner").show();
                $("#acaraform #banner_img").show();
            });
        </script>
        <!-- END CANCEL REPLACE BANNER -->
         
        <!-- START SAVE TO DRAFT FORM -->
        <script>
            $("#acaraform #btnsavedraft").click(function()
            {
                var id_data         = $("#acaraform input[name=acaraid]").val();
                var thumb_data      = document.getElementById("thumb_img").src;
                var banner_data     = document.getElementById("banner_img").src;
                var publish_data    = $("#acaraform #dp1").val();
                var title_data      = $("#acaraform input[name=title]").val();
                var highlight_data  = $("#acaraform input[name=highlight]").val();
                var desc_data       = CKEDITOR.instances['editordesc'].getData();
                $.post('ajax-newsevent.php',
                {
                    id:id_data,
                    thumb_img:thumb_data,
                    banner_img:banner_data,
                    publish:publish_data,
                    title:title_data,
                    highlight:highlight_data,
                    description:desc_data,
                    draf_acara:true
                },
                function(data,status)
                {
                    if(data.error_status==1)
                    {
                        notifmodal(data.error_message,'failed');
                    }
                    else
                    {
                        notifmodal(data.error_message,'success');
                        setTimeout(function(){ window.location ='index.php?p=newsevent_acara';},3000);
                    }
                    console.log(data,status);
                }
                );
            });
        </script>
        <!-- END SAVE TO DRAFT FORM -->

        <!-- START CANCEL FORM -->
        <script>
            $("#acaraform #btncancel").click(function()
            {
                $("#notifcancelmodal").modal("show");
            });

            $("#notifcancelmodal #btnmodalcancel").click(function()
            {
                $("#notifcancelmodal").modal("hide");
            });

            $("#notifcancelmodal #btnmodaldiscard").click(function()
            {
                setTimeout(function(){ window.location ='index.php?p=newsevent_acara'; });
            });

            $("#notifcancelmodal #btnmodalsave").click(function()
            {
                var id_data         = $("#acaraform input[name=acaraid]").val();
                var thumb_data      = document.getElementById("thumb_img").src;
                var banner_data     = document.getElementById("banner_img").src;
                var publish_data    = $("#acaraform #dp1").val();
                var title_data      = $("#acaraform input[name=title]").val();
                var highlight_data  = $("#acaraform input[name=highlight]").val();
                var desc_data       = CKEDITOR.instances['editordesc'].getData();
                //alert(id_data);
                $.post('ajax-newsevent.php',
                {
                    id:id_data,
                    thumb_img:thumb_data,
                    banner_img:banner_data,
                    publish:publish_data,
                    title:title_data,
                    highlight:highlight_data,
                    description:desc_data,
                    draf_acara:true
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
                        setTimeout(function(){ window.location ='index.php?p=newsevent_acara';},3000);
                    }
                    console.log(data,status);
                }
                );
            });
        </script>
        <!-- END CANCEL FORM -->

        <!-- START SAVE TO PUBLISH FORM -->
        <script>
            $("#notifpublishmodal #btnmodalclose").click(function()
            {
                $("#notifpublishmodal").modal("hide");
            });

            $("#acaraform #btnsavepublish").click(function()
            {
                var id_data         = $("#acaraform input[name=acaraid]").val();
                var thumb_data      = document.getElementById("thumb_img").src;
                var banner_data     = document.getElementById("banner_img").src;
                var publish_data    = $("#acaraform #dp1").val();
                var title_data      = $("#acaraform input[name=title]").val();
                var highlight_data  = $("#acaraform input[name=highlight]").val();
                var desc_data       = CKEDITOR.instances['editordesc'].getData();
                if(thumb_data=="" || banner_data=="" || publish_data=="" || title_data=="" || highlight_data=="" || desc_data=="")
                {
                    $("#notifpublishmodal").modal("show");
                }
                else
                {
                    $.post('ajax-newsevent.php',
                    {
                        id:id_data,
                        thumb_img:thumb_data,
                        banner_img:banner_data,
                        publish:publish_data,
                        title:title_data,
                        highlight:highlight_data,
                        description:desc_data,
                        publish_acara:true
                    },
                    function(data,status)
                    {
                        if(data.error_status==1)
                        {
                            notifmodal(data.error_message,'failed');
                        }
                        else
                        {
                            notifmodal(data.error_message,'success');
                            setTimeout(function(){ window.location ='index.php?p=newsevent_acara';},3000);
                        }
                        console.log(data,status);
                    }
                    );
                }    
            });
        </script>
        <!-- END SAVE TO DRAFT FORM -->

        <!-- START DROPZONE UPLOAD GALLERY -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone3 = new Dropzone('#acaraform div#uploadgallery', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'acara_gallery',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-newsevent.php',
                init: function () {

                    var myDropzone3 = this;
                    // Update selector to match your button
                    $("#acaraform #btnuploadgallery").click(function (e) {
                        e.preventDefault();
                        myDropzone3.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#acaraform").serializeArray();
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
                        setTimeout(function(){ window.location ='index.php?p=newsevent_acaraform&id=<?php echo $id ?>';},3000);
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