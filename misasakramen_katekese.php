        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ffffff;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="margin: 24px">KATEKESE</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section> 

            <!-- Main content -->
            <section class="content" id="katekeselist">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12" style="text-align:right">
                            <a href="index.php?p=misasakramen_katekeseform&id=0">
                            <button type="button" class="btn-sm" style="margin: 24px;background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                Add New
                            </button>
                            </a>
                        </div>
                        <!-- left column -->
                        <?php
                        $query_list = mysqli_query($con,"SELECT * FROM `katekese` order by publish_date DESC")or die (mysqli_error($con));
                        $sum_list   = mysqli_num_rows($query_list);
                        if($sum_list>0)
                        {
                            while($data_list=mysqli_fetch_array($query_list))
                            {
                                $id_katekese            = $data_list['id'];
                                $thumb_katekese         = $data_list['thumb_img'];
                                if($thumb_katekese=="")
                                {
                                    $thumbimg_katekese  = "https://placehold.co/250";
                                }
                                else
                                {
                                    $thumbimg_katekese  = $thumb_katekese;
                                }
                                $bannerimg_katekese     = $data_list['banner_img'];
                                $publish_data           = $data_list['publish_date'];
                                $exp_publish            = explode("-",$publish_data);
                                $ds                     = $exp_publish[2];
                                $ms                     = $exp_publish[1];
                                $ms_id                  = changemonth_id($ms);
                                $ys                     = $exp_publish[0];
                                $publish_katekese       = $ds.' '.$ms_id.' '.$ys;
                                $title_katekese         = $data_list['title'];
                                $highlight_katekese     = $data_list['highlight'];
                                $description_katekese   = $data_list['description'];
                                $status_katekese        = $data_list['visible'];
                                if($status_katekese=='P')
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
                        ?>
                                <div class="col-md-12" style="flex: unset;margin-left: 50px;">
                                    <table width="100%">
                                        <tr>
                                            <td width="20%">
                                                <img src="<?php echo $thumbimg_katekese ?>" width="80%">
                                            </td> 
                                            <td width="65%">
                                                <?php echo $publish_katekese ?> <br>
                                                <h4> <?php echo $title_katekese ?> </h4>
                                            </td>
                                            <td width="15%" style="min-width: 130px;display: flex;align-items: center;justify-content: center;">
                                                <a href="index.php?p=misasakramen_katekeseform&id=<?php echo $id_katekese ?>">
                                                <button type="button" class="btnedit" title="Edit" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                    <i class="fa fa-edit" style="color: #fff;"></i>
                                                </button>
                                                </a>
                                                &nbsp&nbsp&nbsp
                                                <button type="button" class="btndelete" title="Delete" style="background-color:#E90000;color: #ffffff;font-weight: bold;display: inline-block;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;border: unset;">
                                                    <i class="fa fa-trash" style="color: #fff;"></i>
                                                </button>
                                                <form id="checkgo" method="post" style="margin-left: 12px;">
                                                    <input type="hidden" name="id" value="<?php echo $id_katekese ?>" id="id<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="tbname" value="katekese" id="tbname<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="thumb" value="<?php echo $thumb_katekese ?>" id="thumb<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="banner" value="<?php echo $bannerimg_katekese ?>" id="banner<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="title" value="<?php echo $title_katekese ?>" id="title<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="highlight" value="<?php echo $highlight_katekese ?>" id="highlight<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="decription" value="<?php echo $description_katekese ?>" id="description<?php echo $id_katekese ?>">
                                                    <input type="hidden" name="publish" value="<?php echo $publish_data ?>" id="publish<?php echo $id_katekese ?>">
                                                    <font style="text-align: center;color: #7C7C7C;margin: 10px;"> <?php echo $name_status ?> </font>
                                                    <div class="button r" id="button-1">
                                                        <input type="checkbox" onchange="doThis<?php echo $id_katekese ?>(this)" name="wegeb" id="wegep<?php echo $id_katekese ?>" value="<?php echo $value_status ?>" class="checkbox" <?php echo $check_status ?>/>
                                                        <div class="knobs"></div>
                                                        <div class="layer"></div>
                                                    </div>
                                                </form>  
                                                <script>
                                                    function doThis<?php echo $id_katekese ?>(checkbox){
                                                    var wegeb       = document.getElementById("wegep<?php echo $id_katekese ?>").value
                                                    var id          = document.getElementById("id<?php echo $id_katekese ?>").value
                                                    var tbname      = document.getElementById("tbname<?php echo $id_katekese ?>").value
                                                    var thumb       = document.getElementById("thumb<?php echo $id_katekese ?>").value
                                                    var banner      = document.getElementById("banner<?php echo $id_katekese ?>").value
                                                    var title       = document.getElementById("title<?php echo $id_katekese ?>").value
                                                    var highlight   = document.getElementById("highlight<?php echo $id_katekese ?>").value
                                                    var description = document.getElementById("description<?php echo $id_katekese ?>").value
                                                    var info        = {wegeb: wegeb,id: id,tbname: tbname};
                                                    if(wgeb=='P' && (thumb=="" || banner=="" || title=="" || highlight=="" || description==""))
                                                    {
                                                        notifmodal('Data belum lengkap, harap lengkapi data terlebih dahulu','failed');
                                                    }
                                                    $.ajax({
                                                        type : "POST",
                                                        url : "change_visible.php",
                                                        data : info,
                                                        success: function(){
                                                            document.getElementById("wegep<?php echo $id_katekese ?>").value = wegeb == 'P'?'D':'P'
                                                            setTimeout(function(){ window.location ='index.php?p=misasakramen_katekese'; });  
                                                        },
                                                        error: function(){
                                                            document.getElementById("wegep<?php echo $id_katekese ?>").value = wegeb
                                                        }
                                                        });
                                                        return false;
                                                    }       
                                                </script>
                                            </td> 
                                        </tr>
                                    </table>           
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>    
                </div> 
            </section>           
        </div>