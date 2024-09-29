<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica o utilizador pelo username e password em texto simples
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Armazena o user_id na sessão
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username;

        // Verifica se o utilizador é admin ou paciente
        if (strpos($username, 'admin') === 0) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin_dashboard.php');
        } else {
            $_SESSION['user_logged_in'] = true;
            header('Location: users_dashboard.php');
        }
    } else {
        echo "<script>alert('Credenciais inválidas.'); window.location.href = 'login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
