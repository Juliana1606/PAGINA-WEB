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
