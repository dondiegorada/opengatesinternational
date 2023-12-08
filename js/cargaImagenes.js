const actualizarImagenes = (form, banner_seccion_id) => {

    var formdata = new FormData(form);
    formdata.append("FUNCION", "updateImagen");
    formdata.append("banner_seccion_id", banner_seccion_id);

    var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    fetch("../process/cargaImagenes.process.php", requestOptions)
        .then(response => response.text())
        .then(result => {

            const { msg: resp, exito } = JSON.parse(result);

            if (exito) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: resp,
                    showConfirmButton: false,
                    timer: 2500
                })

                form.reset();

                setTimeout(() => {
                    location.reload();
                }, 2500);
            }
        })
}


const cargarImagenes = () => {
    document.getElementById('formImgs').addEventListener("submit", (e) => {
        e.preventDefault();

        const form = document.getElementById('formImgs');

        var formdata = new FormData(form);
        formdata.append("FUNCION", "upload");

        var requestOptions = {
            method: 'POST',
            body: formdata,
            redirect: 'follow'
        };

        fetch("../process/cargaImagenes.process.php", requestOptions)
            .then(response => response.text())
            .then(result => {

                const { msg, exito, reemplazo, banner_seccion_id } = JSON.parse(result);

                if (exito) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: msg,
                        showConfirmButton: false,
                        timer: 2500
                    })

                    form.reset();

                    setTimeout(() => {
                        location.reload();
                    }, 2500);

                } else if (reemplazo) {
                    Swal.fire({
                        title: 'Reemplazar imagen',
                        text: msg,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#FFC219',
                        cancelButtonColor: '#110E0C',
                        confirmButtonText: 'Si, reemplazar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            actualizarImagenes(form, banner_seccion_id);
                        }
                    })
                } else {
                    Swal.fire('Atención', msg, 'warning');

                }

            })
            .catch(error => console.log('error', error));

    });
}

const deleteImages = (banner_seccion_id) => {

    Swal.fire({
        title: 'Eliminar',
        text: 'Estas seguro ?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#FFC219',
        cancelButtonColor: '#110E0C',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch(`../process/cargaImagenes.process.php?FUNCION=deleteImagen&banner_seccion_id=${banner_seccion_id}`, requestOptions)
                .then(response => response.text())
                .then(result => {

                    const { msg, exito } = JSON.parse(result);

                    if (exito) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: msg,
                            showConfirmButton: false,
                            timer: 2500
                        })

                        setTimeout(() => {
                            location.reload();
                        }, 2500);

                    } else {
                        Swal.fire('Atención', msg, 'warning');
                    }
                })
        }
    })

}

cargarImagenes();