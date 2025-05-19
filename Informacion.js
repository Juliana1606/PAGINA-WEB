document.addEventListener('DOMContentLoaded', () => {
  console.log("ARCHIVO JS CARGADO");

  const toggleButton = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.nav');

  if (toggleButton && nav) {
    toggleButton.addEventListener('click', () => {
      nav.classList.toggle('show');
    });
  }

  function toggleMenu() {
    const nav = document.getElementById("mainNav");
    const burger = document.querySelector(".hamburger");

    nav?.classList.toggle("show");
    burger?.classList.toggle("active");
  }

  // Obtener ID desde la URL
  const id = getIdFromUrl();
  if (!id) {
    console.error("No se encontró el id en la URL");
    return;
  }

  // Petición al servidor
  fetch(`http://localhost/PAGINA-WEB/obtener_info_vuelo.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
      console.log("Datos recibidos:", data); 
      if (!data) {
        console.error("No se encontró información para ese id");
        return;
      }
      document.getElementById('titulo').textContent = data.titulo;
      document.getElementById('duracion').textContent = data.duracion;
      document.getElementById('pasajeros').textContent = data.pasajeros;
      document.getElementById('estacionamiento').textContent = data.estacionamiento;
      document.getElementById('recorrido').textContent = data.recorrido;
      document.getElementById('salida').textContent = data.salida;
      document.getElementById('imagen').src = data.imagen_url;
      document.getElementById('precio').textContent = data.precio.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
      document.getElementById('descripcion').textContent = data.descripcion;

      const ulItinerario = document.getElementById('itinerario');
      ulItinerario.innerHTML = '';
      const items = data.itinerario.split('\n');
      items.forEach(item => {
        if(item.trim()) {
          const li = document.createElement('li');
          li.textContent = item.trim();
          ulItinerario.appendChild(li);
        }
      });

      document.getElementById('mapa').src = data.mapa_url;
    })
    .catch(error => {
      console.error("Error al cargar los datos:", error);
      alert("Error al cargar información del vuelo.");
    });
});

function getIdFromUrl() {
  const params = new URLSearchParams(window.location.search);
  return params.get('id');
}
