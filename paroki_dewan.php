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
                                        <input type="hidden" name="deletebanner" value="<?php echo 'assets/'.$banner_paroki_assets; ?>">
                                        <button id="btndeletebanner" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin-top: 15px;" onclick="return confirm('Are you sure you want to delete this item ?')">DELETE</button>
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
                                            $photo_paroki   = $base_assets."".$photo_data;
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
                                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column" id="<?php echo $sortid_staff ?>" data-id="<?php echo $id_staff ?>" data-sec="<?php echo $sortid_staff ?>">
                                            <div class="card bg-light d-flex flex-fill">
                                                <div class="card-body pt-3">
                                                    <img class="dataparoki" src=<?php echo $photo_paroki ?> width="100%" data-toggle="modal" data-target="#detailparokimodal" data-staff='<?php echo json_encode($paroki_json) ?>'>
                                                </div>
                                                <div class="card-footer">
                                                
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
            </section>  
        </div>
        <!-- START DELETE BANNER PAROKI -->
        <script>
            $("#btndeletebanner").click(function()
            {
                $.post('ajax-paroki-assets.php',
                {
                    delete_banner:$("#formbanner input[name=deletebanner]").val()
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
        <!-- END DELETE BANNER PAROKI -->
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
        <!-- START CHANGE SORT DEWAN PAROKI -->
        <script type="text/javascript">
            var parokipos   = document.querySelector('.paroki_position');
            var sortable    = Sortable.create(parokipos,{
            onUpdate: function (/**Event*/evt) {
                arr = [];index=0
                $('.col-md-2').each(function(item){
                arr.push({id:$(this).attr('data-id'),sort:index++})
                })
                    updateOrderParoki(arr);
                },

            });
            
            function updateOrderParoki(data) {
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