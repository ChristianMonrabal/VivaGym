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
                    if (currentYear - birthYear < 18) {
                        isValid = false;
                        $this.siblings("#edad-error").show().text("Debe ser mayor de 18 años");
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
