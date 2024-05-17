$( document ).ready(() => {
  setCountries();
})

const fixStepIndicator = (n) => {
  // This function removes the "active" class of all steps...
  let i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

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
  if ( select == 'state' ) option.text = 'Selecciona un departamento';
  if ( select == 'city' ) option.text = 'Selecciona una ciudad';

  document.getElementById(select).add( option );
}

// Validamos check de terminos y condiciones
document.getElementById('check-terminos').addEventListener('change', ( event ) => {
  if ( event.target.checked )
    document.getElementById('nextBtn').disabled = false;
  else
    document.getElementById('nextBtn').disabled = true;
});

const submitForm = () => {
  const finishContent = document.getElementById('finish-content');
  finishContent.innerText = 'Gracias por dejar tus datos, espera unos segundos...';

  // Ocultamos Buttons Steps
  document.getElementById('steps-buttons').className = 'd-none';

  const fname = document.getElementById('fname').value;
  const lname = document.getElementById('lname').value;
  const phone = document.getElementById('phone').value;
  const mail = document.getElementById('email').value;
  const year = document.getElementById('year').value;
  const city = document.getElementById('city').value;

  const data = `FUNCION=create&name=${ fname + ' ' +  lname }&phone=${ phone }&email=${ mail }&year=${ year }&city=${ city }`;

  $.ajax({
    url: './process/customers.process.php',
    type: 'POST',
    data: data,
    dataType: 'json',
    success: ( response ) => {
      const { success, message } = response;

      if ( success ) {
        finishContent.innerText = message;
        document.getElementById('form').reset();
      
      } else {
        finishContent.innerText = message;
      }
    }
  })

  return false;
};

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
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
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
    submitForm();
    return false;
  }

  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  let tab, input, valid = true;
  tab = document.getElementsByClassName("tab");
  input = tab[currentTab].getElementsByTagName("input");
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