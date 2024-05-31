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