<?php
if(isset($_POST['updateschedule']))
{
    print_r($_POST);
}
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="margin: 24px">JADWAL MISA</h1>
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
                                <?php
                                    $query_misa_category    = mysqli_query($con,"SELECT * FROM misa_schedule WHERE parentid='0' AND visible='Y'")or die (mysqli_error($con));
                                    $sum_misa_category      = mysqli_num_rows($query_misa_category);
                                    if($sum_misa_category>0)
                                    {
                                        while($data_misa_category=mysqli_fetch_array($query_misa_category))
                                        {
                                            $misa_category_id   = $data_misa_category['id'];
                                            $misa_category_name = $data_misa_category['name']; 
                                ?>
                                            <div class="col-sm-12">
                                            <form method="POST" action="" >
                                                <h5 style="margin: 24px;color: #88A8D4;"><?php echo $misa_category_name ?></h5>
                                                <?php
                                                $query_misa_day = mysqli_query($con,"SELECT * FROM misa_schedule WHERE parentid='$misa_category_id' AND visible='Y'")or die (mysqli_error($con));
                                                $sum_misa_day   = mysqli_num_rows($query_misa_day);
                                                if($sum_misa_day>0)
                                                {
                                                    $j=1;
                                                    while($data_misa_day=mysqli_fetch_array($query_misa_day))
                                                    {
                                                        $misa_day_id[$j]  = $data_misa_day['id'];
                                                        $misa_day_name[$j]= $data_misa_day['name'];
                                                        $misa_day_sch[$j] = $data_misa_day['schedule']
                                                ?>
                                                        <table class="table" style="margin: 24px;width: 50%;">
                                                            <thead style="color: #000000;">
                                                                <tr>
                                                                    <th colspan="" style="padding: unset;border: unset;">
                                                                        <?php echo $misa_day_name[$j] ?>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row_position">
                                                                <input type="text" name="scheduleid" value="<?php echo $misa_day_id[$j] ?>">
                                                            </tbody>
                                                        </table>  
                                                        <div style="margin:24px">
                                                            <input type="submit" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;" name="updateschedule" VALUE="SUBMIT">
                                                            &nbsp&nbsp
                                                            <a href="" onclick="return confirm('Are you sure you want to cancel ?')"><button type="button" class="btn-sm" style="background-color:#E90000;color: #ffffff;font-weight: bold;">RESET ALL</button></a>
                                                        </div>    
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </form>
                                            </div>
                                <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /HANDLE MISA SCHEDULE --->
                </div>
            </section>  
        </div>