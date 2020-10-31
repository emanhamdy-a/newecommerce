<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/design/Adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ url('/design/Adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<link rel="stylesheet" href="{{ url('design/Adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<script src="{{ url('design/Adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('design/Adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ url('design/Adminlte') }}/bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<!-- <script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script> -->


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
  <!-- select2 -->
<script src="{{ url('/design/Adminlte/select2/select2.min.js') }}"></script>

<script src="{{ url('/design/Adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->

<!-- daterangepicker -->
<script src="{{ url('/design/Adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ url('/design/Adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- datepicker -->
<script src="{{ url('/design/Adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ url('/design/Adminlte/dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ url('/design/Adminlte/jstree/js/demo.js') }}"></script> -->
<script src="{{ url('/design/Adminlte/jstree/js/jstree.js') }}"></script>
<script src="{{ url('/design/Adminlte/jstree/js/jstree.checkbox.js') }}"></script>
<script src="{{ url('/design/Adminlte/jstree/js/jstree.wholerow.js') }}"></script>
<script src="{{ url('/design/Adminlte/jstree/js/jstree.types.js') }}"></script>


@stack('js')
@stack('css')

</body>
</html>
