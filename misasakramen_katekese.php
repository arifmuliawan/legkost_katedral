        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">KATEKESE</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section> 

            <!-- Main content -->
            <section class="content" id="katekeselist">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12" style="text-align:right">
                            <button type="button" id="btnaddkatekese" class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                Add New
                            </button>
                        </div>
                        <!-- left column -->
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <table width="100%">
                                <tr>
                                    <td width="20%">
                                        <img src="https://placehold.co/250" width="80%">
                                    </td> 
                                    <td width="65%">
                                        27 Agustus 2024 <br>
                                        <h5> katekese sakramen penguatan </h5>
                                    </td>
                                    <td width="15%">
                                        <button type="button" class="btnedit" title="Edit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" data-toggle="modal" data-target="#modaldetailperkawinan" data-perkawinan='<?php echo json_encode($perkawinan_json) ?>'>
                                            <i class="fa fa-edit" style="color: #fff;"></i>
                                        </button>
                                        &nbsp&nbsp&nbsp
                                        <button type="button" class="btndelete" title="Delete" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                            <i class="fa fa-trash" style="color: #fff;"></i>
                                        </button>
                                    </td> 
                                </tr>
                            </table>           
                        </div>
                    </div>    
                </div> 
            </section> 
            <!-- Main content -->
            <section class="content" id="katekeseform" style="display:;margin-right: 50px;">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">THUMBNAIL <font color="red">*</font></label><br>
                                <font size="3">(250 x 250 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <div id="uploadthumb" class="dropzone">
                                    <div class="dz-message">
                                        <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                        <b>.JPG  .JPEG  .PNG</b><br>
                                        Drop files to upload <br>
                                        or <font color='#88A8D4'><b>Browse Files...</b></font>
                                    </div>
                                </div>
                                <button id="btnuploadthumb" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">BANNER<font color="red">*</font></label><br>
                                <font size="3">(900 x 450 px) JPG/JPEG/PNG</font>
                                <br><br>
                                <div id="uploadbanner" class="dropzone">
                                    <div class="dz-message">
                                        <img src="<?php echo $base_assets ?>dist/img/icon_upload.png"><br><br>
                                        <b>.JPG  .JPEG  .PNG</b><br>
                                        Drop files to upload <br>
                                        or <font color='#88A8D4'><b>Browse Files...</b></font>
                                    </div>
                                </div>
                                <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">UPLOAD</button>
                            </div>     
                        </div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">TANGGAL KATEKESE<font color="red">*</font></label>
                                <input type="text" class="form-control" name='publist_start' placeholder="dd/mm/yyyy" id="dp1">
                            </div>     
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;"></div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">JUDUL KATEKESE<font color="red">*</font></label>
                                <input type="text" class="form-control" name='title' placeholder="Type something here....">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">DESKRIPSI SINGKAT<font color="red">*</font></label>
                                <input type="text" class="form-control" name='highlight' placeholder="Type something here....">
                            </div>     
                        </div>
                        <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                            <div class="form-group">
                                <label class="form-label">ISI KATEKESE<font color="red">*</font></label>
                                <textarea class="ckeditor" id="editordesc" name="editordesc" placeholder="Type something here...." style="margin-top: 0px; margin-bottom: 0px; height: 400px;" > </textarea>
                            </div>     
                        </div>
                        <div class="col-md-4" style="flex: unset;margin-left: 50px;text-align:left">
                            <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">CANCEL</button>
                        </div>
                        <div class="col-md-8" style="flex: unset;margin-left: 50px;text-align:right">
                            <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">SAVE TO DRAFT</button>
                            &nbsp&nbsp&nbsp
                            <button id="btnuploadbanner" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">SAVE TO PUBLISH</button>
                        </div>
                    </div>    
                </div> 
            </section>           
        </div>