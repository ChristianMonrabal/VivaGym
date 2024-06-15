$(document).ready(function () {
    $("#userForm").submit(function (event) {
        var isValid = true;
        var currentYear = new Date().getFullYear();

        // Verificar cada campo de entrada
        $("#userForm .form-control").each(function () {
            var $this = $(this);
            var value = $this.val().trim();
            var id = $this.attr("id");

            if (value === "") {
                isValid = false;
                $this.siblings(".error").show().text("Este campo es obligatorio");
                $this.addClass("border-danger");
            } else {
                $this.siblings(".error").hide();
                $this.removeClass("border-danger");

                // Validar el campo de email
                if (id === "email") {
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(value)) {
                        isValid = false;
                        $this.siblings("#email-error").show().text("Correo electrónico inválido");
                        $this.addClass("border-danger");
                    } else {
                        // Extraer el dominio del correo electrónico
                        var domain = value.split('@')[1];
                        var validDomains = ['gmail.com', 'yahoo.com', 'hotmail.com']; // Dominios válidos

                        if (validDomains.indexOf(domain) === -1) {
                            isValid = false;
                            $this.siblings("#email-error").show().text("Dominio de correo electrónico inválido");
                            $this.addClass("border-danger");
                        } else {
                            $this.siblings("#email-error").hide();
                        }
                    }
                }

                // Validar el campo de número de teléfono
                if (id === "numero_telefono") {
                    var phonePattern = /^\d{9}$/;
                    if (!phonePattern.test(value)) {
                        isValid = false;
                        $this.siblings("#telefono-error").show().text("El número de teléfono debe tener 9 dígitos");
                        $this.addClass("border-danger");
                    } else {
                        $this.siblings("#telefono-error").hide();
                    }
                }

                // Validar la fecha de nacimiento
                if (id === "fecha_nacimiento") {
                    var birthYear = parseInt(value.split("-")[0]);
                    if (currentYear - birthYear < 16) {
                        isValid = false;
                        $this.siblings("#edad-error").show().text("Debe ser mayor de 16 años");
                        $this.addClass("border-danger");
                    } else {
                        $this.siblings("#edad-error").hide();
                    }
                }

                // Validar el campo de DNI
                if (id === "dni") {
                    var dniPattern = /^[0-9]{7,8}[A-Za-z]$/;
                    if (!dniPattern.test(value)) {
                        isValid = false;
                        $this.siblings(".error").show().text("El DNI debe tener entre 7 y 8 números seguidos de una letra");
                        $this.addClass("border-danger");
                    } else {
                        var dniNumber = value.substring(0, value.length - 1);
                        var dniLetter = value.substring(value.length - 1).toUpperCase();
                        var letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
                        var letterCorrect = letters.charAt(parseInt(dniNumber) % 23);

                        if (dniLetter !== letterCorrect) {
                            isValid = false;
                            $this.siblings(".error").show().text("La letra del DNI no es válida");
                            $this.addClass("border-danger");
                        } else {
                            $this.siblings(".error").hide();
                        }
                    }
                }

                // Validar el campo de Código Postal
                if (id === "codigo_postal") {
                    var postalPattern = /^\d{5}$/;
                    if (!postalPattern.test(value)) {
                        isValid = false;
                        $this.siblings(".error").show().text("El código postal debe tener 5 dígitos");
                        $this.addClass("border-danger");
                    } else {
                        $this.siblings(".error").hide();
                    }
                }

            }
        });

        if (!isValid) {
            event.preventDefault(); // Evitar el envío del formulario si hay campos vacíos o con errores
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('jobForm');

    form.addEventListener('submit', function(event) {
        let valid = true;

        const nombreCompleto = document.getElementById('nombreCompleto');
        const telefono = document.getElementById('telefono');
        const email = document.getElementById('email');
        const cv = document.getElementById('cv');

        // Clear previous errors
        clearErrors();

        if (nombreCompleto.value.trim() === '') {
            showError(nombreCompleto, 'errorNombreCompleto', 'El nombre completo es requerido');
            valid = false;
        }

        if (telefono.value.trim() === '') {
            showError(telefono, 'errorTelefono', 'El número de teléfono es requerido');
            valid = false;
        }

        if (email.value.trim() === '') {
            showError(email, 'errorEmail', 'El correo electrónico es requerido');
            valid = false;
        }

        if (cv.value.trim() === '') {
            showError(cv, 'errorCv', 'El currículum es requerido');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function showError(input, errorElementId, message) {
        input.classList.add('is-invalid');
        const errorElement = document.getElementById(errorElementId);
        errorElement.textContent = message;
    }

    function clearErrors() {
        const inputs = document.querySelectorAll('.form-control, .custom-file-input');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
        });

        const errorElements = document.querySelectorAll('.error');
        errorElements.forEach(errorElement => {
            errorElement.textContent = '';
        });
    }
});

// Mostrar el nombre del archivo seleccionado
$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});