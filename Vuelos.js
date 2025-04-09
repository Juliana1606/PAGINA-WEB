//funcion para que funcione el menu hamburgesa
const toggleButton = document.querySelector('.menu-toggle');
const nav = document.querySelector('.nav');

toggleButton.addEventListener('click', () => {
    nav.classList.toggle('show');
});
//funcion para activar la pequeña animacion
function toggleMenu() {
    const nav = document.getElementById("mainNav");
    const burger = document.querySelector(".hamburger");
  
    nav.classList.toggle("show");
    burger.classList.toggle("active");
  }
  