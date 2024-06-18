        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">WARTA GEREJA</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section> 

            <!-- Main content -->
            <section class="content" id="wartalist">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12" style="text-align:right">
                            <a href="index.php?p=newsevent_wartaform&id=0">
                            <button type="button" class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                Add New
                            </button>
                            </a>
                        </div>
                        <!-- left column -->
                        <?php
                        $query_list = mysqli_query($con,"SELECT * FROM `warta` order by publish_date DESC")or die (mysqli_error($con));
                        $sum_list   = mysqli_num_rows($query_list);
                        if($sum_list>0)
                        {
                            $i=1;
                            while($data_list=mysqli_fetch_array($query_list))
                            {
                                if ($i % 2 == 0)
                                {
                                    $clr_row = "background-color: #ffffff;";
                                }
                                else
                                {
                                    $clr_row = "background-color: #CDCDCD54;";
                                }
                                $id_warta               = $data_list['id'];
                                $doc_warta              = $data_list['doc'];
                                $publish_data           = $data_list['publish_date'];
                                $exp_publish            = explode("-",$publish_data);
                                $ds                     = $exp_publish[2];
                                $ms                     = $exp_publish[1];
                                $ms_id                  = changemonth_id($ms);
                                $ys                     = $exp_publish[0];
                                $publish_warta          = $ds.' '.$ms_id.' '.$ys;
                                $title_warta            = $data_list['title'];
                                $status_warta           = $data_list['visible'];
                                if($status_warta=='P')
                                {
                                    $check_status  = '';
                                    $value_status  = 'D';
                                    $name_status   = 'PUBLISH';
                                }
                                else
                                {
                                    $check_status  = 'checked';
                                    $value_status  = 'P';
                                    $name_status   = 'DRAFT';
                                }
                                $warta_json    = array(
                                    'id_warta'       => $id_warta,
                                    'doc_warta'      => $doc_warta
                                );    
                        ?>
                                <div class="col-md-12" style="flex: unset;margin-left: 50px;margin-bottom: 15px;<?php echo $clr_row ?>">
                                    <table width="100%" style="margin: 20px auto;">
                                        <tr>
                                            <td width="85%">
                                                <?php echo $publish_warta ?> <br>
                                                <h4> <?php echo $title_warta ?> </h4>
                                            </td>
                                            <td width="15%" style="min-width: 130px;display: flex;align-items: center;justify-content: center;">
                                                <a href="index.php?p=newsevent_wartaform&id=<?php echo $id_warta ?>">
                                                <button type="button" class="btnedit" title="Edit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;margin-top: 25px;">
                                                    <i class="fa fa-edit" style="color: #fff;"></i>
                                                </button>
                                                </a>
                                                &nbsp&nbsp&nbsp
                                                <button data-warta='<?php echo json_encode($warta_json) ?>' type="button" class="btndelete" title="Delete" onclick="return confirm('Are you sure you want to delete this item ?')" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;margin-top: 25px;">
                                                    <i class="fa fa-trash" style="color: #fff;"></i>
                                                </button>
                                                <form id="checkgo" method="post" style="margin-left: 12px;">
                                                    <input type="hidden" name="id" value="<?php echo $id_warta ?>" id="id<?php echo $id_warta ?>">
                                                    <input type="hidden" name="tbname" value="warta" id="tbname<?php echo $id_warta ?>">
                                                    <input type="hidden" name="doc" value="<?php echo $doc_warta ?>" id="doc<?php echo $id_warta ?>">
                                                    <input type="hidden" name="title" value="<?php echo $title_warta ?>" id="title<?php echo $id_warta ?>">
                                                    <input type="hidden" name="publish" value="<?php echo $publish_data ?>" id="publish<?php echo $id_warta ?>">
                                                    <font style="text-align: center;color: #7C7C7C;margin: 10px;"> <?php echo $name_status ?> </font>
                                                    <div class="button r" id="button-1">
                                                        <input type="checkbox" onchange="doThis<?php echo $id_warta ?>(this)" name="wegeb" id="wegep<?php echo $id_warta ?>" value="<?php echo $value_status ?>" class="checkbox" <?php echo $check_status ?>/>
                                                        <div class="knobs"></div>
                                                        <div class="layer"></div>
                                                    </div>
                                                </form>  
                                                <script>
                                                    function doThis<?php echo $id_warta ?>(checkbox){
                                                    var wegeb       = document.getElementById("wegep<?php echo $id_warta ?>").value
                                                    var id          = document.getElementById("id<?php echo $id_warta ?>").value
                                                    var tbname      = document.getElementById("tbname<?php echo $id_warta ?>").value
                                                    var doc         = document.getElementById("doc<?php echo $id_warta ?>").value
                                                    var title       = document.getElementById("doc<?php echo $title_warta ?>").value
                                                    var info        = {wegeb: wegeb,id: id,tbname: tbname};
                                                    //alert(wegeb);
                                                    if(wegeb=="P" && (title=="" || doc==""))
                                                    {
                                                        $("#notifpublishmodal").modal("show");
                                                        setTimeout(function(){ window.location ='index.php?p=newsevent_warta';},3000);  
                                                    }
                                                    else
                                                    {
                                                        $.ajax({
                                                            type : "POST",
                                                            url : "change_visible.php",
                                                            data : info,
                                                            success: function(){
                                                                document.getElementById("wegep<?php echo $id_warta ?>").value = wegeb == 'P'?'D':'P'
                                                                setTimeout(function(){ window.location ='index.php?p=newsevent_warta';});  
                                                            },
                                                            error: function(){
                                                                document.getElementById("wegep<?php echo $id_warta ?>").value = wegeb
                                                            }
                                                            });
                                                            return false;
                                                        }
                                                    }           
                                                </script>
                                            </td> 
                                        </tr>
                                    </table>           
                                </div>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>    
                </div> 
            </section>           
        </div>