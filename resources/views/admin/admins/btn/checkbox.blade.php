@if(admin()->user()->id==$id)
<input type="checkbox" name="item[]" class="item_checkbox" value="{{ $id }}" id='chek{{$id}}'>
<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title text-center"></h2>
      </div>
      <div class="modal-body">
        <h2 class="modal-title text-center">{{ trans('admin.you') }}</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $("#chek{{$id}}").click(function() {
      $("#del_admin{{ $id }}").modal('show');
       return false;
     });
  })
</script>
@else
<input type="checkbox" name="item[]" class="item_checkbox" value="{{ $id }}">
@endif
