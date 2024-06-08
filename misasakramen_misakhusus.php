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
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                        Pop up acara misa khusus dan tombol yang mengarahkan pada pop up tersebut dapat secara otomatis ditampilkan dan dihilangkan dari website, yaitu dengan cara mengisi isian tanggal dibawah ini.
                                        </p>   
                                        <p>
                                        Mohon diperhatikan bahwa untuk kemudahan pengisian data berikutnya, seluruh data yang telah diisi pada halaman ini akan dihapus secara otomatis dalam jangka waktu 3 hari setelah tanggal berakhir. Apabila ada keperluan rekap atau keperluan lainnya, mohon untuk melakukannya dalam jangka waktu tersebut.
                                        </p>
                                    </div>
                                    <form method="POST">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">TANGGAL MULAI TAMPIL <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='publist_start' placeholder="dd/mm/yyyy" value="" id="dp1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">TANGGAL BERAKHIR <font color="red">*</font></label>
                                            <input type="text" class="form-control" name='publist_end' placeholder="dd/mm/yyyy" value="" id="dp2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align:right">
                                        <button id="btnsubmitpublish" type="button" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button></a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /HANDLE MISA SCHEDULE --->
                </div>
            </section>  
        </div>   
        <!-- START RESET SCHEDULE -->
        <script>
            $("#formschedule #btnresetschedule").click(function()
            {
                var me      = $(this);
                var data    = me.attr('data-schedule');
                var jdata   = JSON.parse(data);
                $.post('ajax-misasakrame.php',
                {
                    scheduleid:jdata.scheduleid,
                    reset_schedule_misa:true
                },
                function(data,status)
                {
                    if(data.error_status==1)
                    {
                        notifmodal(data.error_message,'failed');    
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=misasakramen_jadwalmisa'; }, delay);
                    }
                    else
                    {
                        notifmodal(data.error_message,'success');    
                        var delay = 2000;
                        setTimeout(function(){ window.location ='index.php?p=misasakramen_jadwalmisa'; }, delay);
                    }
                    console.log(data,status);
                }
                );
            });   
        </script>
        <!-- END RESET SCHEDULE -->