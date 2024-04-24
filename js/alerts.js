const showToast = (message) => {
  const toastLive = document.getElementById('liveToast');
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
  
  const toastBody = document.getElementsByClassName('toast-body')[0];
  toastBody.innerText = message;

  toastBootstrap.show();
}

const alertSuccess = (msg, timer) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: msg
    })
}