<?php
session_start();
include 'db_connect.php'; 

// Verifica se o user_id está definido
if (!isset($_SESSION['user_id'])) {
    header("Location: register.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recolhe os dados do formulário
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $contato = $_POST['contato'];
    $morada = $_POST['morada'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id']; // Usa o user_id guardado na sessão

    // Insere os dados na tabela pacientes
    $sql = "INSERT INTO pacientes (nome, apelido, data_nascimento, sexo, contato, morada, email, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nome, $apelido, $data_nascimento, $sexo, $contato, $morada, $email, $user_id);
    
    if ($stmt->execute()) {
        // Registo bem-sucedido, redireciona para a página inicial ou login
        echo "<script>alert('Paciente registado com sucesso!'); window.location.href = 'login.php';</script>"; 
    } else {
        echo "Erro ao registar o paciente: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Med+ - Registar Dados Pessoais</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/logo.png" alt="Clinica Logo" height="53"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-center">
                    <li class="nav-item"><a class="nav-link" href="index.php" style="color: #586693">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="specialities.php" style="color: #586693">Especialidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="doctors.php" style="color: #586693">Médicos</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php" style="color: #586693">Sobre a Med+</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php" style="color: #586693">Contatos</a></li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sessão</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Registar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Registar Dados Pessoais</h2>
        <form method="POST" action="register_user.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="apelido" class="form-label">Apelido</label>
                <input type="text" class="form-control" id="apelido" name="apelido" required>
            </div>
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="contato" class="form-label">Contato</label>
                <input type="text" class="form-control" id="contato" name="contato" required>
            </div>
            <div class="mb-3">
                <label for="morada" class="form-label">Morada</label>
                <input type="text" class="form-control" id="morada" name="morada" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Registar</button>
            <br><br>
        </form>
    </div>
    <footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
