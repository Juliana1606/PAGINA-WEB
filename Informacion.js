//funcion para que funcione el menu hamburgesa
const toggleButton = document.querySelector('.menu-toggle');
const nav = document.querySelector('.nav');

toggleButton.addEventListener('click', () => {
    nav.classList.toggle('show');
});

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
    document.getElementById("Reservar").addEventListener("click", function () {
      window.location.href = "Informacion.html";
    });

    // Scroll a la sección de contacto
    document.getElementById("botonContacto").addEventListener("click", function () {
      document.getElementById("seccionContacto").scrollIntoView({ behavior: "smooth" });
    });
  });