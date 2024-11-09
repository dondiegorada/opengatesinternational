// Datos para cada tarjeta
const portfolioItems = [
  {
    title: "B1- Visitante de Negocios",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Visa J: AU PAIR, Destinada para aquellos en hacer intercambios.",
    features: [
      "Asesoría personalizada",
      "Trámites ante la embajada.",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "E-3 Especialidad Profesional Australiana",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "BBC Tarjeta de cruce fronterizo: Mexico",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "B-1 Atleta Amateur o Profesional",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "PAG Artista, Atleta, Animador",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },

  {
    title: "CWI-Trabajador transitorio exclusivo de CNMI",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "D- Miembro de tripulación",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "B-1 Empleado domestico",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },

  {
    title: "G1-G5 OTAN Empleado de una organización designada",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "A-2 OTAN 1-6 Persona militar extranjero",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Q: Visitante de intercambio cultural internacional",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },

  {
    title: "B-2 Turismo",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "VISA 1: Medios de comunicación periodista",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Visa H, H-1B: Médico",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },

  {
    title: "H-1B: Campos que requieren conocimientos especializados",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Visa F, M: Estudiante",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "H-2A: Trabajador Avícola Temporal",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },

  {
    title:
      "H-3: Capacitación en programa que no tiene como objetivo principal el empleo",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Visa E: Comerciante de tratados/Inversionista",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Visa C: En transito por los Estados Unidos",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },

  {
    title: "Visa U: Victima de actividad criminal",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title: "Visa T: Victima de trata de personas.",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title:
      "Visa V: Renovaciones de visas No inmigrante (v) para conyuges e hijos de residentes permanentes",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
];

const portfolioItemsNoInmigrantes = [
  {
    title: "IR1, CR1: Conyugue de ciudadano Estadounidense",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title:
      "K-3: Conyugue de ciudadano Estadounidense que espera la aprobación de una petición I-120",
    features: [
      "Asesoría personalizada",
      "Trámites ante la embajada.",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title:
      "k-1: Prometido (a) que se casará con un ciudadano estadounidense y vivirá en EE.UU",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title:
      "IR3,IH3,IR4,IH4: Adopción internacional de niños huérfanos por ciudadanos estadounidenses",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title:
      "IR2,CR2,IR5,F1,F3,F4: Ciertos miembros de la familia de ciudadanos estadounidenses",
    features: [
      "Asesoría personalizada",
      "Formularios",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
  {
    title:
      "F2A,F2B: Ciertos miembros de la familia de residentes permanentes legales.",
    features: [
      "Asesoría personalizada",
      "Tramites antes la embajada",
      "Documentación",
      "Cita en embajada",
    ],
    currency: "USD",
  },
];

// Función para crear el HTML de cada tarjeta
function createPortfolioCard(item) {
  const cardDiv = document.createElement("div");
  cardDiv.className = "col-lg-4 col-md-6 col-sm-6 col-xs-12";

  cardDiv.innerHTML = `
      <div class="card-portafolio mb-4">
        <h6 class="fw-bold text-primary mx-3 my-3">${item.title}</h6>
        <ul class="m-0">
          ${item.features
            .map((feature) => `<li><p class="m-0">${feature}</p></li>`)
            .join("")}
        </ul>
        <div style="position: absolute; right: 10px; bottom: 10px;">
          <span class="badge badge-pill badge-secondary badge-portafolio">${
            item.currency
          }</span>
        </div>
      </div>
    `;
  return cardDiv;
}

// Contenedor donde se agregarán las tarjetas
const container = document.getElementById("portafolio-container");
const container_no_inmigrantes = document.getElementById(
  "portafolio-container-no-inmigrantes"
);

// Generar y añadir cada tarjeta al contenedor
portfolioItems.forEach((item) => {
  const card = createPortfolioCard(item);
  container.appendChild(card);
});

// Generar y añadir cada tarjeta al contenedor
portfolioItemsNoInmigrantes.forEach((item) => {
  const card = createPortfolioCard(item);
  container_no_inmigrantes.appendChild(card);
});

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1.1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });