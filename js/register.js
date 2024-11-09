document.addEventListener("DOMContentLoaded", async () => {
  setCountries();
  setTiposVisa();

  const selectTipoVisa = document.getElementById('tipo_visa');
  selectTipoVisa.style.display = 'none';
});

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

const setTiposVisa = async () => {
  const select = document.getElementById('tipo_visa');
  const tipos_visa = await getTiposVisa();

  tipos_visa.forEach(({ _id, name }) => {
    const option = document.createElement('option');

    option.value = _id;
    option.text = name;

    select.add( option );
  });
}

const fixStepIndicator = (n) => {
  // This function removes the "active" class of all steps...
  let i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

let currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").disabled = true;
    document.getElementById("nextBtn").innerHTML = "Submit";
    document.getElementById("nextBtn").type = "Submit";

  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

const nextPrev = (n) => {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    return false;
  }

  // Otherwise, display the correct tab:
  showTab(currentTab);
}

const validateForm = () => {
  // This function deals with validation of the form fields
  let tab, input, valid = true;
  tab = document.getElementsByClassName("tab");
  input = tab[currentTab].getElementsByTagName("input");

  if ( input.length == 0 ) input = tab[currentTab].getElementsByTagName("select");

  // A loop that checks every input field in the current tab:
  for (let i = 0; i < input.length; i++) {
    // If a field is empty...
    if (input[i].value == "") {
      // and set the current valid status to false
      valid = false;
    }
  }

  // If the valid status is true, mark the step as finished and valid:
  if ( valid ) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }

  return valid; // return the valid status
}

// remove options the select
const removeOptions = ( select ) => {
  document.querySelectorAll(`#${ select } option`).forEach(option => option.remove());

  const option = document.createElement('option');

  option.selected = true;
  if ( select == 'state' ) option.text = 'Selecciona un departamento';
  if ( select == 'city' ) option.text = 'Selecciona una ciudad';

  document.getElementById(select).add( option );
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

// Obtenemos city despues de seleccionar un estado o departamento
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

// Validamos check de terminos y condiciones
document.getElementById('check-terminos').addEventListener('change', ( event ) => {
  if ( event.target.checked )
    document.getElementById('nextBtn').disabled = false;
  else
    document.getElementById('nextBtn').disabled = true;
});

document.getElementById('check_pasaporte').addEventListener('change', ( event ) => {
  const selectTipoVisa = document.getElementById('tipo_visa');

  if ( event.target.checked ){
    selectTipoVisa.style.display = 'none';
    selectTipoVisa.value = ''; 
  }
});

document.getElementById('check_viajar_eur').addEventListener('change', ( event ) => {
  const selectTipoVisa = document.getElementById('tipo_visa');

  if ( event.target.checked ){
    selectTipoVisa.style.display = 'none';
    selectTipoVisa.value = ''; 
  }
});

document.getElementById('check_visa').addEventListener('change', ( event ) => {
  const selectTipoVisa = document.getElementById('tipo_visa');

  if ( event.target.checked ){
    selectTipoVisa.style.display = 'block';
  }
});

if ( document.querySelector('form') ) {
  document.querySelector('form').addEventListener('submit', async ( event ) => {
    event.preventDefault();

    const radioButtons = document.getElementsByName('check_option');
    let selectedOption = null;

    for (const radio of radioButtons) {
      if (radio.checked) {
        selectedOption = radio.value;
        break;
      }
    }

    const finishContent = document.getElementById('finish-content');
    finishContent.innerText = 'Gracias por dejar tus datos, espera unos segundos...';

    // Ocultamos Buttons Steps
    document.getElementById('steps-buttons').className = 'd-none';

    const formdata = new FormData( event.target );
    formdata.append("FUNCION", "create");

    if (selectedOption) {
      formdata.append("interes", selectedOption);
    }

    const response = await fetch('./process/customers.process.php', {
      method: 'POST',
      body: formdata,
      redirect: 'follow'
    })

    const { success, message } = await response.json();

      if ( success ) {
        finishContent.innerText = message;
        document.getElementById('form').reset();
      
      } else {
        finishContent.innerText = message;
      }
  });
}