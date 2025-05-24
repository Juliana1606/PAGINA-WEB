document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("contenedorTarjetas");

  fetch("http://localhost/PAGINA-WEB/obtener_Eventos.php")
    .then(response => response.json())
    .then(eventos => {
      eventos.forEach((evento, index) => {
        const idCarrusel = `carousel${evento.id}`;

        const tarjeta = document.createElement("div");
        tarjeta.classList.add("Tarjeta");

        tarjeta.innerHTML = `
          <div id="${idCarrusel}" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#${idCarrusel}" data-slide-to="0" class="active"></li>
                <li data-target="#${idCarrusel}" data-slide-to="1"></li>
                <li data-target="#${idCarrusel}" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="${evento.img_carusel1}" alt="Slide 1">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="${evento.img_carusel2}" alt="Slide 2">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="${evento.img_carusel3}" alt="Slide 3">
                </div>
              </div>
              <a class="carousel-control-prev" href="#${idCarrusel}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="carousel-control-next" href="#${idCarrusel}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
              </a>
          </div>

          <div class="contenido">
            <h3>${evento.titulo}</h3>
            <p class="detalles">
                <span> 🛩️Avion </span>
                <span>🚁 Aeromodelo</span>
            </p>
            <p class="precio-vuelo">${evento.precio}</p>
            <p class="descripcion">${evento.descripcion}</p>
            <div class="botones">
              <button class="info">COMUNICATE CON LA CENTRAL PARA PLANEAR TU EVENTO</button>
            </div>
          </div>
        `;

        contenedor.appendChild(tarjeta);
      });
    })
    .catch(error => {
      console.error("Error cargando eventos:", error);
      contenedor.innerHTML = "<p>No se pudieron cargar los eventos.</p>";
    });
});
