// import './bootstrap';
import Swal from 'sweetalert2/dist/sweetalert2.js'


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