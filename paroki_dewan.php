        
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
                                <form id="imageUploadForm">
                                    <div class="form-group">
                                        <label>FOTO BANNER *</label>
                                        (1820 x 595 px) JPG/JPEG/PNG
                                    </div>
                                    <div id="imageUpload" class="dropzone"></div>
                                    <br>
                                    <button id="uploaderBtn" type="button" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        <!--</form>-->                    
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">PERIODE JABATAN *</label>
                                                <input type="text" name="periode_paroki" class="form-control" placeholder="Type something here....">
                                            </div>
                                        </div>
                                    </div>               
                                </div>
                                <div class="card-footer" style="background-color: unset;">
                                <div class="row">
                                    <div class="col-md-11">
                                        <table border=0 width="100%">
                                            <tr>
                                                <td style="text-align: right;">
                                                    <button type="submit" class="btn" name="submit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">Submit</button>
                                                </td> 
                                            </tr>
                                        </table>
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