function check_all() {
  //item_checkbox
  $('input[class="item_checkbox"]:checkbox').each(function(){
    if($('input[class="check_all"]:checkbox:checked').length == 0)
    {
    $(this).prop('checked',false);
    }else{
    $(this).prop('checked',true);
    }
  });
}

function delete_all(){
  $(document).on('click','.delBtn',function(){
    var item_cheked=$('input[class="item_checkbox"]:checkbox:checked').length;
    if(item_cheked > 0){
      $('.not_empty_record').removeClass('hidden');
      $('.record_count').text(item_cheked);
      $('.empty_record').addClass('hidden');
    }else{
      $('.empty_record').removeClass('hidden');
      $('.not_empty_record').addClass('hidden');
    }
    $('#mutlipleDelete').modal('show');
  });
}

function all_data_Tabl() {
  if ($('#langug').val() == 'ar') {
    var table=$('#datatable').DataTable( {
      dom: 'lfBirtp',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print',
      ],
      "processing": true,
      "language": {
        "search": 'بحث : ',
        "lengthMenu": "اظهار _MENU_ صف",
        "paginate": {
          "first": "الاول",
          "last": "الاخير",
          "next": "التالي",
          "previous": "السابق"
        },
        "buttons": {
            "copy": "نسخ",
            "print":"طباعه",
            // "csv": "",
            // "excel": "",
            // "pdf": "",
        },
        "processing": "تحميل ...",
        "search": "بحث : ",
        "searchPlaceholder": "بحث شامل",
        "zeroRecords": "لا توجد صفوف",
        "emptyTable": "لا توجد بيانات .",
        "decimal": ",",
        "thousands": ".",
        "info": "أظهار _START_ الي _END_ من _TOTAL_ صف",
        "infoEmpty": "لا توجد اي صفوف",
      },
    } );
    return table;
  }else{
    var table=$('#datatable').DataTable( {
      dom: 'lfBirtp',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print',
      ],
      "processing": true,
      // scrollY:  600,
      // scrollX:  1800,
      // deferRender: true,
      // scroller:     true
      // paging: false
    } );
  }
}

function push_functions() {
  $('.reset_button').on('click', function () {
    $('.tablefilterselect').each(function(i, obj) {
    if($(obj).val() != ''){
      $(obj).prop('selectedIndex',0);
      $(obj).change();
    }
    });

    $('.tablefilter').each(function(i, obj) {
    if($(obj).val() != ''){
      $(obj).val('');
      $(obj).keyup();
    }
    });

    if($('#datatable_filter input').val('')!=''){
      $('#datatable_filter input').val('');
      $('#datatable_filter input').keyup();
    }
    $('input').filter(':checkbox').prop('checked',false);
  });

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
}
