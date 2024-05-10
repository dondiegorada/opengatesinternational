$(document).ready(() => {
  setCountries();
})

// Validamos check de terminos y condiciones
document.getElementById('check-terminos').addEventListener('change', ( event ) => {
  if ( event.target.checked )
    document.getElementById('enviar').disabled = false;
  else
    document.getElementById('enviar').disabled = true;
});

// Renderizamos opciones del select para los paises
const setCountries = async () => {
  const select = document.getElementById('country');
  const countries = await getCountries();
  
  countries.forEach(({ country_name, country_phone_code }) => {
    const option = document.createElement('option');

    option.value = country_name;
    option.text = country_name;

    select.add(option);
  });
}

document.getElementById('form').addEventListener('submit', ( event ) => {
  event.preventDefault();

  const name = document.getElementById('name').value;
  const phone = document.getElementById('phone').value;
  const mail = document.getElementById('email').value;
  const year = document.getElementById('years').value;
  const country = document.getElementById('country').value;

  const data = `FUNCION=create&name=${ name }&phone=${ phone }&email=${ mail }&year=${ year }&country=${ country }`;
  
  $.ajax({
    url: './process/customers.process.php',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: ( response ) => {
      const { success, message, duplicate } = response;

      if ( success ) {
        showToast(message);
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