$(document).ready(() => {
    getNews()
})

// Funcion para obtener todas o solo una noticia
const getNews = (id = null) => {
    const requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch(`../process/news.process.php?FUNCION=getNews&id=${ id }&admin=true`, requestOptions)
        .then(response => response.json())
        .then(result => {
            const { success, data } = result

            if (!id) {
                document.getElementById('tbody').innerHTML = ''

                if (!success || !data.length) {
                    const htmlTags = `
                        <tr>
                            <td colspan="7" class="text-center">No data available in table</td>
                        </tr>
                    `;
                    $('#table tbody').append(htmlTags);

                } else {
                    renderTable(data) // Renderizamos table news
                }

            } else {
                // Llenamos formulario para actualizar noticia
                const { id, file, status, title, headline, file_content, content } = data

                document.getElementById('id').value = id
                document.getElementById('fileD').value = file
                document.getElementById('file_contentD').value = file_content
                document.getElementById('status-update').value = status
                document.getElementById('title-update').value = title
                document.getElementById('headline-update').value = headline
                document.getElementById('content-update').value = content
            }
        })
        .catch(error => console.log('error', error));
}

// Funcion de sobrescritura para title de card
const titleText = (input, div) => {
    if (document.getElementById(input).value) {
        document.getElementById(div).innerText = document.getElementById(input).value
    } else {
        document.getElementById(div).innerText = 'Title of the news'
    }
}

// Funcion de sobrescritura para headline de card
const headlineText = (input, div) => {
    if (document.getElementById(input).value) {
        document.getElementById(div).innerText = document.getElementById(input).value
    } else {
        document.getElementById(div).innerText = "Here*s a longer description with supporting text below as a natural introduction to the additional content."
    }
}

// Funcion para crear noticias
document.getElementById('form').onsubmit = (e) => {
    e.preventDefault();

    const formData = new FormData($('#form')[0]);
    formData.append("FUNCION", "setNews");

    const requestOptions = {
        method: 'POST',
        body: formData,
        redirect: 'follow'
    };

    fetch("../process/news.process.php", requestOptions)
        .then(response => response.json())
        .then(result => {
            const { success, msg } = result

            if (success) {
                alertSuccess(msg, 4000)
                document.getElementById('form').reset();
                document.getElementById('img-create').src = 'https://cdn.pixabay.com/photo/2017/09/10/18/25/question-2736480_960_720.jpg'

                getNews() // Actualiza la table
                titleText('title', 'text_title')
                headlineText('headline', 'text_headline')

            } else {
                alertInfo(msg)
            }
        })
        .catch(error => console.log('error', error));
}

// Funcion para actualizar noticias
document.getElementById('form-update').onsubmit = (e) => {
    e.preventDefault();

    const formData = new FormData($('#form-update')[0]);
    formData.append("FUNCION", "updateNews");

    const requestOptions = {
        method: 'POST',
        body: formData,
        redirect: 'follow'
    };

    fetch("../process/news.process.php", requestOptions)
        .then(response => response.json())
        .then(result => {
            const { success, msg } = result

            if (success) {
                alertSuccess(msg, 4000);
                titleText('title-update', 'text_title-update')
                headlineText('headline-update', 'text_headline-update')

                setTimeout(() => {
                    hideFormUpdate() // oculta el formulario de registro
                }, 3000);

            } else {
                alertInfo(msg)
            }
        })
        .catch(error => console.log('error', error));
}

// Renderizamos tabla de noticias
const renderTable = (data) => {
    for (let i = 0; i < data.length; i++) {
        const { id, file, title, headline, status, file_content } = data[i];
        if (status === 'Activo') { var badge = 'bg-success' } else { var badge = 'bg-danger' }

        const html = `
            <tr style="border-bottom: 1px solid #E1E1E1;">
                <td style="display: flex; border: 0px;">
                    <a href="javascript:showFormUpdate(${ id }, '${ file }')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil-fill text-success m-1" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                    </a>
                    <a href="javascript:deleteNews(${ id }, '${ file }', '${ file_content }')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3-fill text-danger m-1" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </a>
                </td>

                <th scope="row">${ id }</th>
                <td><a href="../media/img/news/${ file }" target="_blank">${ file }</a></td>
                <td>${ title }</td>
                <td>${ headline }</td>
                <td>
                    <a href="javascript:showContent(${ id })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-up-right text-primary" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                        </svg>
                    </a>
                </td>

                <th scope="row"><span class="badge rounded-pill ${ badge }" style="font-size: 100%;">${ status }</span></th>
            </tr>
        `
        $('#tbody').append(html)
    }
}

// Funcion para eliminar noticias
const deleteNews = (id, file, file_content) => {
    Swal.fire({
        title: `You're sure?`,
        showDenyButton: true,
        confirmButtonText: `Delete`,
        denyButtonText: `I'm not sure`,

    }).then((result) => {
        const formData = new FormData();
        formData.append("FUNCION", "deleteNews");
        formData.append("id", id);
        formData.append("file", file);
        formData.append("file_content", file_content);

        const requestOptions = {
            method: 'POST',
            body: formData,
            redirect: 'follow'
        };

        fetch("../process/news.process.php", requestOptions)
            .then(response => response.json())
            .then(result => {
                const { success, msg } = result

                if (success) {
                    alertSuccess(msg, 4000)
                    getNews()

                } else {
                    alertInfo(msg)
                }
            })
            .catch(error => console.log('error', error));

    })
}

// Funcion para mostrar img en card
const imgPrevius = (id, input) => {
    $(`#${ id }`)[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0])
}

// Funcion para mostrar seccion de actualizar noticias
const showFormUpdate = (id, file) => {
    getNews(id) // Obtenemos datos segun ID de la noticia

    document.getElementById('nav-update').style.display = 'block'
    document.getElementById('img-update').src = `../media/imagenes/news/${ file }`

    $('#nav-update > a').addClass('active')
    $('#update').addClass('active show')

    $('#profile-tab').removeClass('active')
    $('#list').removeClass('active show')
}

// Funcion para ocultar seccion de actualizar noticias
const hideFormUpdate = () => {
    getNews() // Actualizamos table news

    document.getElementById('nav-update').style.display = 'none'
    document.getElementById('form-update').reset();

    $('#nav-update > a').removeClass('active')
    $('#update').removeClass('active show')

    $('#nav-list > a').addClass('active')
    $('#list').addClass('active show')
}

// Funcion para mostrar modal con el contenido de la noticia
const showContent = (id) => {
    if (id) {
        const requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };
    
        fetch(`../process/news.process.php?FUNCION=getNews&id=${ id }`, requestOptions)
            .then(response => response.json())
            .then(result => {
                const { success, data } = result
    
                if (success) {
                    const { title, content } = data;

                    $('.card-content > h3').text(title) // Insertamos title
                    $('.card-content > p').html(content) // Insertamos content

                    $('.bd-example-modal-lg').modal('show') // Abrimos modal
                }
            })
            .catch(error => console.log('error', error));

    } else {
        if (document.getElementById('title').value && document.getElementById('content').value && document.getElementById('file_content').files[0]) {
            $('#img-content')[0].src = (window.URL ? URL : webkitURL).createObjectURL(document.getElementById('file_content').files[0]) // Insertamos img
            $('.card-content > h3').text(document.getElementById('title').value) // Insertamos title
            $('.card-content > p').html(document.getElementById('content').value) // Insertamos content
            $('.bd-example-modal-lg').modal('show') // Abrimos modal

            document.getElementById('valida-demo').innerText = '' // Limpiamos text de validacion

        } else {
            document.getElementById('valida-demo').innerText = 'Para ver demo los campos titulo de la noticia, imagen de contenido y contenido de la noticia deben ser obligatorios *'
        }
    }
}