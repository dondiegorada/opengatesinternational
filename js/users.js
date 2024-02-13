$( document ).ready( function () {
  terminosCondiciones();
  getAll();
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

const getAll = async () => {
  const response = await fetch(`../process/customers.process.php?FUNCION=getAll&status=P`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { data } = await response.json();

  renderRow(data);
}

const search = async ( event ) => {
  if ( event.value.length > 1 ) {
    const response = await fetch(`../process/customers.process.php?FUNCION=search&search=${ event.value }`, {
      method: 'GET',
      redirect: 'follow'
    });

    const { data } = await response.json();

    renderRow( data );
  
  } else {
    getAll();
  }
}

const renderRow = ( data ) => {
  document.getElementById('tbody').innerHTML = '';
  
  if (  data.length > 0 ) {
    for ( let i = 0; i < data.length; i++ ) {
      const { _id, nombres, telefono, email, edad, comentario, estado, fecha_registro } = data[i];

      const html = `
        <tr>
          <td>${ nombres }</td>
          <td>${ telefono }</td>
          <td>${ email }</td>
          <td>${ edad }</td>
          <td>${ comentario }</td>
          <td><span class="badge bg-danger">${ estado }</span></td>
          <td>${ fecha_registro }</td>
          <td>
            <button type="button" class="btn" onclick="seleccionar(${ _id })">
              <img src="../media/img/comprobado.svg" height="30" alt="aprobar" />
            </button>
          </td>
          <td>
            <button type="button" class="btn" onclick="declinar(${ _id })">
              <img src="../media/img/cerrar.svg" height="30" alt="declinar" />
            </button>
          </td>
        </tr>
      `;

      $('#tbody').append( html );
    }
  
  } else {
    const html = `
      <tr>
        <td colspan="9" class="text-center">
          No hay personas registradas en este momento...
        </td>
      </tr>
    `;

    $('#tbody').append( html );
  }
}