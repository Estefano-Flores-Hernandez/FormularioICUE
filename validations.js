document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('memberForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const dob = document.getElementById('dob').value.trim();
        const gender = document.querySelector('input[name="gender"]:checked');

        if (!firstName || !lastName || !phone || !dob || !gender) {
            showAlert('Error', 'Por favor, completa todos los campos', 'warning');
            return;
        }

        if (!/^[a-zA-Z\s]+$/.test(firstName) || !/^[a-zA-Z\s]+$/.test(lastName)) {
            showAlert('Error en el nombre', 'Los nombres y apellidos solo deben contener letras y espacios.<br> Ejemplo: <em>Luis Aguilar</em>', 'warning');
            return;
        }

        if (!/^\d{9}$/.test(phone)) {
            showAlert('Error en el teléfono', 'El número de teléfono debe tener exactamente 9 dígitos.<br> Ejemplo: <em>987654321</em>', 'warning');
            return;
        }

        const dobPattern = /^\d{4}-\d{2}-\d{2}$/;
        const dobDate = new Date(dob);
        const today = new Date();

        const age = today.getFullYear() - dobDate.getFullYear();
        const monthDiff = today.getMonth() - dobDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
            age--;
        }

        if (!dobPattern.test(dob) || dobDate > today || age < 18 || age > 65) {
            showAlert('Error en la fecha de nacimiento', 'La fecha debe tener el formato DD-MM-YYYY, no puede ser futura, y la edad debe estar entre 18 y 65 años.<br> Ejemplo: <em>01-04-2003</em>', 'warning');
            return;
        }

        const formData = new FormData(form);

        fetch('submit.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    showAlert('Error en el servidor', data.message, 'error');
                } else {
                    showAlert('Éxito', data.message, 'success').then(() => {
                        form.reset();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error de conexión', 'Ocurrió un problema al procesar tu solicitud.', 'error');
            });
    });

    function showAlert(title, text, icon) {
        return Swal.fire({
            title: title,
            html: text,
            icon: icon,
            confirmButtonText: 'Ok',
            customClass: {
                popup: 'swal-popup',
                title: 'swal-title',
                htmlContainer: 'swal-html',
                confirmButton: 'swal-button'
            },
            buttonsStyling: true,
            showCloseButton: true,
            focusConfirm: true,
            background: '#f9f9f9',
            color: '#333',
        });
    }
});
