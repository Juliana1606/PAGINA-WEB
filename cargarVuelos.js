document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("contenedorTarjetas");

  // Simulación: pide los datos desde la API REST (aquí un ejemplo con fetch)
  fetch("http://localhost/PAGINA-WEB/obtener_vuelos.php")  // Cambia la URL a tu API real
    .then(response => response.json())
    .then(vuelos => {
      vuelos.forEach(vuelo => {
        const tarjeta = document.createElement('div');
        tarjeta.classList.add('Tarjeta');
        tarjeta.innerHTML = `
          <img src="${vuelo.imagen_url}" alt="Imagen promocional de ${vuelo.titulo}">
          <div class="contenido">
            <h3>${vuelo.titulo}</h3>
            <p class="detalles">
              <span>👤 Incluye ${vuelo.personas} persona(s)</span>
              <span> ⏱ ${vuelo.duracion}</span>
            </p>
            <p class="precio-vuelo">${vuelo.precio.toLocaleString('es-CO', {style:'currency', currency:'COP'})}</p>
            <p class="descripcion">${vuelo.descripcion}</p>
            <div class="botones">
              <a href="${vuelo.enlace_info}?id=${vuelo.id}" class="info">¡Quiero más info!</a>
              
              <a href="${vuelo.enlace_reserva}" class="reservar">¡Reservar ahora!</a>
            </div>
          </div>
        `;
        contenedor.appendChild(tarjeta);
      });
    })
    .catch(error => {
      console.error("Error cargando vuelos:", error);
      contenedor.innerHTML = "<p>No se pudieron cargar los vuelos. Intenta más tarde.</p>";
    });
});