$(document).ready(function() {
    new WOW().init();
    savePregunta()
})

function savePregunta() {
    $('#form-preguntas').on('submit', (e) => {
        e.preventDefault()

        let nombres = $("#nombres_pregunta").val();
        let email = $("#email_pregunta").val();
        let comentario = $("#comentario_pregunta").val();

        var datos = `FUNCION=savePreguntas&nombres=${nombres}&email=${email}&comentario=${comentario}`;
        $.ajax({
            url: './process/preguntas.process.php',
            type: 'POST',
            data: datos,
            dataType: 'json',
            success: function(resp) {
                const { exito, msg } = resp

                if (exito) {

                    Swal.fire({
                        title: 'Tu pregunta fue enviada exitosamente',
                        text: msg,
                        icon: 'success',
                        confirmButtonColor: '#341054',
                        confirmButtonText: 'Aceptar'
                    })

                    $("#form-preguntas")[0].reset();

                } else {

                    Swal.fire({
                        title: 'Inconsistencia',
                        text: msg,
                        icon: 'error',
                        confirmButtonColor: '#341054',
                        confirmButtonText: 'Aceptar'
                    })

                }
            }
        })
    })
}

if ( document.getElementsByClassName('mySwiperTeams')[0] ) {
  const swiper = new Swiper(".mySwiperTeams", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}