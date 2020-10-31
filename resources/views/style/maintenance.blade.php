@extends('style.index')
@section('content')
<div class="maincontent-area">
  <div class="zigzag-bottom"></div>
  <div class="container">
    <div class="row text-center">
      <h3 class='alert alert-danger' style='padding:75px;'> {{ setting()->message_maintenance }}</h3>
    </div>
  </div>
</div>
@endsection
