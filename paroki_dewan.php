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
                        <div class="card" style="">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">
                                <img src="" id="imgbanner" style="display: none;width:100%">
                                <button id="btndeletebanner" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin-top: 15px;" onclick="return confirm('Are you sure you want to delete this item ?')">DELETE</button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>  
        </div>
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
                thumbnailWidth:1456,
                thumbnailHeight:560,
                acceptedFiles: "image/jpeg,image/png,image/jpg",
                url: 'ajax/paroki_assets.php',
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
                    return _results;
                    if(response.error_status==1)
                    {
                        notifmodal(response.error_message,'failed');
                    }
                    console.log(data,status);
                },
                successmultiple: function (file, response) {
                    console.log(file, response);
                    notifsuccessmodal('Perubahan anda telah berhasil disimpan');
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
        <!-- END DROPZONE & NOTIF UPLOAD BANNER PAROKI -->   
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