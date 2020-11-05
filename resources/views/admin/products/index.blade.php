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
          <a class='product_create btn btn-info' href="/admin/products/create">+ {{trans('admin.add')}}</i></a>
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
        <td>
          <select id='productdeprtment_id_search'
            class='m-y tablefilterselect'>
              <option value=''>
                -- {{trans('admin.department')}}--
              </option>
              @if(lang()=='ar')
                {{$countries=App\Model\Department::orderBy('dep_name_ar')->pluck('dep_name_ar')}}
              @else
                {{$countries=App\Model\Country::orderBy('dep_name_en')->pluck('dep_name_en')}}
              @endif
              @foreach($countries as $country)
              <option
                value="{{$country}}">
                {{$country}}
              </option>
              @endforeach
          </select>
        </td>
        <td>
          <select id='productstatussearch'
            class='m-y tablefilterselect'>
              <option value=''>-- {{trans('admin.status')}}--</option>
              <option value='active'>active</option>
              <option value='pending'>pending</option>
              <option value='refused'>refused</option>
          </select>
        </td>
        <td>
          <select id='productoffer_search'
            class='m-y tablefilterselect'>
              <option value=''>
              -- {{trans('admin.end_offer')}}--</option>
              <option value="{{trans('admin.vaild')}}">
                {{trans('admin.vaild')}}
              </option>
              <option value="{{trans('admin.expired')}}">
                {{trans('admin.expired')}}
              </option>
          </select>
        </td>
        <td>
          <select id='productexpiry_search'
            class='m-y tablefilterselect'>
              <option value=''>
                -- {{trans('admin.product_vaild')}}--
              </option>
              <option value="{{trans('admin.vaild')}}">
                {{trans('admin.vaild')}}
              </option>
              <option value="{{trans('admin.expired')}}">
                {{trans('admin.expired')}}
              </option>
          </select>
        </td>
        <td>
          <select id='producttradmark_search'
            class='m-y tablefilterselect'>
              <option value=''>
                -- {{trans('admin.trade_id')}}--
              </option>
              @if(lang()=='ar')
                {{$trademarks=App\Model\TradeMark::orderBy('name_ar')->pluck('name_ar')}}
              @else
                {{$trademarks=App\Model\TradeMark::orderBy('name_en')->pluck('name_en')}}
              @endif
              @foreach($trademarks as $trademark)
              <option
                value="{{$trademark}}">
                {{$trademark}}
              </option>
              @endforeach
          </select>
        </td>
      </tr>
    </table>
      <br>
    {!! Form::open(['id'=>'form_data','url'=>aurl('products/destroy/all'),'method'=>'delete']) !!}
      <table id="datatable" style='width:100% !important;'
        class="display responsive nowrap">
        <thead>
            <tr>
                <th>
                  <input type="checkbox"
                  class="check_all" onclick="check_all()">
                </th>
                <th>id</th>
                <th>{{trans('admin.title')}}</th>
                <th>{{trans('admin.department')}}</th>
                <th>{{trans('admin.status')}}</th>
                <th>{{trans('admin.end_offer')}}</th>
                <th>{{trans('admin.product_vaild')}}</th>
                <th>{{trans('admin.trade_id')}}</th>
                <th>{{trans('admin.price')}}</th>
                <th>{{trans('admin.manu_id')}}</th>
                <th>{{trans('admin.color_id')}}</th>
                <th>{{trans('admin.size')}}</th>
                <th>{{trans('admin.created_at')}}</th>
                <th>{{trans('admin.updated_at')}}</th>
                <th>{{trans('admin.photo')}}</th>
                <th>{{trans('admin.content')}}</th>
                <th>{{trans('admin.delete')}}</th>
                <th>{{trans('admin.edit')}}</th>
            </tr>
        </thead>

        <tbody>
          <?php foreach ($products as $product) { ?>
            <tr class='container{{ $product->id }}'>
              <td> <input type="checkbox" name="item[]" class="item_checkbox" value="{{ $product->id }}"> </td>
              <td>{{$product->id}}</td>
              <td>
                <?php //if(lang()=='ar'){ ?>
                  {{$product->title ?? ''}}
                <?php //} ?>
              </td>
              <td>
                {{$product->department_id ? $product->department_id() :''}}
              </td>
              <td>{{$product->status ?? ''}}</td>
              <td>{{$product->offer($product->end_at)}}</td>
              <td>{{$product->expired($product->end_at)}}</td>
              <td>
                {{$product->trade_id ? $product->trade_id():''}}
              </td>
              <td>{{$product->price ?? ''}}</td>
              <td>
                {{$product->manu_id ? $product->manu_id():''}}
              </td>
              <td>
                {{$product->color_id ? $product->color_id():''}}
              </td>
              <td>{{$product->size ?? ''}}</td>
              <td>{{$product->created_at ?? ''}}</td>
              <td>{{$product->updated_at ?? ''}}</td>
              <td>
                @isset($product->photo)
                  <img width='150' height='150' src="{{Storage::url('/')}}/{{$product->photo ?? ''}}"/>
                @endisset
              </td>
              <td>{{$product->content ?? ''}}</td>
              <td>
                <a class='delete_btn btn btn-danger btn-sm'
                deleted='Course'
                sendId='{{$product->id}}'
                href="{{ aurl('/') }}/products/delete/{{$product->id}}">
                <i class='fa fa-trash'></i></a>
              </td>

              <td>
                <a class='product_edit btn btn-info btn-sm' href="/admin/products/{{$product->id}}/edit"><i class='fa fa-edit'></i></a>
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
            id='productname_search'
            placeholder="{{trans('admin.title')}}" />
          </th>
          <th>

          </th>
          <th>

          </th>
          <th>

          </th>
          <th>

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

    $('#productname_search').on( 'keyup', function () {
      table.columns(2)
        .search( this.value )
        .draw();
    });
    $('#productdeprtment_id_search').on( 'change', function () {
      table.columns(3)
        .search( this.value )
        .draw();
    });
    $('#productstatussearch').on( 'change', function () {
      table.columns(4)
        .search( this.value )
        .draw();
    });

    $('#productoffer_search').on( 'change', function () {
      table.columns(5)
        .search( this.value )
        .draw();
    });
    $('#productexpiry_search').on( 'change', function () {
      table.columns(6)
        .search( this.value )
        .draw();
    });
    // $('#productcountry_search').on( 'change', function () {
    //   table.columns(7)
    //     .search( this.value )
    //     .draw();
    // });
    $('#producttradmark_search').on( 'change', function () {
      table.columns(7)
        .search( this.value )
        .draw();
    });
  });
</script>
@endpush


@endsection
