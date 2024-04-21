$( document ).ready( function () {
  terminosCondiciones();
})

function terminosCondiciones() {
  $("#check-terminos").change(function() {
    if ($(this).is(':checked')) {
      $("#enviar").prop('disabled', false);
    } else {
      $("#enviar").prop('disabled', true);
    }
  })

  $("#check-terminos-canvas").change(function() {
    if ($(this).is(':checked')) {
      $("#enviar-canvas").prop('disabled', false);
    } else {
      $("#enviar-canvas").prop('disabled', true);
    }
  })
}

if ( document.querySelector('form') ) {
  document.querySelector('form').addEventListener('submit', async ( event ) => {
    event.preventDefault();

    const formdata = new FormData( event.target );
    formdata.append("FUNCION", "create");

    const response = await fetch('./process/customers.process.php', {
      method: 'POST',
      body: formdata,
      redirect: 'follow'
    })

    const { exito, msg, duplicado } = await response.json();

    if ( exito ) {
      Swal.fire({
        title: 'Tu registro fue exitoso',
        text: msg,
        icon: 'success',
        confirmButtonColor: '#5BC0BE',
        confirmButtonText: 'Aceptar'
      })

      $("#form")[0].reset();

    } else {
      if ( duplicado ) {
        Swal.fire({
          title: 'Registro duplicado',
          text: msg,
          icon: 'info',
          confirmButtonColor: '#5BC0BE',
          confirmButtonText: 'Aceptar'
        })

      } else {
        Swal.fire({
          title: 'Inconsistencia',
          text: msg,
          icon: 'error',
          confirmButtonText: 'Aceptar'
        })
      }
    }
  });
}