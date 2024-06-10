document.addEventListener('DOMContentLoaded', function () {
    const ciudades = document.querySelectorAll('.dropdown-item.dropdown-toggle');

    // Función para mostrar los establecimientos al hacer clic en una ciudad
    function mostrarEstablecimientos(event) {
        const ciudad = event.target;
        const menu = ciudad.nextElementSibling; // Obtenemos el menú desplegable siguiente al elemento clicado

        // Cerrar los menús desplegables que no sean el de la ciudad actual
        ciudades.forEach(otraCiudad => {
            if (otraCiudad !== ciudad) {
                otraCiudad.nextElementSibling.classList.remove('show');
            }
        });

        // Mostrar el menú desplegable de la ciudad actual
        menu.classList.toggle('show');
    }

    // Agregar eventos para mostrar los establecimientos al hacer clic en una ciudad
    ciudades.forEach(ciudad => {
        ciudad.addEventListener('click', mostrarEstablecimientos);
    });

    // Cerrar menús desplegables al hacer clic fuera de ellos
    window.addEventListener('click', function (event) {
        if (!event.target.matches('.dropdown-item.dropdown-toggle')) {
            ciudades.forEach(ciudad => {
                ciudad.nextElementSibling.classList.remove('show');
            });
        }
    });
});
