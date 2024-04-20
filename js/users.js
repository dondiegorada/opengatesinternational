const registers = [];

$( document ).ready( function () {
  terminosCondiciones();
  
  if ( document.getElementsByClassName('tbody') )
    ['P', 'A', 'R'].forEach(( value, index ) => getAll( value, index ));
})

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
      const { msg, exito } = JSON.parse( result );

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

const getAll = async ( status, index ) => {
  const response = await fetch(`../process/customers.process.php?FUNCION=getAll&status=${ status }`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { data } = await response.json();

  renderRow( data, index );
}

const search = async ( event ) => {
  const param = event.parentNode.className.split(' ')[1];

  if ( event.value.length > 1 ) {
    let status;
    let index;

    switch ( param ) {
      case 'pending':
        index = 0;
        status = 'P';
        break;

      case 'approved':
        index = 1;
        status = 'A';
        break;
    
      default:
        index = 1;
        status = 'R';
        break;
    }

    const response = await fetch(`../process/customers.process.php?FUNCION=search&search=${ event.value }&status=${ status }`, {
      method: 'GET',
      redirect: 'follow'
    });

    const { data } = await response.json();

    renderRow( data, index );
  
  } else {
    ['P', 'A', 'R'].forEach(( value, index ) => getAll( value, index ));
  }
}

const renderRow = ( data, index ) => {
  document.getElementsByClassName('tbody')[index].innerHTML = '';
  document.getElementsByClassName('count-registers')[index].innerHTML = `<strong>Registros: ${ data.length }</strong>`;

  const rows = 30;

  const dataPagination = {
    page: 1, // Página actual
    pages: Math.ceil(data.length / rows), // Número total de páginas
    rows // Cantidad de elementos por página
  }

  const customers = showPage( dataPagination, data );
  
  if ( data.length > 0 ) {
    for ( let i = 0; i < customers.length; i++ ) {
      const { _id, nombres, telefono, email, edad, comentario, estado, fecha_registro } = customers[i];
      let badge;

      if ( estado == 'Pendiente' ) badge = 'bg-secondary';
      if ( estado == 'Aprobado' ) badge = 'bg-success';
      if ( estado == 'Rechazado' ) badge = 'bg-danger';

      const btnAprobar = `
        <td>
          <button type="button" class="btn" onclick="seleccionar(${ _id })">
            <img src="../media/img/comprobado.svg" height="30" alt="aprobar" />
          </button>
        </td>
      `;

      const btnDeclinar = `
        <td>
          <button type="button" class="btn" onclick="declinar(${ _id })">
            <img src="../media/img/cerrar.svg" height="30" alt="declinar" />
          </button>
        </td>
      `;

      const html = `
        <tr>
          <td>${ nombres }</td>
          <td>${ telefono }</td>
          <td>${ email }</td>
          <td>${ edad }</td>
          <td>${ comentario }</td>
          <td><span class="badge ${ badge }">${ estado }</span></td>
          <td>${ fecha_registro }</td>
          ${ ( estado == 'Pendiente' ) ? btnAprobar + btnDeclinar : '' }
          ${ ( estado == 'Aprobado' ) ? btnDeclinar : '' }
          ${ ( estado == 'Rechazado' ) ? btnAprobar : '' }
        </tr>
      `;

      document.getElementsByClassName('tbody')[index].innerHTML += html;
    }

    // pagination(dataPagination);
  
  } else {
    const html = `
      <tr>
        <td colspan="9" class="text-center">
          No hay personas registradas en este momento...
        </td>
      </tr>
    `;

    document.getElementsByClassName('tbody')[index].innerHTML = html;
  }
}

const showPage = ({ page, rows }, data) => {
  const indiceInicial = (page - 1) * rows;
  const indiceFinal = indiceInicial + rows;

  const customers = data.slice(indiceInicial, indiceFinal);

  return customers;
}

const pagination = ({ page, pages }) => {
  const botonesVisibles = 5; // Cantidad de botones visibles
  const paginaInicio = Math.max(1, page - Math.floor(botonesVisibles / 2));
  const paginaFin = Math.min(pages, page + Math.floor(botonesVisibles / 2));

  const pagination = document.getElementsByClassName('pagination')[0];

  // Crea los botones HTML y agrega eventos de clic
  for (let pagina = paginaInicio; pagina <= paginaFin; pagina++) {
    const li = document.createElement('li');
    li.className = 'page-item';
    li.innerHTML = `<a class="page-link" href="javascript:showPage(${ {page, pages} })">${ pagina }</a>`

    pagination.insertBefore(li, pagination.getElementsByTagName('li')[pagina]);
  }
}