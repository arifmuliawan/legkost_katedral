<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LederHaus Administrator</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/datepicker/css/datepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $base_assets ?>dist/css/adminlte.min.css">
    <script type="text/javascript" src="<?php echo $base_assets ?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo $base_assets ?>plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_assets ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo $base_assets ?>plugins/jquery-ui/jquery-ui.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>  
    <link rel="stylesheet" href="<?php echo $base_assets ?>dist/css/dropzone-modif.css">
    
    <?php
    if(isset($form))
    {
    ?>
        <script type="text/javascript">

        $(document).ready(function () {
            // Handler for .ready() called.
            $('html, body').animate({
                scrollTop: $('#f<?php echo $form ?>').offset().top
            }, 'slow');
        });
        </script>
    <?php
    }
    ?>
    <style>
        
        .toggle-button-cover {
        display: table-cell;
        position: relative;
        width: 200px;
        height: 140px;
        box-sizing: border-box;
        }

        .button-cover {
        height: 100px;
        margin: 20px;
        background-color: #fff;
        box-shadow: 0 10px 20px -8px #c5d6d6;
        border-radius: 4px;
        }

        .button-cover:before {
        counter-increment: button-counter;
        content: counter(button-counter);
        position: absolute;
        right: 0;
        bottom: 0;
        color: #d7e3e3;
        font-size: 12px;
        line-height: 1;
        padding: 5px;
        }

        .button-cover,
        .knobs,
        .layer {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        }

        .button {
        position: relative;
        top: 50%;
        width: 74px;
        height: 36px;
        margin: 0px auto 0 auto;
        overflow: hidden;
        }

        .button.r,
        .button.r .layer {
        border-radius: 100px;
        }

        .button.b2 {
        border-radius: 2px;
        }

        .checkbox {
        position: relative;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 3;
        }

        .knobs {
        z-index: 2;
        }

        .layer {
        width: 100%;
        background-color: #88A8D4;
        transition: 0.3s ease all;
        z-index: 1;
        }

        /* Button 1 */
        #button-1 .knobs:before {
        content: "ON";
        position: absolute;
        top: 3px;
        left: 4px;
        width: 30px;
        height: 30px;
        color: #fff;
        font-size: 10px;
        font-weight: bold;
        text-align: center;
        line-height: 1;
        padding: 9px 4px;
        background-color: #fff;
        border-radius: 100%;
        transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
        }

        #button-1 .checkbox:checked + .knobs:before {
        content: "OFF";
        /*left: 42px;*/
        background-color: #fff;
        }

        #button-1 .checkbox:checked ~ .layer {
        background-color: #888888AD;
        }

        #button-1 .knobs,
        #button-1 .knobs:before,
        #button-1 .layer {
        transition: 0.3s ease all;
        left: 38px;
        }
        .switch label input[type="checkbox"]:checked + .lever {
            background-color: #DFDFDF;
        }

    </style>

    <script type="text/javascript">
      function checkAll(ele) {
           var checkboxes = document.getElementsByTagName('input');
           if (ele.checked) {
               for (var i = 0; i < checkboxes.length; i++) {
                   if (checkboxes[i].type == 'checkbox' ) {
                       checkboxes[i].checked = true;
                   }
               }
           } else {
               for (var i = 0; i < checkboxes.length; i++) {
                   if (checkboxes[i].type == 'checkbox') {
                       checkboxes[i].checked = false;
                   }
               }
           }
       }
    </script>
</head>
<div class="modal fade" id="notifmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                <img src="" style="width: 70px;">
                <br><br>
                <h5>  </h5>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="notifcancelmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                <h3><b>Anda memiliki perubahan yang belum tersimpan</b></h3>
                <br>
                <p> Apabila anda meninggalkan halaman sekarang, perubahan anda akan hilang. Apakah anda ingin menyimpan sebelum meninggalkan halaman? </p>
                <br>
                <table width="100%">
                    <tr>
                        <td width="25%"> 
                            <button id="btnmodalcancel" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;">CANCEL</button>
                        </td>
                        <td width="75%" style="text-align:right"> 
                            <button id="btnmodaldiscard" type="button" class="btn" style="background-color:#E90000;color: #ffffff;font-weight: bold;margin: 15px 0px;">DISCARD</button>
                            &nbsp&nbsp&nbsp
                            <button id="btnmodalsave" type="button" class="btn" style="background-color:#88A8D4;color: #ffffff;font-weight: bold;margin: 15px 0px;">SAVE</button>
                        </td>
                    </tr>
                </table>        
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="notifpublishmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;vertical-align: middle;padding: 40px;">
                <img src="assets/dist/img/icon_failed.png" style="width: 70px;">
                <h3><b>Artikel tidak dapat di-publish, data belum lengkap</b></h3>
                <br>
                <p> Mohon melengkapi seluruh kolom dengan tanda <font color="red">*</font> sebelum mem-publish artikel. </p>
                <button id="btnmodalclose" type="button" class="btn" style="background-color:#ffffff;color: #88A8D4;font-weight: bold;margin: 15px 0px;border-color: #88A8D4;">CLOSE</button>      
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
    if(isset($form))
    {
    ?>
        <script type="text/javascript">

        $(document).ready(function () {
            // Handler for .ready() called.
            $('html, body').animate({
                scrollTop: $('#f<?php echo $form ?>').offset().top
            }, 'slow');
        });
        </script>
    <?php
    }
    ?>
<body class="hold-transition sidebar-mini">