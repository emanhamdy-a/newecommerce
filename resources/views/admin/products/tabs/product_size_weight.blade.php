@push('js')


@endpush
<div id="product_size_weight" class="tab-pane fade">
	<h3>{{ trans('admin.product_size_weight') }}</h3>
	<div class="size_weight">
		<center><h1>برجاء قم باختيار قسم</h1></center>
	</div>
	<div class="info_data hidden">
		<div class="form-group  col-md-4 col-lg-4 col-sm-4 col-xs-12">
			{!! Form::label('color_id',trans('admin.color_id')) !!}
			{!! Form::select('color_id',App\Model\Color::pluck('name_'.lang(),'id'),$product->color_id,['class'=>'form-control','placeholder'=>trans('admin.color_id')]) !!}
		</div>
		<div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
			{!! Form::label('trade_id',trans('admin.trade_id')) !!}
			{!! Form::select('trade_id',App\Model\TradeMark::pluck('name_'.lang(),'id'),$product->trade_id,['class'=>'form-control','placeholder'=>trans('admin.trade_id')]) !!}
		</div>
		<div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
			{!! Form::label('manu_id',trans('admin.manu_id')) !!}
			{!! Form::select('manu_id',App\Model\Manufactures::pluck('name_'.lang(),'id'),$product->manu_id,['class'=>'form-control','placeholder'=>trans('admin.manu_id')]) !!}
		</div>
		<div class="clearfix"></div>
	</div>
</div>
