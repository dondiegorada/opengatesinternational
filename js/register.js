$( document ).ready(() => {
  setCountries();
})

// Renderizamos opciones del select para los paises
const setCountries = async () => {
  const select = document.getElementById('country');
  const countries = await getCountries();

  countries.forEach(({ _id, name }) => {
    const option = document.createElement('option');

    option.value = _id;
    option.text = name;

    select.add( option );
  });
}

// Obtenemos states despues de seleccionar un país
document.getElementById('country').addEventListener('change', async ( event ) => {
  removeOptions('state');

  const select = document.getElementById('state');
  const states = await getStates( event.target.value );
  
  states.forEach(({ _id, name }) => {
    const option = document.createElement('option');

    option.value = _id;
    option.text = name;

    select.add( option );
  });
});

// Obtenemos citie despues de seleccionar un estado o departamento
document.getElementById('state').addEventListener('change', async ( event ) => {
  removeOptions('city');

  const select = document.getElementById('city');
  const states = await getCities( event.target.value );
  
  states.forEach(({ _id, name }) => {
    const option = document.createElement('option');

    option.value = _id;
    option.text = name;

    select.add( option );
  });
});

// remove options the select
const removeOptions = ( select ) => {
  document.querySelectorAll(`#${ select } option`).forEach(option => option.remove());

  const option = document.createElement('option');

  option.selected = true;
  option.text = '[ Selecciona ]';

  document.getElementById(select).add( option );
}

// Validamos check de terminos y condiciones
document.getElementById('check-terminos').addEventListener('change', ( event ) => {
  if ( event.target.checked )
    document.getElementById('enviar').disabled = false;
  else
    document.getElementById('enviar').disabled = true;
});

document.getElementById('form').addEventListener('submit', ( event ) => {
  event.preventDefault();

  const name = document.getElementById('name').value;
  const phone = document.getElementById('phone').value;
  const mail = document.getElementById('email').value;
  const year = document.getElementById('years').value;
  const city = document.getElementById('city').value;

  const data = `FUNCION=create&name=${ name }&phone=${ phone }&email=${ mail }&year=${ year }&city=${ city }`;

  $.ajax({
    url: './process/customers.process.php',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: ( response ) => {
      const { success, message, duplicate } = response;

      if ( success ) {
        showToast('Tu registro fue exitoso', message);
        document.getElementById('form').reset();
      
      } else {
        if ( duplicate ) {
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
});