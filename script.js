console.log("🔁 Menú hamburguesa activado");
document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".video-slide");
    const dots = document.querySelectorAll(".ellipse");
    let currentIndex = 0;
    let interval;

    function changeSlide(index) {
        currentIndex = index;
        const offset = -index * 100;
        document.querySelector(".video-container").style.transform = `translateX(${offset}%)`;

        dots.forEach(dot => dot.classList.remove("active"));
        dots[index].classList.add("active");
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        changeSlide(currentIndex);
    }

    function startAutoSlide() {
        interval = setInterval(nextSlide, 5000); // Cambia de video cada 5 segundos
    }

    // Evento para cambiar manualmente con los círculos
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            clearInterval(interval);
            changeSlide(index);
            startAutoSlide();
        });
    });

    startAutoSlide();
});
/*<!-- Script para el mapa y el carrusel -->*/

    document.addEventListener("DOMContentLoaded", function () {
        // Inicializar mapa
        const map = L.map('map').setView([4.2028, -74.6400], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([4.2028, -74.6400]).addTo(map).bindPopup('Aquí estamos 🚀').openPopup();

        // Carrusel de imágenes
        let index = 0;
        const images = document.querySelector(".carousel-images");
        const dots = document.querySelectorAll(".dot");
        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");

        function updateCarousel() {
            images.style.transform = `translateX(${-index * 100}%)`;
            dots.forEach(dot => dot.classList.remove("active"));
            dots[index].classList.add("active");
        }

        prev.addEventListener("click", () => {
            index = (index > 0) ? index - 1 : dots.length - 1;
            updateCarousel();
        });

        next.addEventListener("click", () => {
            index = (index < dots.length - 1) ? index + 1 : 0;
            updateCarousel();
        });
    });
    
    // Crea el mapa y establece la vista en las coordenadas deseadas
    var map = L.map('map').setView([4.23419, -74.83548], 15); // [latitud, longitud], nivel de zoom

    // Agrega el mapa base de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Agrega un marcador en la ubicación deseada
    L.marker([4.23419, -74.83548]).addTo(map)
        .bindPopup('📍 Aquí está estamos')
        .openPopup();
//funcion para que funcione el menu hamburgesa
    const toggleButton = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');

    toggleButton.addEventListener('click', () => {
        nav.classList.toggle('show');
    });
//funcion para activar la animacion del menu hamburgesa
function toggleMenu() {
    const nav = document.getElementById("mainNav");
    const burger = document.querySelector(".hamburger");
  
    nav.classList.toggle("show");
    burger.classList.toggle("active");
  }

  //funciones para navegar entre pantallas
  document.addEventListener("DOMContentLoaded", function () {
    // Ir a Vuelos.html
    document.getElementById("linkVuelos").addEventListener("click", function () {
      window.location.href = "Vuelos.html";
    });

    // Ir a Informacion.html
    document.getElementById("botonReserva").addEventListener("click", function () {
      window.location.href = "Informacion.html";
    });

    // Scroll a la sección de contacto
    document.getElementById("botonContacto").addEventListener("click", function () {
      document.getElementById("seccionContacto").scrollIntoView({ behavior: "smooth" });
    });
  });