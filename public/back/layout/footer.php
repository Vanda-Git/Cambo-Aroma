<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020 Vanda Team</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../Asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../Asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="../Asset/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../Asset/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../Asset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../Asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../Asset/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../Asset/plugins/moment/moment.min.js"></script>
<script src="../Asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../Asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../Asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../Asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../Asset/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../Asset/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../Asset/dist/js/demo.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="../Asset/plugins/Datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../Asset/plugins/Datatables/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
<!-- <script src="../Asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
<!-- Select2 -->
<script src="../Asset/plugins/select2/js/select2.full.min.js"></script>

<!-- CK editor -->
<script src="../Asset/plugins/ckeditor/ckeditor.js"></script>
<!-- page script -->
<!-- Bootstrap 4 -->
<script src="../Asset/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
  $(function () {
    // ckeditor
    CKEDITOR.replace( 'editor1' );
    
    $('.sec2').select2();
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": true,
      dom: 'Bfrtip',
      buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "lengthChange": true,
    });
//     $(document).ready(function() {
//     $('#example').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copyHtml5',
//             'excelHtml5',
//             'csvHtml5',
//             'pdfHtml5'
//         ]
//     } );
// } );
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
</body>
</html>