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
