        
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
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>FOTO BANNER *</label>
                                            <fieldset class="upload_dropZone text-center mb-3 p-4">

                                                <legend class="visually-hidden">Image uploader</legend>

                                                <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                                                <use href="#icon-imageUpload"></use>
                                                </svg>

                                                <p class="small my-2">Drag &amp; Drop background image(s) inside dashed region<br><i>or</i></p>

                                                <input id="upload_image_background" data-post-name="image_background" data-post-url="https://someplace.com/image/uploads/backgrounds/" class="position-absolute invisible" type="file" multiple accept="image/jpeg, image/png, image/svg+xml" />

                                                <label class="btn btn-upload mb-3" for="upload_image_background">Choose file(s)</label>

                                                <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>

                                            </fieldset>
                                        </div>
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