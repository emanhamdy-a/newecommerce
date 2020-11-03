@extends('admin.index')
@section('content')

{!! Form::open(['id'=>'form_data','url'=>aurl('admin/destroy/all'),'method'=>'delete']) !!}

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
    </br>
    </br>
    <div class="buttons col-12">
      <a class='admin_create btn btn-success m-3 p-3' href="/admin/admins/create">+ add</i></a>

      <a class="dt-button btn btn-danger delBtn m-3 p-3" tabindex="0"><span><i class="fa fa-trash"></i></span></a>
    </div>
    </br>
  </div>
  <!-- /.box-header -->
  <div class="box-body maxContainer allElements">
    <div class="done alert alert-success p-4 m-4 col-12"
      style='display:none;'>
      removed
    </div>
    <div class="wrong alert alert-danger p-4 m-4 col-12"
    style='display:none;'>
      faild
    </div>
    </br>

    <table id="datatable" class="display">
      <thead>
          <tr>
              <th>
                <input type="checkbox"
                class="check_all" onclick="check_all()">
              </th>
              <th>id</th>
              <th>name</th>
              <th>email</th>
              <th>delete</th>
              <th>edit</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach ($admins as $admin) { ?>
          <tr class='container{{ $admin->id }}'>
              <td> <input type="checkbox" name="item[]" class="item_checkbox" value="{{ $admin->id }}"> </td>
              <td>{{$admin->id}}</td>
              <td>{{$admin->name}}</td>
              <td>{{$admin->email}}</td>

              <td>
                <a class='delete_btn btn btn-danger btn-sm'
                deleted='Course'
                sendId='{{$admin->id}}'
                href="{{ aurl('/') }}/admins/delete/{{$admin->id}}">{{__("Delete")}}</a>
              </td>

              <td>
                <a class='admin_edit' href="/admin/admins/{{$admin->id}}/edit"><i class='fa fa-edit'></i></a>
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

{!! Form::close() !!}

@push('js')
<script>

  delete_all();

  $(document).ready( function () {

    $('#datatable').DataTable();

    $('.maxContainer').on("click",".delete_btn", function(e) {
     e.preventDefault();
     if (confirm('Are you sure you want to delete this?')) {
        var sendId= $(this).attr('sendId');
        $('.done').css('display','none');
        $('.wrong').css('display','none');
        var url= $(this).attr('href');
        $.ajax({
            url: url ,
            type: 'get',
            data: {},
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.wrong').css('display','none');
                $('.done').css('display','block');
                $('.allElements .container'+sendId).remove();
                setTimeout(() => {
                    $('.done').css('display','none');
                    $('.wrong').css('display','none');
                }, 2000);
            },error: function(data) {
                $('.done').css('display','none');
                $('.wrong').css('display','block');
                $('.wrong').text('Some thing wrong, Please try again.');
                setTimeout(() => {
                    $('.done').css('display','none');
                    $('.wrong').css('display','none');
                }, 2000);
            },
        });
     }
    });

      $('#button').click( function () {
          table.row('.selected').remove().draw( false );
      } );

  });
</script>
@endpush

@endsection
