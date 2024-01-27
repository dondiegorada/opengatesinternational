$(document).ready(() => {
  getNews() // Obtenemos las noticias activas
})

const getNews = () => {
  const requestOptions = {
      method: 'GET',
      redirect: 'follow'
  };

  fetch("./process/news.process.php?FUNCION=getNews", requestOptions)
    .then(response => response.json())
    .then(result => {
      const { success, data } = result

      if (success) {
          for (let i = 0; i < data.length; i++) {
              const { id, file, title, headline } = data[i];

              const html = `
                <div class="swiper-slide swiper-slide-home">
                  <div class="card">
                    <a href="./noticias.php?new=${ title.replaceAll(' ', '-') }">
                      <img src="./media/img/news/${ file }" class="card-img-top object-fit-cover" />
                    </a>

                    <div class="card-body">
                      <h6 class="fw-bold mb-3">${ title }</h6>
                      <p>${ headline }</p>
                    </div>
                  </div>
                </div>
              `
              $('#news-cards').append(html)
          }

          slickOptions()
      }
    })
    .catch(error => console.log('error', error));
}

const slickOptions = () => {
  const swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 5,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    },
    pagination: {
      el: ".swiper-pagination",
    },
  });
}