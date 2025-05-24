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
document.addEventListener("DOMContentLoaded", () => {
  fetch("http://localhost/PAGINA-WEB/obtener_caruseles.php")
    .then(res => res.json())
    .then(data => {
      if (!data) return;

      // Videos
      const videos = [data.video1, data.video2, data.video3];
      const videoContainer = document.getElementById("carousel-videos-inner");
      videos.forEach((video, i) => {
        videoContainer.innerHTML += `
          <div class="carousel-item ${i === 0 ? "active" : ""}">
            <video autoplay muted loop playsinline class="d-block w-100">
              <source src="${video}" type="video/mp4">
            </video>
          </div>`;
      });

      // Aviones
      const aviones = [data.imgAvion1, data.imgAvion2, data.imgAvion3, data.imgAvion4];
      const avionContainer = document.getElementById("carousel-aviones-inner");
      aviones.forEach((img, i) => {
        avionContainer.innerHTML += `
          <div class="carousel-item ${i === 0 ? "active" : ""}">
            <img class="d-block w-100" src="${img}" alt="Imagen de avión ${i+1}">
          </div>`;
      });

      // Lugares
      const lugares = [data.imgLugar1, data.imgLugar2, data.imgLugar3, data.imgLugar4, data.imgLugar5, data.imgLugar6];
      const lugarContainer = document.getElementById("carousel-lugares-inner");
      lugares.forEach((img, i) => {
        lugarContainer.innerHTML += `
          <div class="carousel-item ${i === 0 ? "active" : ""}">
            <img class="d-block w-100" src="${img}" alt="Imagen del lugar ${i+1}">
          </div>`;
      });
    })
    .catch(err => {
      console.error("Error cargando datos del carrusel:", err);
    });
});

/*<!-- Script para el mapa y el carrusel -->*/

    document.addEventListener("DOMContentLoaded", function () {
        // Inicializar mapa4.23413228859429, -74.83600247779756
        const map = L.map('map').setView([4.23413228859429, -74.83600247779756], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([4.23413228859429, -74.83600247779756]).addTo(map).bindPopup('Aquí estamos 🚀').openPopup();
        // Extra (accesibilidad y enlaces)
        document.querySelector('a[href="#map"]').addEventListener('click', function () {
            document.getElementById("map").scrollIntoView({ behavior: "smooth" });
            setTimeout(() => {
              map.invalidateSize(); // importante si se muestra dentro de un contenedor que cambia
            }, 500);
          });

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
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 0, // ← prueba poner esto en 0
        loop: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    
    // Crea el mapa y establece la vista en las coordenadas deseadas
    var map = L.map('map').setView([4.2045, -74.6433], 13); // Coordenadas de ejemplo
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
  }).addTo(map);
  L.marker([4.2045, -74.6433]).addTo(map)
      .bindPopup('Estamos aquí!')
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


