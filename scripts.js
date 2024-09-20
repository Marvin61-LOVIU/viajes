document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('auth.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Redirigir o realizar otra acción
        } else {
            alert(`Error: ${data.message}`);
        }
    });
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('auth.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Redirigir o realizar otra acción
        } else {
            alert(`Error: ${data.message}`);
        }
    });
});
