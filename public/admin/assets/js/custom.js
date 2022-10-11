$(document).ready(function () {
    $("#current_password").keyup(function () {
       var current_password = $("#current_password").val();

         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             type: "POST",
             url:'/admin/check-current-password',
             data: {current_password:current_password},
             success: function (response) {
                 console.log(response);
                 if(response== 1){
                     $("#chkCurrentPassword").html("<font color='green'>Current Password is correct</font>");
                 }else{
                     $("#chkCurrentPassword").html("<font color='red'>Current Password is incorrect</font>");
                 }
             },error: function (xhr, status, error) {
                 alert('err')
             }
         });

    });
})
