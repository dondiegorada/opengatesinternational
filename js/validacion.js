const validaKeyword = async() => {

    const { value: password } = await Swal.fire({
        title: 'Por favor digita la palabra clave',
        input: 'password',
        inputPlaceholder: 'Digita la palabra clave aqui',
        inputAttributes: {
            maxlength: 10,
            autocapitalize: 'off',
            autocorrect: 'off'
        }
    })

    if (password) {
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch(`./process/validacion.process.php?FUNCION=validaKeyword&password=${password}`, requestOptions)
            .then(response => response.text())
            .then(result => {
                console.log(JSON.parse(result));
                const { resp, exito } = JSON.parse(result);

                if (exito) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: resp,
                        showConfirmButton: false,
                        timer: 1500
                    })

                    setTimeout(() => {
                        window.location.href = "./list/panel.php";
                    }, 1500);


                } else {
                    Swal.fire({
                        icon: 'info',
                        title: resp,
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "./";
                        }
                    })
                }
            })
            .catch(error => console.log('error', error));

    } else {
        window.location.href = "./";
    }
}

validaKeyword();