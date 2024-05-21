    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        </div>
        <strong>Copyright &copy; 2023 All rights reserved.
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
        var itemEl = evt.item;  // dragged HTMLElement
        evt.to;    // target list
        evt.from;  // previous list
        var potstart = evt.oldIndex;  // element's old index within old parent
        var potend = evt.newIndex;  // element's new index within new parent
        evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
        evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
        evt.clone // the clone element
        evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
          // same properties as onEnd
          //updateOrder(selectedData);
          console.table('Sortable',evt.to,evt.from,evt.oldIndex,evt.newIndex,itemEl)
          var target    = $(`.tableid:eq(${potstart})`).attr("data-id")
          var ordersec  = $(`.tableid:eq(${potstart})`).attr("data-sec")
          var target2   = $(`.tableid:eq(${potend})`).attr("data-id")
          var ordersec2 = $(`.tableid:eq(${potend})`).attr("data-sec")
          console.table('Updated',target,ordersec,target2,ordersec2)
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
    });*/


    function updateOrder(data) {
        $.ajax({
            url:"ajaxPro.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }
</script>
</body>
</html>