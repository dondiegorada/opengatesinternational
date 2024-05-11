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