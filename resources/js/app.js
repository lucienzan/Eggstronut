// import './bootstrap';
window.$ = require('jquery');
import Swal from 'sweetalert2/dist/sweetalert2.js';


$(".show-btn").click(function(){
    $(".aside").animate({marginLeft:0});
});
$(".close-btn").click(function(){
    $(".aside").animate({marginLeft:"-100%"})
});


window.showToast = function (icon,title){
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        
        Toast.fire({
        icon: icon,
        title: title,
        })
}

window.showConfirmRole = function(id){
    Swal.fire({
        title: 'Are you sure to change the role?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change role!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Changed!',
            "Current user's role has been changed.",
            'success'
          )
          setTimeout(function(){
            $("#form"+id).submit();
          },2000)
        }
      })
}

window.banConfirmRole = function(id){
    Swal.fire({
        title: 'Are you sure to Ban the user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Banned!',
            "Current user has been Banned.",
            'success'
          )
          setTimeout(function(){
            $("#banForm"+id).submit();
          },2000)
        }
      })
}

window.unbanConfirmRole = function(id)
{
    Swal.fire({
        title: 'Are you sure to unban the user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Unbanned!',
            "Current user has been unbanned.",
            'success'
          )
          setTimeout(function(){
            $("#unbanForm"+id).submit();
          },2000)
        }
      })
}

window.showBanInfo = function(icon,title){
    Swal.fire({
        title: title,
        text: "Please contact to Admin email.",
        icon: icon,
        showConfirmButton: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#1D3461',
        cancelButtonText: 'Ok',
      })
}

// window.changeUserPw = function (id,name,token)
// {
//     console.log(token);
//     let locate = "http://127.0.0.1:8000/dashboard/profile/user-manage/change-password";
//     Swal.fire({
//         title: 'Do you want to change password for'+name+" ?",
//         input: 'password',
//         inputAttributes: {
//           autocapitalize: 'off',
//           required: "required",
//           minLength: 8,
//         },
//         showCancelButton: true,
//         confirmButtonText: 'Change',
//         showLoaderOnConfirm: true,
//         preConfirm: function (newPassword){
//             $.post(locate,{
//                 id : id,
//                 newPassword : newPassword,
//                 _token: "EkKEvIfdXtFM8fFNWM213IiDlzOY0TPGKq2cZYsx",
//             }).done(function(data){
//                 console.log(data);
//             })
//         }
//       })
// }