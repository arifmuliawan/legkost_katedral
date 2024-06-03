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
                                                <h5 style="margin: 24px;color: #88A8D4;"><?php echo $misa_category_name ?></h5>
                                                <?php
                                                $query_misa_day = mysqli_query($con,"SELECT * FROM misa_schedule WHERE parentid='$misa_category_id' AND visible='Y'")or die (mysqli_error($con));
                                                $sum_misa_day   = mysqli_num_rows($query_misa_day);
                                                if($sum_misa_day>0)
                                                {
                                                    while($data_misa_day=mysqli_fetch_array($query_misa_day))
                                                    {
                                                        $misa_day_id    = $data_misa_day['id'];
                                                        $misa_day_name  = $data_misa_day['name'];
                                                        $misa_day_sch   = $data_misa_day['schedule']
                                                ?>
                                                        <table class="table" style="margin: 24px;width: 50%;">
                                                            <thead style="color: #000000;">
                                                                <tr>
                                                                    <th colspan="" style="padding: unset;border: unset;">
                                                                        <?php echo $misa_day_name ?>
                                                                    </th>
                                                                    <?php
                                                                    $exp_day_sch    = explode("|",$misa_day_sch);
                                                                    $i=1;
                                                                    foreach($exp_day_sch as $ds)
                                                                    {
                                                                        if ($i % 2 == 0)
                                                                        {
                                                                            $clr_row = "background-color: #D9D9D9B2;";
                                                                        }
                                                                        else
                                                                        {
                                                                            $clr_row = "background-color: #ffffff;";
                                                                        }
                                                                        $exp_sch     = explode(":",$ds);
                                                                        $sch_hour    = $exp_sch[0];
                                                                        $sch_min     = $exp_sch[1];
                                                                        $sch_online  = $exp_sch[2];
                                                                        $sch_offline = $exp_sch[3];
                                                                    ?>
                                                                        <tr style="<?php echo $clr_row ?>" class="tableid">
                                                                            <td style="border: unset;">
                                                                                <select class="form-control" style="width: 25%;display: unset;">
                                                                                    <option>00</option>
                                                                                    <option>01</option>
                                                                                    <option>02</option>
                                                                                    <option>03</option>
                                                                                    <option>04</option>
                                                                                    <option>05</option>
                                                                                    <option>06</option>
                                                                                    <option>07</option>
                                                                                    <option>08</option>
                                                                                    <option>09</option>
                                                                                    <option>10</option>
                                                                                    <option>11</option>
                                                                                    <option>12</option>
                                                                                    <option>13</option>
                                                                                    <option>14</option>
                                                                                    <option>15</option>
                                                                                    <option>16</option>
                                                                                    <option>17</option>
                                                                                    <option>18</option>
                                                                                    <option>19</option>
                                                                                    <option>20</option>
                                                                                    <option>21</option>
                                                                                    <option>22</option>
                                                                                    <option>23</option>
                                                                                </select>
                                                                                :
                                                                                <select class="form-control" style="width: 25%;display: unset;">
                                                                                    <option>00</option>
                                                                                    <option>15</option>
                                                                                    <option>30</option>
                                                                                    <option>45</option>
                                                                                </select>
                                                                            </td>
                                                                            <td style="border: unset;">    
                                                                                <input class="form-check-input" type="checkbox" name="sch_online"> 
                                                                                <label class="form-check-label">ONLINE</label>
                                                                            </td>
                                                                            <td style="border: unset;">    
                                                                                <input class="form-check-input" type="checkbox" name="sch_offline"> 
                                                                                <label class="form-check-label">OFFLINE</label>
                                                                            </td>
                                                                        </tr>    
                                                                    <?php
                                                                        $i++;
                                                                    }                                                                    
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row_position">

                                                            </tbody>
                                                        </table>    
                                                <?php
                                                    }
                                                }
                                                ?>
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