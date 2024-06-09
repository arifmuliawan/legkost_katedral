<?php
$query_misa_khusus   = mysqli_query($con,"SELECT * FROM misa_khusus WHERE id='1'")or die (mysqli_error($con));
$sum_misa_khusus     = mysqli_num_rows($query_misa_khusus);
if($sum_misa_khusus>0)
{
    $data_misa_khusus   = mysqli_fetch_array($query_misa_khusus);
    $misa_khusus_id     = $data_misa_khusus['id'];
    $misa_khusus_title  = $data_misa_khusus['title'];
    $misa_khusus_desc   = $data_misa_khusus['description'];
    $misa_kregis_img    = $data_misa_khusus['regis_img'];
    $misa_kregis_url    = $data_misa_khusus['regis_url'];
    $misa_kschedule_img = $data_misa_khusus['schedule_img'];
    $data_publish_start = $data_misa_khusus['publish_start'];
    if($data_publish_start=="")
    {
        $publish_start      = "";
    }
    else
    {
        $exp_publish_start  = explode("-",$data_publish_start);
        $ds                 = $exp_publish_start[2];
        $ms                 = $exp_publish_start[1];
        $ys                 = $exp_publish_start[0];
        $publish_start      = $ds.'/'.$ms.'/'.$ys;
    }  
    $data_publish_end   = $data_misa_khusus['publish_end'];
    if($data_publish_end=="")
    {
        $publish_end        = "";
    }
    else
    {  
        $exp_publish_end    = explode("-",$data_publish_end);
        $de                 = $exp_publish_end[2];
        $me                 = $exp_publish_end[1];
        $ye                 = $exp_publish_end[0];
        $publish_end        = $de.'/'.$me.'/'.$ye;
    }    
}
else
{
    $misa_khusus_id     = "";
    $publish_start      = "";
    $publish_end        = "";
}

?>        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="margin: 24px">ACARA MISA KHUSUS</h1>
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
                    <!-- HANDLE MISA SCHEDULE --->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">
                                <form method="POST" id="formpublish">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                        Pop up acara misa khusus dan tombol yang mengarahkan pada pop up tersebut dapat secara otomatis ditampilkan dan dihilangkan dari website, yaitu dengan cara mengisi isian tanggal dibawah ini.
                                        </p>   
                                        <p>
                                        Mohon diperhatikan bahwa untuk kemudahan pengisian data berikutnya, seluruh data yang telah diisi pada halaman ini akan dihapus secara otomatis dalam jangka waktu 3 hari setelah tanggal berakhir. Apabila ada keperluan rekap atau keperluan lainnya, mohon untuk melakukannya dalam jangka waktu tersebut.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="misakhususid" value="<?php echo $misa_khusus_id ?>">
                                        <div class="form-group">
                                            <label class="form-label">TANGGAL MULAI TAMPIL <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='publist_start' placeholder="dd/mm/yyyy" value="<?php echo $publish_start ?>" id="dp1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">TANGGAL BERAKHIR <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='publist_end' placeholder="dd/mm/yyyy" value="<?php echo $publish_end ?>" id="dp2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align:right">
                                        <button id="btnsubmitpublish" type="button" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button></a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /HANDLE MISA SCHEDULE --->
                </div>
            </section> 
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <!-- left column -->
                    <!-- HANDLE MISA SCHEDULE --->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">
                                <form method="POST" id="formdetail">
                                <input type="hidden" name="misakhususid" value="<?php echo $misa_khusus_id ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">JUDUL MISA KHUSUS (TOMBOL) <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='title' placeholder="Type something here...." value="<?php echo $misa_khusus_title ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>QR LINK REGISTRASI <font color='red'>*</font></label> <br>
                                            (195 x 195 px) JPG/JPEG/PNG
                                        </div>
                                        <?php
                                        if($misa_kregis_img!="")
                                        {
                                        ?>    
                                            <img src="<?php echo 'assets/'.$misa_kregis_img; ?>" id="kregis_img" style="width: 30%;"><br>
                                            <input type="hidden" name="deletekregisimg" value="<?php echo 'assets/'.$misa_kregis_img; ?>">
                                            <button id="btnreplacekregisimg" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;" onclick="return confirm('Are you sure you want to replace this image ?')">REPLACE</button>    
                                            <div id="uploadkregisimg" class="dropzone" style="display: none;">
                                                <div class="dz-message">
                                                    <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                    <b>.JPG  .JPEG  .PNG</b><br>
                                                    Drop files to upload <br>
                                                    or <font color='#88A8D4'><b>Browse Files...</b></font>
                                                </div>
                                            </div>
                                            <button id="btnsavekregisimg" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display: none;">SAVE</button>
                                            &nbsp&nbsp&nbsp
                                            <button id="btncreplacekregisimg" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin: 15px 0px;display: none;" onclick="return confirm('Are you sure you want to cancel this process ?')">CANCEL</button>
                                            <br>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <img src="" id="kregis_img" style="width: 30%;" style="display: none;"><br>
                                            <button id="btnreplacekregisimg" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin: 15px 0px;display: none" onclick="return confirm('Are you sure you want to replace this item ?')">REPLACE</button>
                                            <div id="uploadkregisimg" class="dropzone">
                                                <div class="dz-message">
                                                    <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                    <b>.JPG  .JPEG  .PNG</b><br>
                                                    Drop files to upload <br>
                                                    or <font color='#88A8D4'><b>Browse Files...</b></font>
                                                </div>
                                            </div>
                                            <br>
                                            <button id="btnsavekregisimg" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                            <br>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">LINK REGISTRASI <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='regis_url' placeholder="Type something here...." value="<?php echo $misa_kregis_url ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">DESKRIPSI REGISTRASI <font color="red">*</font></label>
                                            <textarea class="ckeditor" id="editordesc" name="editordesc" placeholder="Type something here...." style="margin-top: 0px; margin-bottom: 0px; height: 400px;" > <?php echo $misa_khusus_desc ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>JADWAL MISA KHUSUS <font color='red'>*</font></label> <br>
                                            (880 x 1250 px) JPG/JPEG/PNG
                                        </div>
                                        <?php
                                        if($misa_kschedule_img!="")
                                        {
                                        ?>    
                                            <img src="<?php echo 'assets/'.$misa_kschedule_img; ?>" id="kschedule_img" style="width: 30%;"><br>
                                            <input type="hidden" name="deletescheduleimg" value="<?php echo 'assets/'.$misa_kschedule_img; ?>">
                                            <button id="btnreplacescheduleimg" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin-top: 15px;" onclick="return confirm('Are you sure you want to delete this item ?')">DELETE</button>    
                                            <br>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <img src="" id="kschedule_img" style="width: 30%;" style="display: none;"><br>
                                            <button id="btndeletekscheduleimg" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin-top: 15px;display: none" onclick="return confirm('Are you sure you want to delete this item ?')">DELETE</button>
                                            <div id="uploadkscheduleimg" class="dropzone">
                                                <input type="hidden" name="misakhususid" value="<?php echo $misa_khusus_id ?>">
                                                <div class="dz-message">
                                                    <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                                    <b>.JPG  .JPEG  .PNG</b><br>
                                                    Drop files to upload <br>
                                                    or <font color='#88A8D4'><b>Browse Files...</b></font>
                                                </div>
                                            </div>
                                            <br>
                                            <button id="btnsavekscheduleimg" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                            <br>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                    <div class="col-md-12" style="text-align:right">
                                        <button id="btnsubmitdetail" type="button" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button></a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>

                        
                    </div>
                    <!-- /HANDLE MISA SCHEDULE --->
                </div>
            </section> 
        </div>   
        
        <!-- START FORM PUBLISH SCHEDULE -->
        <script>
            $("#formpublish #btnsubmitpublish").click(function()
            {
                $.post('ajax-misasakrame.php',
                {
                    misakhususid:$("#formpublish input[name=misakhususid]").val(),
                    publish_start:$("#formpublish #dp1").val(),
                    publish_end:$("#formpublish #dp2").val(),
                    publish_misakhusus:true
                },
                function(data,status)
                {
                    if(data.error_status=='1')
                    {
                        notifmodal(data.error_message,'failed');
                    }
                    else
                    {
                        notifmodal(data.error_message,'success');
                    }
                    console.log(data,status);
                }
                );
            }); 
        </script>
        <!-- END FORM PUBLISH SCHEDULE -->

        <!-- START FORM DETAIL MISA KHUSUS -->
        <script>
            $("#formdetail #btnsubmitdetail").click(function()
            {
                var title_data      = $("#formdetail input[name=title]").val();
                var desc_data       = CKEDITOR.instances['editordesc'].getData();
                var regisurl_data   = $("#formdetail input[name=regis_url]").val();
                var regisimg_data   = document.getElementById("kregis_img").src;
                var scheduleimg_data= document.getElementById("kschedule_img").src; 
                if(title_data=="" || desc_data=="" || regisurl_data=="" || regisimg_data=="" || scheduleimg_data=="")
                {
                    alert("Mohon data dilengkapin");
                }
                else
                {
                    alert("Data lengkap");
                }
                /*
                $.post('ajax-misasakrame.php',
                {
                    misakhususid:$("#formdetail input[name=misakhususid]").val(),
                    misakhusustitle:$("#formdetail input[name=title]").val(),
                    misakhususdesc:CKEDITOR.instances['editordesc'].getData(),
                    misakregisurl:$("#formdetail input[name=regis_url]").val(),
                    detail_misakhusus:true
                },
                function(data,status)
                {
                    if(data.error_status=='1')
                    {
                        notifmodal(data.error_message,'failed');
                    }
                    else
                    {
                        notifmodal(data.error_message,'success');
                        //setTimeout(function(){ window.location ='index.php?p=misasakramen_misakhusus'; }, delay);
                    }
                    console.log(data,status);
                }
                );
                */
            }); 
        </script>
        <!-- END FORM DETAIL MISA KHUSUS -->

        <!-- START DROPZONE UPLOAD REGISTER -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone = new Dropzone('#formdetail div#uploadkregisimg', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'upload_kregisimg',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-misasakrame.php',
                init: function () {

                    var myDropzone = this;
                    // Update selector to match your button
                    $("#formdetail #btnsavekregisimg").click(function (e) {
                        e.preventDefault();
                        myDropzone.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#formdetail").serializeArray();
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
                        $("#formdetail #uploadkregisimg").hide();
                        $("#formdetail #btnsavekregisimg").hide();
                        $("#formdetail #kregis_img").attr('src', response.kregis_img).show();
                        $("#formdetail #btndeletekregisimg").show();
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

        <!-- START REPLACE IMAGE REGISTER -->
        <script>
            $("#formdetail #btnreplacekregisimg").click(function()
            {
                $("#formdetail #uploadkregisimg").show();
                $("#formdetail #btnsavekregisimg").show();
                $("#formdetail #btncreplacekregisimg").show();
                $("#formdetail #kregis_img").hide();
                $("#formdetail #btnreplacekregisimg").hide();
            });
            
            $("#formdetail #btncreplacekregisimg").click(function()
            {
                $("#formdetail #uploadkregisimg").hide();
                $("#formdetail #btnsavekregisimg").hide();
                $("#formdetail #btncreplacekregisimg").hide();
                $("#formdetail #kregis_img").show();
                $("#formdetail #btnreplacekregisimg").show();
            });
        </script>
        <!-- END REPLACE IMAGE REGISTER -->

        <!-- START DROPZONE UPLOAD SCHEDULE -->
        <script type="text/javascript">  
            Dropzone.autoDiscover = false;
            myDropzone2 = new Dropzone('#formdetail div#uploadkscheduleimg', 
            {
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 1,
                paramName: 'upload_kscheduleimg',
                clickable: true,
                thumbnailWidth:150,
                thumbnailHeight:150,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax-misasakrame.php',
                init: function () {

                    var myDropzone2 = this;
                    // Update selector to match your button
                    $("#formdetail #btnsavekscheduleimg").click(function (e) {
                        e.preventDefault();
                        myDropzone2.processQueue();
                        return false;
                    });

                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $("#formdetail div#uploadkscheduleimg").serializeArray();
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
                        $("#formdetail #uploadkscheduleimg").hide();
                        $("#formdetail #btnsavekscheduleimg").hide();
                        $("#formdetail #kschedule_img").attr('src', response.kregis_img).show();
                        $("#formdetail #btndeletekscheduleimg").show();
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