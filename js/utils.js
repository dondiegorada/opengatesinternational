// Obtenemos token de authorization
const getToken = async () => {
  const TOKEN_API = 'jSbx4j2Fxwt1shpUzyt0Zk12NvI5VTTG69vQu6D6Ub7Wr_XlcTk70FHYkD6sBqGKmRE';
  const EMAIL_API = 'johndev983@gmail.com';

  const myHeaders = new Headers();
  myHeaders.append("Accept", "*/*");
  myHeaders.append("api-token", TOKEN_API);
  myHeaders.append("user-email", EMAIL_API);

  const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
  };

  const response = await fetch('https://www.universal-tutorial.com/api/getaccesstoken', requestOptions);
  const data = await response.json();

  return data;
}

// Obtenemos paises de API
const getCountries = async () => {
  const { auth_token } = await getToken();

  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");
  myHeaders.append("Authorization", `Bearer ${ auth_token }`);

  const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
  };

  const response = await fetch("https://www.universal-tutorial.com/api/countries/", requestOptions);
  const data = await response.json();

  return data;
}