<?php
if(!empty($_FILES)){
    print_r($_FILES);
    exit();
}    
?>          
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
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="file_upload">
                                            <label>FOTO BANNER *</label>
                                            <br>
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-header with-border">
                                                        <div><b>Preview</b></div>
                                                        <div class="box-tools pull-right">
                                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                                <i class="fa fa-times"></i> Reset This Form
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body"></div>
                                                </div>
                                            </div>
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                        <i class="glyphicon glyphicon-download-alt"></i>
                                                        <p>Choose an image file or drag it here.</p>
                                                </div>
                                                <input type="file" name="img_logo" class="dropzone">
                                            </div>
                                            <!--
                                            <div style="margin-bottom: 25px;margin-top: -10px;font-size: 13px;">(1820 x 595 px) JPG/JPEG/PNG</div>
                                            <div class="dropzone dz-clickable border rounded bg-light p-3">
                                                <div class="dz-default dz-message text-center">
                                                    <i class="fas fa-upload" style="font-size: 2rem;"></i>
                                                    <div class="mt-3" style="font-weight: bold;">.JPG   .JPEG   .PNG </div>
                                                    <div class="mt-1">Drop files to upload </div>
                                                    <div class="mt-1" style="color: #88A8D4;font-weight: bold;">or Browse Files...</div>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn" name="submit_banner" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                        &nbsp&nbsp
                                        <a href='index.php?p=paroki_dewan'><button type="button" class="btn" style="background-color:#ff0000;color: #ffffff;font-weight: bold;border-color: #88A8D4;"> DELETE </button></a>
                                    </div>
                                </div>
                            </div>
                        <!--</form>-->                    
                        </div>
                        <!-- /.card -->
                        </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>    