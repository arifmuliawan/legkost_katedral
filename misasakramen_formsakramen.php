        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="margin: 24px">FORM SAKRAMEN</h1>
                            <p style="margin: 24px;color: red;font-size: 14px;">KOLOM DENGAN TANDA * WAJIB DIISI</p>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            $query_category = mysqli_query($con,"SELECT * FROM sakramen_category WHERE visible='Y' order by sortid")or die (mysqli_error($con));
            $sum_category   = mysqli_num_rows($query_category);
            if($sum_category>0)
            {
                while($data_category=mysqli_fetch_array($query_category))
                {
                    $category_id    = $data_category['id'];
                    $category_title = $data_category['title'];
            ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                            <!-- left column -->
                                <!-- HANDLE MISA SCHEDULE --->
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 style="margin: 0px 24px;color: #88A8D4;"><?php echo $category_title ?></h5>
                                            <button id="btnaddlist" type="button" class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;">Add New</button>
                                            <div class="card-body" style="margin: 0px 24px;background: #D9D9D9;display: none;"  id="formsakramen">
                                                <form method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">JUDUL FORMULIR <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='title' placeholder="Type something here....">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">LINK FORMULIR <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='link' placeholder="Type something here....">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button id="btnsaveformsakramen" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;display: none;">SAVE</button>
                                                        &nbsp&nbsp&nbsp
                                                        <button id="btncancelformsakramen" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin: 15px 0px;display: none;" onclick="return confirm('Are you sure you want to cancel this process ?')">CANCEL</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table style="width:100%">
                                                        <?php
                                                        $query_list = mysqli_query($con,"SELECT * FROM `sakramen_list` WHERE categoryid='$category_id' AND visible='Y' order by sortid ASC")or die (mysqli_error($con));
                                                        $sum_list   = mysqli_num_rows($query_list);
                                                        if($sum_list>0)
                                                        {
                                                            $i=1;
                                                            while($data_list=mysqli_fetch_array($query_list))
                                                            {
                                                                if ($i % 2 == 0)
                                                                {
                                                                    $clr_row = "background-color: #D9D9D9";
                                                                }
                                                                else
                                                                {
                                                                    $clr_row = "background-color: #ffffff;";
                                                                }
                                                        ?>    
                                                                <tr>
                                                                    <td style="width: 80%;<?php echo $clr_row ?>"> &nbsp&nbsp&nbsp&nbsp Formulir Pendaftaran Perkawinan </td>
                                                                    <td style="width: 20%;"> 
                                                                        &nbsp&nbsp&nbsp&nbsp
                                                                        <button type="button" class="btn" title="Edit" style="background-color:#88A8D4;"><i class="fa fa-edit" style="color: #fff;"></i></button>
                                                                        &nbsp&nbsp&nbsp
                                                                        <button type="button" class="btn" title="Delete" style="background-color:#E90000;"><i class="fa fa-trash" style="color: #fff;"></i></button>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                $i++;
                                                            }
                                                        }
                                                        ?>            
                                                    </table>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>        
                                </div>
                            </div>
                            <!-- /HANDLE MISA SCHEDULE --->
                        </div>
                    </section> 
            <?php
                }
            }
            ?>            
        </div> 
        <!-- START ADD FORM SAKRAMEN -->
        <script>
            $("#btnaddlist").click(function()
            {
                $("#formsakramen").show();
                $("#formsakramen #btnsaveformsakramen").show();
                $("#formsakramen #btncancelformsakramen").show();
            });

            $("#formsakramen #btncancelformsakramen").click(function()
            {
                $("#formsakramen #formaddsakramen").hide();
                $("#formsakramen #formaddsakramen #btnsaveformsakramen").hide();
                $("#formsakramen #formaddsakramen #btncancelformsakramen").hide();
            });
        </script>
        <!-- END ADD FORM SAKRAMEN -->