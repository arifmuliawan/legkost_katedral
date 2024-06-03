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
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row_position">
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
                                                                            <td style="border: unset;vertical-align: middle;">
                                                                                <select class="form-control" style="width: 25%;display: unset;">
                                                                                    <option <?php if($sch_hour=='00') { echo 'SELECTED';} ?>>00</option>
                                                                                    <option <?php if($sch_hour=='01') { echo 'SELECTED';} ?>>01</option>
                                                                                    <option <?php if($sch_hour=='02') { echo 'SELECTED';} ?>>02</option>
                                                                                    <option <?php if($sch_hour=='03') { echo 'SELECTED';} ?>>03</option>
                                                                                    <option <?php if($sch_hour=='04') { echo 'SELECTED';} ?>>04</option>
                                                                                    <option <?php if($sch_hour=='05') { echo 'SELECTED';} ?>>05</option>
                                                                                    <option <?php if($sch_hour=='06') { echo 'SELECTED';} ?>>06</option>
                                                                                    <option <?php if($sch_hour=='07') { echo 'SELECTED';} ?>>07</option>
                                                                                    <option <?php if($sch_hour=='08') { echo 'SELECTED';} ?>>08</option>
                                                                                    <option <?php if($sch_hour=='09') { echo 'SELECTED';} ?>>09</option>
                                                                                    <option <?php if($sch_hour=='10') { echo 'SELECTED';} ?>>10</option>
                                                                                    <option <?php if($sch_hour=='11') { echo 'SELECTED';} ?>>11</option>
                                                                                    <option <?php if($sch_hour=='12') { echo 'SELECTED';} ?>>12</option>
                                                                                    <option <?php if($sch_hour=='13') { echo 'SELECTED';} ?>>13</option>
                                                                                    <option <?php if($sch_hour=='14') { echo 'SELECTED';} ?>>14</option>
                                                                                    <option <?php if($sch_hour=='15') { echo 'SELECTED';} ?>>15</option>
                                                                                    <option <?php if($sch_hour=='16') { echo 'SELECTED';} ?>>16</option>
                                                                                    <option <?php if($sch_hour=='17') { echo 'SELECTED';} ?>>17</option>
                                                                                    <option <?php if($sch_hour=='18') { echo 'SELECTED';} ?>>18</option>
                                                                                    <option <?php if($sch_hour=='19') { echo 'SELECTED';} ?>>19</option>
                                                                                    <option <?php if($sch_hour=='20') { echo 'SELECTED';} ?>>20</option>
                                                                                    <option <?php if($sch_hour=='21') { echo 'SELECTED';} ?>>21</option>
                                                                                    <option <?php if($sch_hour=='22') { echo 'SELECTED';} ?>>22</option>
                                                                                    <option <?php if($sch_hour=='23') { echo 'SELECTED';} ?>>23</option>
                                                                                </select>
                                                                                :
                                                                                <select class="form-control" style="width: 25%;display: unset;">
                                                                                    <option <?php if($sch_hour=='00') { echo 'SELECTED';} ?>>00</option>
                                                                                    <option <?php if($sch_hour=='15') { echo 'SELECTED';} ?>>15</option>
                                                                                    <option <?php if($sch_hour=='30') { echo 'SELECTED';} ?>>30</option>
                                                                                    <option <?php if($sch_hour=='45') { echo 'SELECTED';} ?>>45</option>
                                                                                </select>
                                                                            </td>
                                                                            <td style="border: unset;vertical-align: middle;">    
                                                                                <input class="form-check-input" type="checkbox" name="sch_online" <?php if($sch_online=='1'){ echo "CHECKED";} ?>> 
                                                                                <label class="form-check-label">ONLINE</label>
                                                                            </td>
                                                                            <td style="border: unset;vertical-align: middle;">    
                                                                                <input class="form-check-input" type="checkbox" name="sch_offline" <?php if($sch_offline=='1'){ echo "CHECKED";} ?>> 
                                                                                <label class="form-check-label">OFFLINE</label>
                                                                            </td>
                                                                        </tr>    
                                                                    <?php
                                                                        $i++;
                                                                    }                                                                    
                                                                    ?>
                                                            </tbody>
                                                        </table>  
                                                        <div style="margin:24px">
                                                            <button id="btnaddparoki" type="button" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;">SUBMIT</button>
                                                            &nbsp&nbsp
                                                            <a href="" onclick="return confirm('Are you sure you want to cancel ?')"><button type="button" class="btn-sm" style="background-color:#E90000;color: #ffffff;font-weight: bold;">RESET ALL</button></a>
                                                        </div>    
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