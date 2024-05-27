    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        </div>
        <strong>Developed By Designata Studio
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo $base_assets ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $base_assets ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $base_assets ?>plugins/select2/js/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $base_assets ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $base_assets ?>plugins/datepicker/js/bootstrap-datepicker.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $base_assets ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $base_assets ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $base_assets ?>dist/js/adminlte.min.js"></script>
<script>
    $(function(){
        window.prettyPrint && prettyPrint();
        $('#dp1').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked'
        });           
    });
    $(function(){
        window.prettyPrint && prettyPrint();
        $('#dp2').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked'
        });           
    });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
    var el = document.querySelector('.row_position');
    var sortable = Sortable.create(el,{
      onUpdate: function (/**Event*/evt) {
        arr = [];index=0
        $('.tableid').each(function(item){
        arr.push({id:$(this).attr('data-id'),sort:index++})
        })
            updateOrder(arr);
        },

    });
    /*
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });
    
    var itemEl = evt.item;  // dragged HTMLElement
        var potstart = evt.oldIndex;  // element's old index within old parent
        var potend = evt.newIndex;  // element's new index within new parent
          // same properties as onEnd
          //
          //console.table('Sortable',evt.to,evt.from,evt.oldIndex,evt.newIndex,itemEl)
          var target    = $(`.tableid:eq(${potstart})`).attr("data-id")
          var ordersec  = $(`.tableid:eq(${potstart})`).attr("data-sec")
          var target2   = $(`.tableid:eq(${potend})`).attr("data-id")
          var ordersec2 = $(`.tableid:eq(${potend})`).attr("data-sec")
          console.table('Updated',target,ordersec2,target2,ordersec,potstart,potend)
    */


    function updateOrder(data) {
        $.ajax({
            url:"change_sort.php",
            type:'post',
            data:{position:data},
            success:function(){
                //alert('your change successfully saved');
                //location.reload();
            }
        })
    }
</script>

<script type="text/javascript">  
    myDropzone = new Dropzone('div#imageUpload', {
    addRemoveLinks: true,
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 3,
    paramName: 'file',
    clickable: true,
    url: 'ajax_upload.php',
    init: function () {

        var myDropzone = this;
        // Update selector to match your button
        $btn.click(function (e) {
            e.preventDefault();
            if ( $form.valid() ) {
                myDropzone.processQueue();
            }
            return false;
        });

        this.on('sending', function (file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $form.serializeArray();
            $.each(data, function (key, el) {
                formData.append(el.name, el.value);
            });
            console.log(formData);

        });
    },
    error: function (file, response){
        if ($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    successmultiple: function (file, response) {
        console.log(file, response);
        $modal.modal("show");
    },
    completemultiple: function (file, response) {
        console.log(file, response, "completemultiple");
        //$modal.modal("show");
    },
    reset: function () {
        console.log("resetFiles");
        this.removeAllFiles(true);
    }
});
        
</script>
</body>
</html>