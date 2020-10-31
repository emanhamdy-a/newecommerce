@push('js')
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"> -->
  <link rel="stylesheet" href="{{ asset('/design/Adminlte/dropzone/dropzone.min.css') }}">
  <script src="{{ url('/') }}/design/Adminlte/dropzone/dropzone.min.js"></script>

  <script type="text/javascript">
  Dropzone.autoDiscover = false;
  $(document).ready(function(){

  $('#dropzonefileupload').dropzone({
    url:"{{ aurl('upload/image/'.$product->id) }}",
    // paramName:'files[]',
    paramName:'file',
    autoDiscover:false,
    // uploadMultiple:true,
    uploadMultiple:false,
    maxFiles:15,
    maxFilessize:3, // MB
    acceptedFiles:'image/*',
    dictDefaultMessage:'اضغط هنا لرفع الملفات او قم بسحب الملفات  وافلاتها هنا',
    dictRemoveFile:"{{ trans('admin.delete') }}",
    params:{
      _token:'{{ csrf_token() }}'
    },
    addRemoveLinks:true,
    removedfile:function(file)
    {
      //file.fid
      if (confirm('Are you sure you want to delete this image ?')) {
        $.ajax({
          dataType:'json',
          type:'post',
          url:"{{ aurl('delete/image') }}",
          data:{_token:'{{ csrf_token() }}',id:file.fid},
        error: function(jqXHR, textStatus, errorThrown) {
          // console.log(jqXHR);
        },
        });
      var fmock;
      return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
    }
    },
    init:function(){
      // foreach($product->files  as $file)
      @if($product->files()->get())
      @foreach($product->files()->get() as $file)
      var mock = {name: '{{ $file->name }}',fid: '{{ $file->id }}',size: '{{ $file->size }}',type: '{{ $file->mime_type }}' };
      this.emit('addedfile',mock);
      this.options.thumbnail.call(this,mock,"{{ url('storage/'.$file->full_file) }}");
      @endforeach
      @endif
      this.on('sending',function(file,xhr,formData){
        formData.append('fid','');
        file.fid = '';
      });

      this.on('success',function(file,response){
        file.fid = response.id;
      });


    }
  });


  $('#mainphoto').dropzone({
    url:"{{ aurl('update/image/'.$product->id) }}",
    paramName:'file',
    autoDiscover:false,
    uploadMultiple:false,
    maxFiles:1,
    maxFilessize:3, // MB
    acceptedFiles:'image/*',
    dictDefaultMessage:'{{ trans('admin.mainphoto') }}',
    dictRemoveFile:'{{ trans('admin.delete') }}',
    params:{
      _token:'{{ csrf_token() }}'
    },
    addRemoveLinks:true,
    removedfile:function(file)
    {
      if (confirm('Are you sure you want to delete this image ?')) {
        //file.fid
        $.ajax({
          dataType:'json',
          type:'post',
          url:"{{ aurl('delete/product/image/'.$product->id) }}",
          data:{_token:'{{ csrf_token() }}'}
        });
       var fmock;
       return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
      }
    },
    init:function(){

      @if(!empty($product->photo))
      var mock = {name: '{{ $product->title }}',size: '',type: '' };
      this.emit('addedfile',mock);
      this.options.thumbnail.call(this,mock,"{{ url('storage/'.$product->photo) }}");
      $('.dz-progress').remove();
      @endif

      this.on('sending',function(file,xhr,formData){
        formData.append('fid','');
        file.fid = '';
      });

      this.on('success',function(file,response){
        file.fid = response.id;
      });
    }
  });
  });
  </script>
  <style type="text/css">
  .dz-image img {
    width:100px;
    height:100px;
  }
  </style>
@endpush

<div id="product_media" class="tab-pane fade">
	<h3>{{ trans('admin.product_media') }}</h3>

	<hr />

	<center><h3>{{ trans('admin.mainphoto') }}</h3></center>
	<div class="dropzone" id="mainphoto"></div>
	<hr />
	<center><h3>{{ trans('admin.other_files') }}</h3></center>
	<div class="dropzone" id="dropzonefileupload"></div>
</div>
