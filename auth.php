<?php
require 'db.php'; // Asegúrate de incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'] ?? ''; // Para registro

    if ($action == 'register') {
        $stmt = $conn->prepare("INSERT INTO Users (username, password, email) VALUES (?, ?, ?)");
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $user, $hashed_password, $email);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar: ' . $stmt->error]);
        }
        $stmt->close();
    } elseif ($action == 'login') {
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($pass, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id']; // Guarda el ID del usuario en la sesión
            echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos']);
        }
        $stmt->close();
    }
}
?>
