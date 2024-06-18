        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">WARTA GEREJA</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            if($id!=0)
            {
                $query_warta = mysqli_query($con,"SELECT * FROM warta WHERE id='$id'")or die (mysqli_error($con));
                $sum_warta   = mysqli_num_rows($query_warta);
                if($sum_warta==0)
                {
                    echo "Data Tidak Ditemukan";
                    exit();
                }
                else
                {
                    $data_warta     = mysqli_fetch_array($query_warta);
                    $doc_data       = $data_warta['doc'];
                    $publish_data   = $data_warta['publish_date'];
                    $exp_publish    = explode("-",$publish_data);
                    $ds             = $exp_publish[2];
                    $ms             = $exp_publish[1];
                    $ys             = $exp_publish[0];
                    $publish_date   = $ds.'/'.$ms.'/'.$ys;
                    $title          = $data_warta['title'];
                    $status         = $data_warta['visible'];
                }
            }
            else
            {
                $doc_data       = "";
                $publish_date   = "";
                $title          = "";
                $status         = "";
            }
            ?> 
            <!-- Main content -->
            <!--<form methode="POST">-->  
            <section class="content" id="wartaform" style="margin-right: 50px;">
                <input type="hidden" name="wartaid" value="<?php echo $id ?>">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-5" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">TANGGAL WARTA<font color="red">*</font></label>
                                <input type="text" class="form-control" name='publist' placeholder="dd/mm/yyyy" id="dp1" value="<?php echo $publish_date ?>">
                            </div>     
                        </div>
                        <div class="col-md-5" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">JUDUL WARTA<font color="red">*</font></label>
                                <input type="text" class="form-control" name='title' placeholder="Type something here...." value="<?php echo $title ?>">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">ISI WARTA <font color="red">*</font></label><br>
                                <font size="3">(max 100mB) PDF</font>
                                <br><br>
                                <?php
                                if($doc_data!="" && $doc_data!=" ")
                                {
                                ?>    
                                    <?php echo $doc_data ?>
                                    <button id="btnreplacedoc" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                    <div id="uploaddoc" class="dropzone" style="display:none">
                                        <div class="dz-message">
                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                            <b>.PDF</b><br>
                                            Drop files to upload <br>
                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                        </div>
                                    </div>
                                    <button id="btnuploaddoc" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display:none">UPLOAD</button>
                                    <button id="btncanceldoc" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;display:none" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
                                <?php
                                }
                                else
                                {
                                ?>    
                                    <iframe id="doc_data" src="" style="width:500px; height:500px;display:none" frameborder="0"></iframe><br>
                                    <button id="btnreplacedoc" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display:none" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                    <div id="uploaddoc" class="dropzone">
                                        <div class="dz-message">
                                            <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                            <b>.PDF</b><br>
                                            Drop files to upload <br>
                                            or <font color='#88A8D4'><b>Browse Files...</b></font>
                                        </div>
                                    </div>
                                    <button id="btnuploaddoc" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                                    <button id="btncanceldoc" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;display:none" onclick="return confirm('Are you sure you want to cancel upload ?')">CANCEL</button>
                                <?php
                                }
                                ?>    
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
        <!-- START DROPZONE UPLOAD PDF WARTA -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone('#wartaform div#uploaddoc', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'warta_doc',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "application/pdf",
                url: 'ajax-newsevent.php?id=<?php echo $id ?>',
                init: function () {

                    var myDropzone = this;
                    // Update selector to match your button
                    $("#wartaform #btnuploaddoc").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#wartaform").serializeArray();
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
                        $("#wartaform #uploaddoc").hide();
                        $("#wartaform #btnuploaddoc").hide();
                        $("#wartaform #doc_data").attr('src', response.doc_data).show();
                        $("#wartaform #btnreplacedoc").show();
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
        <!-- END DROPZONE UPLOAD PDF WARTA -->

        <!-- START REPLACE PDF WARTA -->
        <script>
            $("#wartaform #btnreplacedoc").click(function()
            {
                $("#wartaform #uploaddoc").show();
                $("#wartaform #btnuploaddoc").show();
                $("#wartaform #btncanceldoc").show();
                $("#wartaform #btnreplacedoc").hide();
                $("#wartaform #thumb_img").hide();
            });
        </script>
        <!-- END REPLACE PDF WARTA -->
        
        <!-- START CANCEL REPLACE PDF WARTA -->
        <script>
            $("#wartaform #btncanceldoc").click(function()
            {
                $("#wartaform #uploaddoc").hide();
                $("#wartaform #btnuploaddoc").hide();
                $("#wartaform #btncanceldoc").hide();
                $("#wartaform #btnreplacedoc").show();
                $("#wartaform #thumb_img").show();
            });
        </script>
        <!-- END CANCEL REPLACE PDF WARTA -->
         
        <!-- START SAVE TO DRAFT FORM -->
        <script>
            $("#wartaform #btnsavedraft").click(function()
            {
                var id_data         = $("#wartaform input[name=wartaid]").val();
                var doc_data        = " ";
                var publish_data    = $("#wartaform #dp1").val();
                var title_data      = $("#wartaform input[name=title]").val();
                $.post('ajax-newsevent.php',
                {
                    id:id_data,
                    doc_data:doc_data,
                    publish:publish_data,
                    title:title_data,
                    draf_warta:true
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
                        setTimeout(function(){ window.location ='index.php?p=newsevent_warta';},3000);
                    }
                    console.log(data,status);
                }
                );
            });
        </script>
        <!-- END SAVE TO DRAFT FORM -->

        <!-- START CANCEL FORM -->
        <script>
            $("#wartaform #btncancel").click(function()
            {
                $("#notifcancelmodal").modal("show");
            });

            $("#notifcancelmodal #btnmodalcancel").click(function()
            {
                $("#notifcancelmodal").modal("hide");
            });

            $("#notifcancelmodal #btnmodaldiscard").click(function()
            {
                setTimeout(function(){ window.location ='index.php?p=newsevent_warta'; });
            });

            $("#notifcancelmodal #btnmodalsave").click(function()
            {
                var id_data         = $("#wartaform input[name=wartaid]").val();
                var doc_data        = document.getElementById("doc_data").src;
                var publish_data    = $("#wartaform #dp1").val();
                var title_data      = $("#wartaform input[name=title]").val();
                //alert(id_data);
                $.post('ajax-newsevent.php',
                {
                    id:id_data,
                    doc_data:doc_data,
                    publish:publish_data,
                    title:title_data,
                    draf_warta:true
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
                        setTimeout(function(){ window.location ='index.php?p=newsevent_warta';},3000);
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

            $("#wartaform #btnsavepublish").click(function()
            {
                var id_data         = $("#wartaform input[name=wartaid]").val();
                var doc_data        = " ";
                var publish_data    = $("#wartaform #dp1").val();
                var title_data      = $("#wartaform input[name=title]").val();
                if(doc_data=="" || doc_data==" " || publish_data=="" || title_data=="")
                {
                    $("#notifpublishmodal").modal("show");
                }
                else
                {
                    $.post('ajax-newsevent.php',
                    {
                        id:id_data,
                        doc_data:doc_data,
                        publish:publish_data,
                        title:title_data,
                        publish_warta:true
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
                            setTimeout(function(){ window.location ='index.php?p=newsevent_warta';},3000);
                        }
                        console.log(data,status);
                    }
                    );
                }    
            });
        </script>
        <!-- END SAVE TO DRAFT FORM -->