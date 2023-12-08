const seleccionar = (_id) => {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch(`../process/customers.process.php?FUNCION=seleccionarModelo&_id=${ _id }`, requestOptions)
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

const declinar = (_id) => {
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch(`../process/customers.process.php?FUNCION=declinar&_id=${ _id }`, requestOptions)
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