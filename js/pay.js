document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('userForm');
    const inputs = form.querySelectorAll('input[type="text"], input[type="date"]');
    const cvvInput = document.getElementById('cvv_tarjeta');
    const expiryInput = document.getElementById('fecha_caducidad_tarjeta');
    const cardNumberInput = document.getElementById('numero_tarjeta');

    function luhnCheck(value) {
        let sum = 0;
        let shouldDouble = false;
        for (let i = value.length - 1; i >= 0; i--) {
            let digit = parseInt(value.charAt(i));
            if (shouldDouble) {
                digit *= 2;
                if (digit > 9) {
                    digit -= 9;
                }
            }
            sum += digit;
            shouldDouble = !shouldDouble;
        }
        return sum % 10 === 0;
    }

    form.addEventListener('submit', function(event) {
        let valid = true;
        const today = new Date();

        inputs.forEach(input => {
            const errorMessage = input.nextElementSibling;
            
            if (input.value.trim() === '') {
                valid = false;
                if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                    const error = document.createElement('div');
                    error.className = 'error-message';
                    error.style.color = 'red';
                    error.innerText = 'Este campo no puede estar vacío';
                    input.after(error);
                }
            } else {
                if (errorMessage && errorMessage.classList.contains('error-message')) {
                    errorMessage.remove();
                }
            }

            // Validación para CVV
            if (input === cvvInput) {
                const cvvValue = cvvInput.value.trim();
                if (!/^\d{3}$/.test(cvvValue)) {
                    valid = false;
                    if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                        const error = document.createElement('div');
                        error.className = 'error-message';
                        error.style.color = 'red';
                        error.innerText = 'El CVV debe ser de exactamente 3 dígitos';
                        cvvInput.after(error);
                    }
                } else {
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.remove();
                    }
                }
            }

            // Validación para fecha de caducidad
            if (input === expiryInput) {
                const expiryValue = new Date(expiryInput.value);
                if (expiryValue < today) {
                    valid = false;
                    if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                        const error = document.createElement('div');
                        error.className = 'error-message';
                        error.style.color = 'red';
                        error.innerText = 'La fecha de caducidad indica que esta caducada';
                        expiryInput.after(error);
                    }
                } else {
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.remove();
                    }
                }
            }

            // Validación para número de tarjeta
            if (input === cardNumberInput) {
                const cardNumberValue = cardNumberInput.value.trim();
                if (!luhnCheck(cardNumberValue)) {
                    valid = false;
                    if (!errorMessage || !errorMessage.classList.contains('error-message')) {
                        const error = document.createElement('div');
                        error.className = 'error-message';
                        error.style.color = 'red';
                        error.innerText = 'El número de tarjeta no es válido';
                        cardNumberInput.after(error);
                    }
                } else {
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.remove();
                    }
                }
            }
        });

        if (!valid) {
            event.preventDefault();
        }
    });
});
