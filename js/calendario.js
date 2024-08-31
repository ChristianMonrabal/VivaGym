document.addEventListener('DOMContentLoaded', function () {
    const reservarForm = document.querySelector('form[action="../includes/reservas.php"]');
    if (reservarForm) {
        reservarForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const actividad = document.getElementById('actividad').value;
            const diaSemana = document.getElementById('dia_semana').value;
            const hora = document.getElementById('hora').value;

            alert(`Has hecho una reserva:\nActividad: ${actividad}\nDía de la semana: ${diaSemana}\nHora: ${hora}`);

            reservarForm.submit();
        });
    }

    const anularForm = document.querySelector('form[action="../includes/anular_reservas.php"]');
    if (anularForm) {
        anularForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const reservaSeleccionada = document.getElementById('reserva').value;
            const [actividad, diaSemana, hora] = reservaSeleccionada.split(',');

            alert(`Has anulado una reserva:\nActividad: ${actividad}\nDía de la semana: ${diaSemana}\nHora: ${hora.slice(0, 5)}`);

            anularForm.submit();
        });
    }
});
