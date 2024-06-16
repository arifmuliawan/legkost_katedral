        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">KATEKESE</h1>
                        </div>
                        <div class="col-sm-12" style="text-align:right">
                            <button id="btnaddlist" type="button" class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                Add New
                            </button>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section> 

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
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
        </div>