# Tours Aerosport - Sitio Web

Este proyecto es un sitio web informativo y promocional para **Tours Aerosport**, una empresa dedicada a ofrecer vuelos recreativos y experiencias aéreas únicas. El sitio está compuesto por varias páginas HTML interconectadas, con estilos CSS personalizados y funcionalidades JavaScript. A continuación se describe la función de cada archivo fuente:

---

##  Archivos HTML

### `Main.html`
- Página de inicio del sitio.
- Contiene un carrusel de videos de experiencias aéreas.
- Incluye secciones como “Conócenos”, “Ubicación” (con mapa interactivo Leaflet), “Más experiencias” y un formulario de contacto.
- Cuenta con un encabezado fijo con menú de navegación responsive y botón hamburguesa.

### `Vuelos.html`
- Página dedicada a los **vuelos recreativos** ofrecidos.
- Muestra tarjetas individuales de cada vuelo con información, imagen, precio y botones para más info o reservar.
- Incluye migas de pan (breadcrumbs) para navegación jerárquica.
- Sección de contacto en el pie de página.

### `Informacion.html`
- Detalle individual de una experiencia de vuelo.
- Presenta información más específica sobre duración, pasajeros, recorrido, salida, itinerario, precio y botón de reserva.
- También incluye un iframe con el mapa del recorrido.

---

##  Archivos CSS

### `styles_Main.css`
- Contiene los estilos principales de la página de inicio (`Main.html`).
- Define la estructura del menú, carruseles, botones, secciones y responsive design.
- Utiliza fuentes personalizadas como `Jockey One`.
- Incluye estilos para mejorar la accesibilidad visual como alto contraste y navegación clara.

### `Vuelos.css`
- Estilos específicos para `Vuelos.html`.
- Define el diseño de las tarjetas de vuelos, botones interactivos, y estilos responsivos.
- Asegura una presentación atractiva de los servicios aéreos.

### `Informacion.css`
- Aplicado en `Informacion.html`.
- Estiliza secciones informativas, botones de reserva, mapa embebido, y accesibilidad visual.
- Incluye clases como `.detalle-servicio`, `.info-servicio`, y `.reserva-boton`.

---

##  Archivos JavaScript

### `script.js`
- Archivo JS vinculado a `Main.html`.
- Controla la funcionalidad del menú hamburguesa para móviles.
- Permite mostrar/ocultar el menú de navegación.

### `Vuelos.js`
- Controla el menú hamburguesa en `Vuelos.html`.
- Incluye la función `toggleMenu()` que gestiona la clase `show` para desplegar el menú en móviles.

### `Informacion.js`
- Similar a los anteriores, gestiona la funcionalidad responsive del menú hamburguesa en `Informacion.html`.

---

##  Accesibilidad

- Se han incluido prácticas de accesibilidad como:
  - Uso de `alt` en todas las imágenes.
  - Encabezados jerárquicos (`<h1>` a `<h3>`) correctamente usados.
  - Textos ocultos con `.sr-only` para lectores de pantalla.
  - Contrastes mejorados entre textos y fondos.
  - Navegación clara y botones accesibles.
- Validado con la extensión **WAVE (Web Accessibility Evaluation Tool)** para cumplir con los principios de accesibilidad web.

---

##  Recomendaciones

- Subir el proyecto a un repositorio privado de GitHub si se trabaja en un entorno académico o comercial.
- Usar etiquetas semánticas (`<main>`, `<section>`, `<nav>`, etc.) correctamente para mejorar SEO y accesibilidad.

---

Desarrollado con 💙 para fomentar el turismo aéreo y las experiencias inolvidables en los cielos de Colombia.
