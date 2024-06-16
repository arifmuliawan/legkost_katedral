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
                                                        $pub_end    = date('Y-m-d', strtotime("-$jd days"));
                                                        $pub_start  = date('Y-m-d', strtotime("-6 days",strtotime($pub_end)));
                                                        $query_list = mysqli_query($con,"SELECT * FROM `perkawinan_list` WHERE visible='Y' AND (pengumuman >= '$pub_start' AND pengumuman<= '$pub_end')")or die (mysqli_error($con));
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
                                                                $perkawinan_id      = $data_list['id'];
                                                                $perkawinan_pria    = $data_list['nama_pria'];
                                                                $perkawinan_ppria   = $data_list['paroki_pria'];
                                                                $perkawinan_wanita  = $data_list['nama_wanita'];
                                                                $perkawinan_pwanita = $data_list['paroki_wanita'];
                                                                $publish_data       = $data_list['pengumuman'];
                                                                $exp_publish  = explode("-",$publish_data);
                                                                $ds                 = $exp_publish[2];
                                                                $ms                 = $exp_publish[1];
                                                                $ys                 = $exp_publish[0];
                                                                $perkawinan_publish = $ds.'/'.$ms.'/'.$ys;
                                                                $perkawinan_json    = array(
                                                                    'id_perkawinan'   => $perkawinan_id,
                                                                    'pria_perkawinan' => $perkawinan_pria,
                                                                    'ppria_perkawinan'=> $perkawinan_ppria,
                                                                    'wanita_perkawinan' => $perkawinan_wanita,
                                                                    'pwanita_perkawinan'=> $perkawinan_pwanita,
                                                                    'publish_perkawinan'=> $perkawinan_publish                                  
                                                                );
                                                        ?>    
                                                                <tr style="line-height: 50px;">
                                                                    <input type="hidden" name="id" value="<?php echo $perkawinan_id ?>">
                                                                    <td style="width: 80%;<?php echo $clr_row ?>"> &nbsp&nbsp&nbsp&nbsp <?php echo $perkawinan_pria." & ".$perkawinan_wanita ?> </td>
                                                                    <td style="width: 20%;"> 
                                                                        &nbsp&nbsp&nbsp&nbsp
                                                                        <button type="button" class="btnedit" title="Edit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" data-toggle="modal" data-target="#modaldetailperkawinan" data-perkawinan='<?php echo json_encode($perkawinan_json) ?>'>
                                                                            <i class="fa fa-edit" style="color: #fff;"></i>
                                                                        </button>
                                                                        &nbsp&nbsp&nbsp
                                                                        <button type="button" class="btndelete" title="Delete" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                                            <i class="fa fa-trash" style="color: #fff;"></i>
                                                                        </button>
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

        <!-- START MODAL FORM DETAIL PERKAWINAN -->
        <div class="modal fade" id="modaldetailperkawinan" style="pointer-events: none;">
            <div class="modal-dialog" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-body" style="padding: 40px;">
                        <div class="card-body">
                            <form id="formeditsakramen">
                                <input type="hidden" name="id">
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
                                        <button type="button" class="btn-save" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" id="btnsavedetailperkawinan">
                                            SAVE
                                        </button>
                                        &nbsp&nbsp&nbsp
                                        <button type="button" class="btn-cancel" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;" id="btncanceldetailperkawinan" onclick="return confirm('Are you sure you want to cancel this process ?')">
                                            CANCEL
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END MODAL FORM DETAIL PERKAWINAN -->

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
                            //setTimeout(function(){ window.location ='index.php?p=misasakramen_perkawinan'; }, 3000);
                        }
                        console.log(data,status);
                    }
                    );
                }       
            }); 
        </script>
        <!-- END ADD PERKAWINAN -->

        <!-- START DATA DETAIL PERKAWINAN LIST -->
        <script>
            $(document).on("click", ".btnedit", function () {
                var me      = $(this);
                var data    = me.attr('data-perkawinan');
                var jdata   = JSON.parse(data);
                $("#modaldetailperkawinan input[name=id]").val( jdata.id_perkawinan);
                $("#modaldetailperkawinan input[name=nama_pria]").val( jdata.pria_perkawinan);
                $("#modaldetailperkawinan input[name=paroki_pria]").val( jdata.ppria_perkawinan);
                $("#modaldetailperkawinan input[name=nama_wanita]").val( jdata.wanita_perkawinan);
                $("#modaldetailperkawinan input[name=paroki_wanita]").val( jdata.pwanita_perkawinan);
                $("#modaldetailperkawinan #dp1").val( jdata.publish_perkawinan);
            });

            $("#btncanceldetailperkawinan").click(function()
            {  
                setTimeout(function(){ window.location ='index.php?p=misasakramen_perkawinan'; });
            });
        </script>
        <!-- END DATA DETAIL PERKAWINAN LIST -->

        <!-- START SAVE DATA DETAIL PERKAWINAN LIST -->
        <script>
            $("#btnsavedetailperkawinan").click(function()
            {
                var id_data             = $("#modaldetailperkawinan input[name=id]").val();
                var nama_pria_data      = $("#modaldetailperkawinan input[name=nama_pria]").val();
                var paroki_pria_data    = $("#modaldetailperkawinan input[name=paroki_pria]").val();
                var nama_wanita_data    = $("#modaldetailperkawinan input[name=nama_wanita]").val();
                var paroki_wanita_data  = $("#modaldetailperkawinan input[name=paroki_wanita]").val();
                var publish_start_data  = $("#modaldetailperkawinan #dp1").val();
                if(nama_pria_data=="" || paroki_pria_data=="" || nama_wanita_data=="" || paroki_wanita_data=="" || publish_start_data=="")
                {
                    toastr['error']("Mohon lengkapi data");
                    var delay = 3000;
                } 
                else
                {
                    $.post('ajax-misasakrame.php',
                    {
                        id:id_data,
                        nama_pria:nama_pria_data,
                        paroki_pria:paroki_pria_data,
                        nama_wanita:nama_wanita_data,
                        paroki_wanita:paroki_wanita_data,
                        publish_start:publish_start_data,
                        edit_perkawinan:true
                    },
                    function(data,status)
                    {
                        if(data.error_status==1)
                        {
                            toastr['error'](data.error_message);
                        }
                        else
                        {
                            toastr['success'](data.error_message);
                            //setTimeout(function(){ window.location ='index.php?p=misasakramen_perkawinan'; });
                        }
                        console.log(data,status);
                    }
                    );
                }    
            });  
            $("#btncanceldetailsakramen").click(function()
            {  
                setTimeout(function(){ window.location ='index.php?p=misasakramen_perkawinan'; });
            });     
        </script> 
        <!-- END SAVE DATA DETAIL PERKAWINAN LIST -->