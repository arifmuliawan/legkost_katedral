<?php
$query_misa_khusus   = mysqli_query($con,"SELECT * FROM misa_khusus WHERE id='1'")or die (mysqli_error($con));
$sum_misa_khusus     = mysqli_num_rows($query_misa_khusus);
if($sum_misa_khusus>0)
{
    $data_misa_khusus   = mysqli_fetch_array($query_misa_khusus);
    $misa_khusus_id     = $data_misa_khusus['id'];
    $data_publish_start = $data_misa_khusus['publish_start'];
    if($data_publish_start=="")
    {
        $publish_start      = "";
    }
    else
    {
        $exp_publish_start  = explode("-",$data_pubish_start);
        $ds                 = $exp_publish_start[2];
        $ms                 = $exp_publish_start[1];
        $ys                 = $exp_publish_start[0];
        $publish_start      = $ds.'/'.$ms.'/'.$ys;
    }  
    $data_publish_end   = $data_misa_khusus['publish_end'];
    if($data_publish_end=="")
    {
        $publish_end        = "";
    }
    else
    {  
        $exp_publish_end    = explode("-",$data_pubish_end);
        $de                 = $exp_publish_end[2];
        $me                 = $exp_publish_end[1];
        $ye                 = $exp_publish_end[0];
        $publish_end        = $de.'/'.$me.'/'.$ye;
    }    
}
else
{
    $misa_khusus_id     = "";
    $publish_start      = "";
    $publish_end        = "";
}

?>        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="margin: 24px">ACARA MISA KHUSUS</h1>
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
                    <!-- HANDLE MISA SCHEDULE --->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card" style="box-shadow: unset;">
                        <!-- /.card-header -->
                        <!--<form action="" method="post" enctype="multipart/form-data">-->
                            <div class="card-body">
                                <form method="POST" id="formpublish">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                        Pop up acara misa khusus dan tombol yang mengarahkan pada pop up tersebut dapat secara otomatis ditampilkan dan dihilangkan dari website, yaitu dengan cara mengisi isian tanggal dibawah ini.
                                        </p>   
                                        <p>
                                        Mohon diperhatikan bahwa untuk kemudahan pengisian data berikutnya, seluruh data yang telah diisi pada halaman ini akan dihapus secara otomatis dalam jangka waktu 3 hari setelah tanggal berakhir. Apabila ada keperluan rekap atau keperluan lainnya, mohon untuk melakukannya dalam jangka waktu tersebut.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="misakhususid" value="<?php echo $misa_khusus_id ?>">
                                        <div class="form-group">
                                            <label class="form-label">TANGGAL MULAI TAMPIL <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='publist_start' placeholder="dd/mm/yyyy" value="<?php echo $publish_start ?>" id="dp1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">TANGGAL BERAKHIR <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='publist_end' placeholder="dd/mm/yyyy" value="<?php echo $publish_start ?>" id="dp2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align:right">
                                        <button id="btnsubmitpublish" type="button" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button></a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /HANDLE MISA SCHEDULE --->
                </div>
            </section>  
        </div>   
        <!-- START RESET SCHEDULE -->
        <script>
            $("#formpublish #btnsubmitpublish").click(function()
            {
                $.post('ajax-misasakrame.php',
                {
                    misakhususid:$("#formpublish input[name=misakhususid]").val(),
                    publish_start:$("#formpublish #dp1").val(),
                    publish_end:$("#formpublish #dp2").val(),
                    publish_misakhusus:true
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
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=misasakramen_misakhusus'; }, delay);
                    }
                    console.log(data,status);
                }
                );
            }); 
        </script>
        <!-- END RESET SCHEDULE -->