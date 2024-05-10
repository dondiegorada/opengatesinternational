$(document).ready(function() {
    new WOW().init();
    saveCanvas()
    savePregunta()
    save();
})

function saveCanvas() {

    $('#form-canvas').on('submit', (e) => {
        e.preventDefault()

        let nombres = $("#nombres_canvas").val();
        let telefono = $("#telefono_canvas").val();
        let email = $("#email_canvas").val();
        let edad = $("#edad_canvas").val();
        let comentario = $("#comentario_canvas").val();

        var datos = `FUNCION=saveModelo&nombres=${nombres}&telefono=${telefono}&email=${email}&edad=${edad}&comentario=${comentario}`;
        $.ajax({
            url: './process/modelo.process.php',
            type: 'POST',
            data: datos,
            dataType: 'json',
            success: function(resp) {
                const { exito, msg, duplicado } = resp

                if (exito) {

                    Swal.fire({
                        title: 'Tu registro fue exitoso',
                        text: msg,
                        icon: 'success',
                        confirmButtonColor: '#FFC219',
                        confirmButtonText: 'Aceptar'
                    })

                    $("#form-canvas")[0].reset();

                } else {

                    if (duplicado) {
                        Swal.fire({
                            title: 'Registro duplicado',
                            text: msg,
                            icon: 'info',
                            confirmButtonColor: '#341054',
                            confirmButtonText: 'Aceptar'
                        })

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
            }
        })
    })
}

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

function save() {

    $('#form').on('submit', (e) => {
        e.preventDefault()

        let nombres = $("#name").val();
        let telefono = $("#phone").val();
        let email = $("#email").val();
        let edad = $("#edad").val();
        let comentario = $("#testimonio").val();

        var datos = `FUNCION=create&name=${nombres}&phone=${telefono}&email=${email}&edad=${edad}&comentario=${comentario}`;
        $.ajax({
            url: './process/customers.process.php',
            type: 'POST',
            data: datos,
            dataType: 'json',
            success: function(resp) {
                const { exito, msg, duplicado } = resp

                if (exito) {

                    Swal.fire({
                        title: 'Tu registro fue exitoso',
                        text: msg,
                        icon: 'success',
                        confirmButtonColor: '#5BC0BE',
                        confirmButtonText: 'Aceptar'
                    })

                    $("#form")[0].reset();

                } else {

                    if (duplicado) {
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