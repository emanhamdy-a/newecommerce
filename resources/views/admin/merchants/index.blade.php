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
          <a class='merchant_create btn btn-info' href="/admin/merchants/create">+ {{trans('admin.add')}}</i></a>
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
    {!! Form::open(['id'=>'form_data','url'=>aurl('merchants/destroy/all'),'method'=>'delete']) !!}
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
                <th>{{trans('admin.email')}}</th>
                <th>{{trans('admin.contact_name')}}</th>
                <th>{{trans('admin.phone')}}</th>
                <th>{{trans('admin.country')}}</th>
                <th>{{trans('admin.website')}}</th>
                <th>{{trans('admin.logo')}}</th>
                <th>{{trans('admin.address')}}</th>
                <th>{{trans('admin.facebook')}}</th>
                <th>{{trans('admin.twitter')}}</th>
                <th>{{trans('admin.created_at')}}</th>
                <th>{{trans('admin.updated_at')}}</th>
                <th>{{trans('admin.delete')}}</th>
                <th>{{trans('admin.edit')}}</th>
            </tr>
        </thead>

        <tbody>
          <?php foreach ($merchants as $merchant) { ?>
            <tr class='container{{ $merchant->id }}'>
              <td> <input type="checkbox" name="item[]" class="item_checkbox" value="{{ $merchant->id }}"> </td>
              <td>{{$merchant->id}}</td>
              <td>
                <?php //if(lang()=='ar'){ ?>
                  {{lang()=='ar' ? $merchant->name_ar : $merchant->name_en}}
                <?php //} ?>
              </td>
              <td>{{$merchant->email}}</td>
              <td>{{$merchant->contact_name}}</td>
              <td>{{$merchant->mobile}}</td>
              <td>
                {{lang()=='ar' ? $merchant->country_id()->first()->country_name_ar : $merchant->country_id()->first()->country_name_en}}
              </td>
              <td>{{$merchant->website}}</td>
              <td>
                @isset($merchant->icon)
                  <img width='40' height='40' src="{{Storage::url('/')}}/{{$merchant->icon}}"/>
                @endisset
              </td>
              <td>{{$merchant->address}}</td>
              <td>{{$merchant->facebook}}</td>
              <td>{{$merchant->twitter}}</td>
              <td>{{$merchant->created_at}}</td>
              <td>{{$merchant->updated_at}}</td>
              <td>
                <a class='delete_btn btn btn-danger btn-sm'
                deleted='Course'
                sendId='{{$merchant->id}}'
                href="{{ aurl('/') }}/merchants/delete/{{$merchant->id}}">
                <i class='fa fa-trash'></i></a>
              </td>

              <td>
                <a class='merchant_edit btn btn-info btn-sm' href="/admin/merchants/{{$merchant->id}}/edit"><i class='fa fa-edit'></i></a>
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
            <input class='tablefilter' type="text" 
            id=merchantname_search 
            placeholder="{{trans('admin.name')}}" />
          </th>
          <th>
            <input class='tablefilter' type="text" 
            id=merchantemail_search 
            placeholder="{{trans('admin.email')}}" />
          </th>
          <th>
            <input class='tablefilter' type="text" 
            id=merchantcontact_name_search 
            placeholder="{{trans('admin.contact_name')}}" />
          </th>
          <th>
            <input class='tablefilter' type="text" 
            id=merchantphone_search 
            placeholder="{{trans('admin.phone')}}" />
          </th>
          <th>
            <input class='tablefilter' type="text" 
            id=merchantcountry_search 
            placeholder="{{trans('admin.country')}}" />
          </th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
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

    $('#merchantname_search').on( 'keyup', function () {
      table.columns(2)
        .search( this.value )
        .draw();
    });
    $('#merchantemail_search').on( 'keyup', function () {
      table.columns(3)
        .search( this.value )
        .draw();
    });
    $('#merchantcontact_name_search').on( 'keyup', function () {
      table.columns(4)
        .search( this.value )
        .draw();
    });
    $('#merchantphone_search').on( 'keyup', function () {
      table.columns(5)
        .search( this.value )
        .draw();
    });
    $('#merchantcountry_search').on( 'keyup', function () {
      table.columns(6)
        .search( this.value )
        .draw();
    });

  });
</script>
@endpush


@endsection
