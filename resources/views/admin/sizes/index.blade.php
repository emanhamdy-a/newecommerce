@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>

  <!-- /.box-header -->
  <div class="box-body maxContainer allElements"
    style=' max-width: 1300px !important;'>
    <div class="done alert alert-success p-4 m-4 col-12"
      style='display:none;'>
      {{trans('admin.deleted_record')}}
    </div>
    <div class="wrong alert alert-danger p-4 m-4 col-12"
      style='display:none;'>
      {{trans('admin.worng')}}
    </div>
    </br>

    <table class='filter'>
      <tr>
        <td>
          <a class='size_create btn btn-info' href="/admin/sizes/create">+ {{trans('admin.add')}}</i></a>
        </td>
        <td>
          <a class="btn btn-danger delBtn m-y" tabindex="0"><span><i class="fa fa-trash"></i></span></a>
        </td>
        <td>
          <button id='' class='btn btn-secondray btn-sm m-y reset_button'
            value=''>
            {{trans('admin.reset')}}
          </button>
        </td>
      </tr>
    </table>
      <br>
    {!! Form::open(['id'=>'form_data','url'=>aurl('sizes/destroy/all'),'method'=>'delete']) !!}
      <table id="datatable" style='width:100% !important;'
        class="display responsive nowrap">
        <thead>
            <tr>
                <th>
                  <input type="checkbox"
                  class="check_all" onclick="check_all()">
                </th>
                <th>id</th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.department')}}</th>
                <th>{{trans('admin.public')}}</th>
                <th>{{trans('admin.created_at')}}</th>
                <th>{{trans('admin.updated_at')}}</th>
                <th>{{trans('admin.delete')}}</th>
                <th>{{trans('admin.edit')}}</th>
            </tr>
        </thead>


        <tbody>
          <?php foreach ($sizes as $size) { ?>
            <tr class='container{{ $size->id }}'>
              <td> <input type="checkbox" name="item[]"
               class="item_checkbox" value="{{ $size->id }}"> </td>
              <td>{{$size->id}}</td>
              <td>
                <?php //if(lang()=='ar'){ ?>
                  {{lang()=='ar' ? $size->name_ar : $size->name_en}}
                <?php //} ?>
              </td>
              <td> 
                {{lang()=='ar' ? $size->department_id()->first()->dep_name_ar : $size->department_id()->first()->dep_name_en}}
              </td>
              <td>{{$size->is_public}}</td>
              <td>{{$size->created_at}}</td>
              <td>{{$size->updated_at}}</td>
              <td>
                <a class='delete_btn btn btn-danger btn-sm'
                deleted='Course'
                sendId='{{$size->id}}'
                href="{{ aurl('/') }}/sizes/delete/{{$size->id}}">
                <i class='fa fa-trash'></i></a>
              </td>

              <td>
                <a class='size_edit btn btn-info btn-sm' href="/admin/sizes/{{$size->id}}/edit"><i class='fa fa-edit'></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
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

        <tfoot>
          <th></th>
          <th></th>
          <th>
            <input class='tablefilter' type="text" id=sizename_search placeholder="{{trans('admin.name')}}" />
          </th>
          <th>
            <input class='tablefilter' type="text" 
            id=sizedepartment_search 
            placeholder="{{trans('admin.name')}}" />
          </th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tfoot>
      </table>
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@push('js')
<script>

  delete_all();
  $(document).ready( function () {

    var table = all_data_Tabl();

    push_functions();

    table
    .columns( '.status' )
    .search( 'Important' )
    .draw();

    $('#sizename_search').on( 'keyup', function () {
      table.columns(2)
        .search( this.value )
        .draw();
    });

    $('#sizedepartment_search').on( 'keyup', function () {
      table.columns(3)
        .search( this.value )
        .draw();
    });


  });
</script>
@endpush


@endsection
