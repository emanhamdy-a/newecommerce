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
          <a class='country_create btn btn-info' href="/admin/countries/create">+ {{trans('admin.add')}}</i></a>
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
    {!! Form::open(['id'=>'form_data','url'=>aurl('countries/destroy/all'),'method'=>'delete']) !!}
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
                <th>{{trans('admin.currency')}}</th>
                <th>{{trans('admin.acode')}}</th>
                <th>{{trans('admin.country_flag')}}</th>
                <th>{{trans('admin.delete')}}</th>
                <th>{{trans('admin.edit')}}</th>
            </tr>
        </thead>


        <tbody>
          <?php foreach ($countries as $country) { ?>
            <tr class='container{{ $country->id }}'>
              <td> <input type="checkbox" name="item[]"
                class="item_checkbox" value="{{ $country->id }}">
              </td>
              <td>{{$country->id}}</td>
              <td>
                {{lang() === 'ar' ? $country->country_name_ar : $country->country_name_en}}
              </td>
              <td>
                {{lang() === 'ar' ? $country->currency_ar : $country->currency_en}}
              </td>
              <td>{{$country->code ?? ''}}</td>
              <td> 
                @isset($country->logo)
                  <img width='40' 
                  src="{{Storage::url('/')}}/{{$country->logo}}"/>
                @endisset
              </td>
              <td>
                <a class='delete_btn btn btn-danger btn-sm'
                deleted='Course'
                sendId='{{$country->id}}'
                href="{{ aurl('/') }}/countries/delete/{{$country->id}}">
                <i class='fa fa-trash'></i></a>
              </td>

              <td>
                <a class='country_edit btn btn-info btn-sm' href="/admin/countries/{{$country->id}}/edit"><i class='fa fa-edit'></i></a>
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
            <input class='tablefilter' type="text" id=countryname_search placeholder="{{trans('admin.name')}}" />
          </th>
          <th id='currency'>
            <input class='tablefilter' type="text" id=countrycurrency_search placeholder="{{trans('admin.currency')}}" />
          </th>
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

    $('#countryname_search').on( 'keyup', function () {
      table.columns(2)
        .search( this.value )
        .draw();
    });

    $('#countrycurrency_search').on( 'keyup', function () {
      table.columns(3)
        .search( this.value )
        .draw();
    });

  });
</script>
@endpush


@endsection
