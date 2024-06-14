<?php
if(isset($_POST['updateschedule']))
{
    $scheduleid         = $_POST['scheduleid'];
    for($k=1;$k<=8;$k++)
    {
        $on1    = $_POST['sch_online'][$scheduleid][$k];
        if(empty($on1[1]))
        {
            $schonline[]  = '0';
        }
        else
        {
            $schonline[]  = '1';
        }
        $off1    = $_POST['sch_offline'][$scheduleid][$k];
        if(empty($off1[1]))
        {
            $schoffline[]  = '0';
        }
        else
        {
            $schoffline[]  = '1';
        }
    }
    for($z=0;$z<=7;$z++)
    {
        $sch_hour[$z]   = $_POST['sch_hour'][$z];
        $sch_min[$z]    = $_POST['sch_min'][$z];
        $online         = $schonline[$z];
        $offline        = $schoffline[$z];
        $schedule[$z]   = $sch_hour[$z].':'.$sch_min[$z].':'.$online.':'.$offline;
    }
    $schdule_misa       = implode("|",$schedule);
    $update_schedule    = mysqli_query($con,"UPDATE `misa_schedule` SET `schedule`='$schdule_misa',update_by='$user', update_date='$now' WHERE id='$scheduleid'") or die (mysqli_error($con));
    if($update_schedule==1)
    {
        echo "
            <script type='text/javascript'>
                $(document).ready(function(){
                    notifmodal('Perubahan data telah berhasil disimpan','success')
                })
            </script>
        ";
    }
    else
    {
        echo "
            <script type='text/javascript'>
                $(document).ready(function(){
                    notifmodal('Perubahan data gagal disimpan','failed')
                })
            </script>
        ";
    }
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
                                                        $misa_day_sch   = $data_misa_day['schedule'];
                                                        $schedule_json  = array(
                                                            'scheduleid'      => $misa_day_id
                                                        );    
                                                ?>
                                                        <form method="POST" action="" id="formschedule">
                                                        <table class="table" style="margin: 24px;width: 50%;">
                                                            <thead style="color: #000000;">
                                                                <tr>
                                                                    <th colspan="" style="padding: unset;border: unset;">
                                                                        <?php echo $misa_day_name ?>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="row_position">
                                                                <input type="hidden" name="scheduleid" value="<?php echo $misa_day_id ?>">
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
                                                                                <select class="form-control" style="width: 25%;display: unset;" name="sch_hour[]">
                                                                                    <option <?php if($sch_hour=='00') { echo 'SELECTED';} ?> value="00">00</option>
                                                                                    <option <?php if($sch_hour=='01') { echo 'SELECTED';} ?> value="01">01</option>
                                                                                    <option <?php if($sch_hour=='02') { echo 'SELECTED';} ?> value="02">02</option>
                                                                                    <option <?php if($sch_hour=='03') { echo 'SELECTED';} ?> value="03">03</option>
                                                                                    <option <?php if($sch_hour=='04') { echo 'SELECTED';} ?> value="04">04</option>
                                                                                    <option <?php if($sch_hour=='05') { echo 'SELECTED';} ?> value="05">05</option>
                                                                                    <option <?php if($sch_hour=='06') { echo 'SELECTED';} ?> value="06">06</option>
                                                                                    <option <?php if($sch_hour=='07') { echo 'SELECTED';} ?> value="07">07</option>
                                                                                    <option <?php if($sch_hour=='08') { echo 'SELECTED';} ?> value="08">08</option>
                                                                                    <option <?php if($sch_hour=='09') { echo 'SELECTED';} ?> value="09">09</option>
                                                                                    <option <?php if($sch_hour=='10') { echo 'SELECTED';} ?> value="10">10</option>
                                                                                    <option <?php if($sch_hour=='11') { echo 'SELECTED';} ?> value="11">11</option>
                                                                                    <option <?php if($sch_hour=='12') { echo 'SELECTED';} ?> value="12">12</option>
                                                                                    <option <?php if($sch_hour=='13') { echo 'SELECTED';} ?> value="13">13</option>
                                                                                    <option <?php if($sch_hour=='14') { echo 'SELECTED';} ?> value="14">14</option>
                                                                                    <option <?php if($sch_hour=='15') { echo 'SELECTED';} ?> value="15">15</option>
                                                                                    <option <?php if($sch_hour=='16') { echo 'SELECTED';} ?> value="16">16</option>
                                                                                    <option <?php if($sch_hour=='17') { echo 'SELECTED';} ?> value="17">17</option>
                                                                                    <option <?php if($sch_hour=='18') { echo 'SELECTED';} ?> value="18">18</option>
                                                                                    <option <?php if($sch_hour=='19') { echo 'SELECTED';} ?> value="19">19</option>
                                                                                    <option <?php if($sch_hour=='20') { echo 'SELECTED';} ?> value="20">20</option>
                                                                                    <option <?php if($sch_hour=='21') { echo 'SELECTED';} ?> value="21">21</option>
                                                                                    <option <?php if($sch_hour=='22') { echo 'SELECTED';} ?> value="22">22</option>
                                                                                    <option <?php if($sch_hour=='23') { echo 'SELECTED';} ?> value="23">23</option>
                                                                                </select>
                                                                                :
                                                                                <select class="form-control" style="width: 25%;display: unset;" name="sch_min[]">
                                                                                    <option <?php if($sch_hour=='00') { echo 'SELECTED';} ?> value="00">00</option>
                                                                                    <option <?php if($sch_hour=='15') { echo 'SELECTED';} ?> value="15">15</option>
                                                                                    <option <?php if($sch_hour=='30') { echo 'SELECTED';} ?> value="30">30</option>
                                                                                    <option <?php if($sch_hour=='45') { echo 'SELECTED';} ?> value="45">45</option>
                                                                                </select>
                                                                            </td>
                                                                            <td style="border: unset;vertical-align: middle;">  
                                                                                <input class="form-check-input" type="hidden" name="sch_online[<?php echo $misa_day_id ?>][<?php echo $i ?>][]" value="0">
                                                                                <input class="form-check-input" type="checkbox" name="sch_online[<?php echo $misa_day_id ?>][<?php echo $i ?>][]" <?php if($sch_online=='1'){ echo "CHECKED";} ?> value="1"> 
                                                                                <label class="form-check-label">ONLINE</label>
                                                                                <!--<input type="hidden" name="sch_online_values[<?php echo $misa_day_id ?>]">-->

                                                                            </td>
                                                                            <td style="border: unset;vertical-align: middle;"> 
                                                                                <input class="form-check-input" type="hidden" name="sch_offline[<?php echo $misa_day_id ?>][<?php echo $i ?>][]" value="0">
                                                                                <input class="form-check-input" type="checkbox" name="sch_offline[<?php echo $misa_day_id ?>][<?php echo $i ?>][]" <?php if($sch_offline=='1'){ echo "CHECKED";} ?> value="1"> 
                                                                                <label class="form-check-label">OFFLINE</label>
                                                                                <!--<input type="hidden" name="sch_offline_values[<?php echo $misa_day_id ?>]">-->
                                                                            </td>
                                                                        </tr>    
                                                                    <?php
                                                                        $i++;
                                                                    }                                                                    
                                                                    ?>
                                                            </tbody>
                                                        </table>  
                                                        <div style="margin:24px">
                                                            <input type="submit" class="btn-sm" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;" name="updateschedule" VALUE="SUBMIT">
                                                            &nbsp&nbsp
                                                            <button id="btnresetschedule" type="button" class="btn-sm" style="background-color:#E90000;color: #ffffff;font-weight: bold;" onclick="return confirm('Are you sure you want to reset schedule ?')" data-schedule='<?php echo json_encode($schedule_json) ?>'>RESET ALL</button></a>
                                                        </div> 
                                                        <!--
                                                        <script>
                                                            $('[name="sch_online[<?php echo $misa_day_id ?>][]"]').click(function() {
                                                            var arr = [];
                                                            $('[name="sch_online[<?php echo $misa_day_id ?>][]"]').each(function() {
                                                                if ($(this).prop('checked')) arr.push($(this).val());
                                                                else arr.push(0);
                                                            })

                                                            $('[name="sch_online_values[<?php echo $misa_day_id ?>]"]').val(arr);
                                                            });

                                                            $('[name="sch_offline[<?php echo $misa_day_id ?>][]"]').click(function() {
                                                            var arr = [];
                                                            $('[name="sch_offline[<?php echo $misa_day_id ?>][]"]').each(function() {
                                                                if ($(this).prop('checked')) arr.push($(this).val());
                                                                else arr.push(0);
                                                            })

                                                            $('[name="sch_offline_values[<?php echo $misa_day_id ?>]"]').val(arr);
                                                            });
                                                        </script>
                                                        -->
                                                        </form>   
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