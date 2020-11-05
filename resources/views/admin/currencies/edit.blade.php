@extends('admin.index')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('currencies/'.$currency->id),'method'=>'put' ]) !!}
    <div class="form-group">
      {!! Form::label('currency_name_ar',trans('admin.currency_name_ar')) !!}
      {!! Form::text('currency_name_ar',$currency->currency_name_ar,['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
      {!! Form::label('currency_name_en',trans('admin.currency_name_en')) !!}
      {!! Form::text('currency_name_en',$currency->currency_name_en,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('currency_code',trans('admin.currency_code')) !!}
      {!! Form::text('currency_code',$currency->currency_code,['class'=>'form-control']) !!}
    </div>


    {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
