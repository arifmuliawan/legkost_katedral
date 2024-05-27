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
                        <form action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="file_upload">
                                            <label>FOTO BANNER *</label>
                                            <br>
                                            <div class="dropzone" id="image-upload">
                                                <div>  
                                                    <h3>Upload Multiple Image By Click On Box</h3>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="Type something here....">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button id="uploadFile">Upload Files</button>  
                                        <!--
                                        <button type="submit" class="btn" name="submit_banner" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SAVE</button>
                                        &nbsp&nbsp
                                        <a href='index.php?p=paroki_dewan'><button type="button" class="btn" style="background-color:#ff0000;color: #ffffff;font-weight: bold;border-color: #88A8D4;"> DELETE </button></a>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </form>                    
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