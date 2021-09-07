$(document).ready(function () {
  $('#agreecheck').click(function(){
    if($("#agreecheck").prop("checked"))
    {
      //alert($('#registBtn').prop("disabled"));
      $('#registBtn').removeAttr("disabled");

    }else
    {
      //alert($('#registBtn').attr("disabled"));
      $('#registBtn').attr('disabled',' disabled');
    }
  });
});

function qq(){
  swal.fire({
    icon: "success",
    title: '刪除成功！',
    buttonsStyling: false,
    confirmButtonText: '確認',
    customClass: {
    	confirmButton: 'btn btn-success' //insert class here
    }
  })
  return false;
}