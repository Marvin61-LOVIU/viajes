document.addEventListener('DOMContentLoaded', () => { 
    // Registro de usuario
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar el envío tradicional del formulario
            const formData = new FormData(this);
            formData.append('action', 'register'); // Añadir acción al formulario
            
            // Enviar los datos al servidor
            fetch('/register', {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la red');
                }
                return response.json(); // Convertir la respuesta a JSON
            })
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Registro exitoso
                    alert('Registro exitoso. ¡Bienvenido!');
                    // Redirigir o realizar otra acción
                } else {
                    // Manejar errores en el registro
                    alert(`Error: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al registrar. Por favor, inténtalo de nuevo.');
            });
        });
    }
});
