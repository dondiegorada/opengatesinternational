$( document ).ready( async () => {
  await getNews();
})

async function getNews() {
  const response = await fetch(`../process/news.process.php?FUNCION=getNews&admin=true`, {
    method: 'GET',
    redirect: 'follow'
  });

  const { data } = await response.json();
  renderNew( data );
  renderNews( data );
}

function renderNew( data ) {
  const titleNew = getParameterByName('new');
  const news = data.filter(({ title }) => title == titleNew.replaceAll('-', ' '))[0];

  console.log({ news, data: data[0] });
  const { headline, content } = !!news ? news : data[0];

  $('#new').append(`
    <h2 class="fw-bold text-primary">${ headline }</h2>
    <p class="mt-5">${ content }</p>
  `);
}

function renderNews( data ) {
  data.forEach(({ id, file, title, content }) => {
    $('#news').append(`
      <a href="./noticias.php?new=${ title.replaceAll(' ', '-') }">
        <div class="carousel-item ${ id == 1 ? 'active': '' }">
          <div class="container">
            <div class="row">
              <div class="col-xl-5 col-sm-4 mb-3">
                <img src="../media/img/news/${ file }" class="d-block object-fit-cover w-100" height="350" alt="...">
              </div>
  
              <div class="col-xl-7 col-sm-8 p-5">
                <h3 class="fw-bold">${ title }</h3>
                <p
                  style="text-overflow: ellipsis; overflow: hidden; height: 147px;"
                  class="my-3"
                >
                  ${ content }
                </p>...
              </div>
            </div>
          </div>
        </div>
      </a>
    `);
  });
}

function getParameterByName( name ) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
  results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}