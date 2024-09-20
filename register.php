<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registro de Usuario</h1>

    <?php
    // Conectar a la base de datos
    $servername = "localhost"; // Cambia esto si tu servidor es diferente
    $username = "root"; // Tu usuario de MySQL
    $password = ""; // Tu contraseña de MySQL
    $dbname = "flight_reservation";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Manejo del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Preparar y bindear
        $stmt = $conn->prepare("INSERT INTO Users (nombre_usuario, contrasena, correo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $email);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p>Registro exitoso</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Cerrar la declaración
        $stmt->close();
    }

    // Cerrar conexión
    $conn->close();
    ?>

    <form id="registerForm" action="register.php" method="POST">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Registrar">
    </form>

    <script src="scripts.js"></script>
</body>
</html>
