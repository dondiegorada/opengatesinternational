// Obtenemos registros de users
const getCustomers = async ( status ) => {
  const response = await fetch(`../process/customers.process.php?FUNCION=getAll&status=${ status }`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { data } = await response.json();
  return data;
}

// Obtenemos tipos visa de API
const getTiposVisa = async () => {
  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
  };

  const response = await fetch("./process/location.process.php?method=getTiposVisa", requestOptions);
  const data = await response.json();
  return data;
}

// Obtenemos countries de API
const getCountries = async () => {
  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
  };

  const response = await fetch("./process/location.process.php?method=getCountries", requestOptions);
  const data = await response.json();
  return data;
}

// Obtenemos states de API
const getStates = async ( country ) => {
  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
  };

  const response = await fetch(`./process/location.process.php?method=getStates&country=${ country }`, requestOptions);
  const data = await response.json();

  return data;
}

// Obtenemos Cities de API
const getCities = async ( state ) => {
  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
  };

  const response = await fetch(`./process/location.process.php?method=getCities&state=${ state }`, requestOptions);
  const data = await response.json();

  return data;
}