document.addEventListener('DOMContentLoaded', function () {
    const ciudades = document.querySelectorAll('.dropdown-item.dropdown-toggle');

    function mostrarEstablecimientos(event) {
        const ciudad = event.target;
        const menu = ciudad.nextElementSibling; // Obtenemos el menú desplegable siguiente al elemento clicado

        ciudades.forEach(otraCiudad => {
            if (otraCiudad !== ciudad) {
                otraCiudad.nextElementSibling.classList.remove('show');
            }
        });

        menu.classList.toggle('show');
    }

    ciudades.forEach(ciudad => {
        ciudad.addEventListener('click', mostrarEstablecimientos);
    });

    window.addEventListener('click', function (event) {
        if (!event.target.matches('.dropdown-item.dropdown-toggle')) {
            ciudades.forEach(ciudad => {
                ciudad.nextElementSibling.classList.remove('show');
            });
        }
    });
});
