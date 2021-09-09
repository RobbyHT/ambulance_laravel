$(document).ready(function () {
  $('#agreecheck').click(function(){
    if($("#agreecheck").prop("checked")){
      $('#registBtn').removeAttr("disabled");
    }else{
      $('#registBtn').attr('disabled',' disabled');
    }
  });
  $('#c_agreecheck').click(function(){
    if($("#c_agreecheck").prop("checked")){
      $('#c_registBtn').removeAttr("disabled");
    }else{
      $('#c_registBtn').attr('disabled',' disabled');
    }
  });
});

function imgBtn(){
  $('#license_img').click();
}

function previewFile(){
  var file = $("input[name='license_img']").get(0).files[0];
  if(file){
      var reader = new FileReader();
      reader.onload = function(){
        $(".slider-image").attr("src", reader.result);
      }
      reader.readAsDataURL(file);
  }
}

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