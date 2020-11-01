@extends('admin.index')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  	<?php //print_r($users); ?>
    <table id="datatable" class="display">
      <thead>
          <tr>
              <th></th>
              <th>id</th>
              <th>name</th>
              <th>email</th>
              <th>delete</th>
              <th>edit</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) { ?>
          <tr>
              <td> <input type="checkbox" name="user" id=""> </td>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              
              <td>
                <a class='user_delete' href="{{ URL::route('users.destroy', $user->id) }}"><i class='fa fa-trash'></i></a>
              </td>
              <td>
                <a class='user_edit' href="/admin/users/{{$user->id}}/edit"><i class='fa fa-edit'></i></a>
              </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->


<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="mutlipleDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger">
        	<div class="empty_record hidden">
        	<h4>{{ trans('admin.please_check_some_records') }} </h4>
        	</div>
        	<div class="not_empty_record hidden">
        	<h4>{{ trans('admin.ask_delete_itme') }} <span class="record_count"></span> ? </h4>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
      	<div class="empty_record hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
      	</div>
      	<div class="not_empty_record hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
        <input type="submit"  value="{{ trans('admin.yes') }}"  class="btn btn-danger del_all" />
        </div>
      </div>
    </div>
  </div>
</div>


@push('js')
<script>
  //delete_all();
  $(document).ready( function () {
    $('#datatable').DataTable();
  });
</script>
@endpush

@endsection
