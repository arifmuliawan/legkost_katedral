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
                    $category_id        = $data_category['id'];
                    $category_sortid    = $data_category['sortid'];
                    $category_title     = $data_category['title'];
                    $category_duration  = $data_category['duration'];
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
                                                        <button type="button" class="btn-save" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                            SAVE
                                                        </button>
                                                        &nbsp&nbsp&nbsp
                                                        <button type="button" class="btn-cancel" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" onclick="return confirm('Are you sure you want to cancel this process ?')">
                                                            CANCEL
                                                        </button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div> 
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <table style="width:100%">
                                                        <?php
                                                        $jd         = $category_duration-7;
                                                        $pub_start  = date('Y-m-d', strtotime("+$jd days"));
                                                        $pub_end    = date('Y-m-d', strtotime("+7 days"),strtotime($pub_start));
                                                        echo "$pub_start | $pub_end";
                                                        /*
                                                        $query_list = mysqli_query($con,"SELECT * FROM `perkawinan_list` WHERE categoryid='$category_id' AND visible='Y' order by sortid ASC")or die (mysqli_error($con));
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
                                                                $sakramen_id    = $data_list['id'];
                                                                $sakramen_sortid= $data_list['sortid'];
                                                                $sakramen_title = $data_list['title'];
                                                                $sakramen_link  = $data_list['link'];
                                                                $sakramen_json      = array(
                                                                    'categoryid_sakramen'   => $category_id,
                                                                    'category_sakramen'     => $category_title,
                                                                    'id_sakramen'           => $sakramen_id,
                                                                    'title_sakramen'        => $sakramen_title,
                                                                    'link_sakramen'         => $sakramen_link                                  
                                                                );
                                                        ?>    
                                                                <tr style="line-height: 50px;">
                                                                    <input type="hidden" name="categoryid" value="<?php echo $category_id ?>">
                                                                    <input type="hidden" name="id" value="<?php echo $sakramen_id ?>">
                                                                    <input type="hidden" name="sortid" value="<?php echo $sakramen_sortid ?>">
                                                                    <td style="width: 80%;<?php echo $clr_row ?>"> &nbsp&nbsp&nbsp&nbsp <?php echo $sakramen_title ?> </td>
                                                                    <td style="width: 20%;"> 
                                                                        &nbsp&nbsp&nbsp&nbsp
                                                                        <button type="button" class="btnedit" title="Edit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" data-toggle="modal" data-target="#modaldetailsakramen" data-sakramen='<?php echo json_encode($sakramen_json) ?>'>
                                                                            <i class="fa fa-edit" style="color: #fff;"></i>
                                                                        </button>
                                                                        &nbsp&nbsp&nbsp
                                                                        <button type="button" class="btn-delete" title="Delete" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                                            <i class="fa fa-trash" style="color: #fff;"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                $i++;
                                                            }
                                                        }
                                                        */    
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
        
        <!-- START ADD PERKAWINAN -->
        <script>
            $(".btn-save").click(function()
            {
                me      = $(this);
                form    = me.closest("form");
                var nama_pria_data      = form.find("input[name=nama_pria]").val();
                var paroki_pria_data    = form.find("input[name=paroki_pria]").val();
                var nama_wanita_data    = form.find("input[name=nama_wanita]").val();
                var paroki_wanita_data  = form.find("input[name=paroki_wanita]").val();
                var publish_start_data  = form.find("#dp1").val();
                if(nama_pria_data=="" || paroki_pria_data=="" || nama_wanita_data=="" || paroki_wanita_data=="" || publish_start_data=="")
                {
                    notifmodal('Mohon lengkapi data','failed');
                }
                else
                {
                    $.post('ajax-misasakrame.php',
                    {
                        nama_pria:nama_pria_data,
                        paroki_pria:paroki_pria_data,
                        nama_wanita:nama_wanita_data,
                        paroki_wanita:paroki_wanita_data,
                        publish_start:publish_start_data,
                        add_perkawinan:true
                    },
                    function(data,status)
                    {
                        if(data.error_status=='1')
                        {
                            notifmodal(data.error_message,'failed');
                        }
                        else
                        {
                            notifmodal(data.error_message,'success');
                            setTimeout(function(){ window.location ='index.php?p=misasakramen_perkawinan'; }, 3000);
                        }
                        console.log(data,status);
                    }
                    );
                }       
            }); 
        </script>
        <!-- END ADD PERKAWINAN -->