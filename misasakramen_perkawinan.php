        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">PENGUMUMAN PERKAWINAN</h1>
                            <p style="margin: 24px;color: red;font-size: 14px;">KOLOM DENGAN TANDA * WAJIB DIISI</p>
                            <p style="margin: 24px;font-size: 14px;">
                                Pengisian data dari Pengumuman Pertama. Seminggu dari Pengumuman Pertama, data otomatis akan berpindah menjadi Pengumuman Kedua. Seminggu kemudian, otomatis berpindah menjadi Pengumuman Ketiga. Dan seminggu kemudian akan otomatis hilang (archive).
                            </p>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            $query_category = mysqli_query($con,"SELECT * FROM `perkawinan_category` WHERE visible='Y' order by sortid")or die (mysqli_error($con));
            $sum_category   = mysqli_num_rows($query_category);
            if($sum_category>0)
            {
                while($data_category=mysqli_fetch_array($query_category))
                {
                    $category_id    = $data_category['id'];
                    $category_sortid= $data_category['sortid'];
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
                                            <?php
                                            if($category_sortid==0)
                                            {
                                            ?>     
                                                <button id="btnaddlist" type="button" class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                    Add New
                                                </button>
                                            <?php
                                            }
                                            ?>
                                            <div class="card-body" style="margin: 0px 24px;background: #D9D9D9;display: none;"  id="formsakramen">
                                                <form method="POST">
                                                <input type="hidden" name="categoryid" value="<?php echo $category_id ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">NAMA MEMPELAI PRIA <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='nama_pria' placeholder="Type something here....">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">ASAL PAROKI <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='paroki_pria' placeholder="Type something here....">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">NAMA MEMPELAI WANITA <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='nama_wanita' placeholder="Type something here....">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">ASAL PAROKI <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='paroki_wanita' placeholder="Type something here....">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">TANGGAL PENGUMUMAN <font color="red">*</font></label>
                                                            <input type="text" class="form-control" name='publist_start' placeholder="dd/mm/yyyy" id="dp1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> </div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn-save" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                            SAVE
                                                        </button>
                                                        &nbsp&nbsp&nbsp
                                                        <button type="button" class="btn-cancel" style="margin: 24px;background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" onclick="return confirm('Are you sure you want to cancel this process ?')">
                                                            CANCEL
                                                        </button>
                                                    </div>
                                                </div>
                                                </form>
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

        <!-- START VIEW FORM PERKAWINAN -->
        <script>
            $(".btn-sm").click(function()
            {
                me = $(this);
                me.siblings().show();
            });

            $(".btn-cancel").click(function()
            {
                me = $(this);
                me.closest(".card-body").hide();
            });
        </script>
        <!-- END VIEW FORM PERKAWINAN -->