<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Obtém o user_id da sessão (assumindo que o user_id foi armazenado na sessão após o login)
$user_id = $_SESSION['user_id'];

// Procura informações do paciente a usar o user_id
$sql_paciente = "SELECT * FROM pacientes WHERE user_id = ?";
$stmt = $conn->prepare($sql_paciente);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result_paciente = $stmt->get_result();

// Verifica se o paciente foi encontrado
if ($result_paciente->num_rows > 0) {
    $paciente = $result_paciente->fetch_assoc();
} else {
    echo "<script>alert('Erro: Paciente não encontrado.'); window.location.href = 'login.php';</script>";
    exit();
}


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados do paciente (somente contato, morada e email)
    $contato = $_POST['contato'];
    $morada = $_POST['morada'];
    $email = $_POST['email'];

    $sql_update = "UPDATE pacientes SET contato = ?, morada = ?, email = ? WHERE id_paciente = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('sssi', $contato, $morada, $email, $paciente['id_paciente']);
    $stmt_update->execute();

    // Atualiza a informação de sessão com o novo email
    $_SESSION['username'] = $email;

    echo "<script>alert('Informações atualizadas com sucesso!'); window.location.href = 'users_dashboard.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Med+ - Perfil de Paciente</title>
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
                    <li class="nav-item"><a class="nav-link" href="logout.php">Terminar Sessão</a></li>
                </ul>
			</div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Informações Pessoais</h2>
        <form method="POST" action="users_dashboard.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" value="<?= $paciente['nome'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="apelido" class="form-label">Apelido</label>
                <input type="text" class="form-control" id="apelido" value="<?= $paciente['apelido'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" value="<?= $paciente['data_nascimento'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="contato" class="form-label">Contato</label>
                <input type="text" class="form-control" id="contato" name="contato" value="<?= $paciente['contato'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="morada" class="form-label">Morada</label>
                <input type="text" class="form-control" id="morada" name="morada" value="<?= $paciente['morada'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $paciente['email'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar Informações</button>
        </form>

        <h2 class="text-center mt-5 mb-4">Consultas</h2>
        <table class="table table-bordered table-hover table-dark">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Médico</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_consultas = "SELECT c.data_consulta, c.hora_consulta, m.nome AS medico_nome, c.notas_obs 
                                  FROM consultas c 
                                  JOIN medicos m ON c.id_medico = m.id_medico 
                                  WHERE c.id_paciente = ?";
                $stmt_consultas = $conn->prepare($sql_consultas);
                $stmt_consultas->bind_param('i', $paciente['id_paciente']);
                $stmt_consultas->execute();
                $result_consultas = $stmt_consultas->get_result();

                if ($result_consultas->num_rows > 0) {
                    while ($consulta = $result_consultas->fetch_assoc()) {
                        echo "<tr>
                                <td>{$consulta['data_consulta']}</td>
                                <td>{$consulta['hora_consulta']}</td>
                                <td>{$consulta['medico_nome']}</td>
                                <td>{$consulta['notas_obs']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhuma consulta encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="text-center mt-5 mb-4">Prescrições</h2>
        <table class="table table-bordered table-hover table-dark">
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>Dosagem</th>
                    <th>Frequência</th>
                    <th>Duração</th>
                    <th>Instruções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_prescricoes = "SELECT p.nome_medicamento, p.dosagem, p.frequencia, p.duracao, p.instrucoes 
                                    FROM prescricoes p 
                                    JOIN consultas c ON p.id_consulta = c.id_consulta 
                                    WHERE c.id_paciente = ?";
                $stmt_prescricoes = $conn->prepare($sql_prescricoes);
                $stmt_prescricoes->bind_param('i', $paciente['id_paciente']);
                $stmt_prescricoes->execute();
                $result_prescricoes = $stmt_prescricoes->get_result();

                if ($result_prescricoes->num_rows > 0) {
                    while ($prescricao = $result_prescricoes->fetch_assoc()) {
                        echo "<tr>
                                <td>{$prescricao['nome_medicamento']}</td>
                                <td>{$prescricao['dosagem']}</td>
                                <td>{$prescricao['frequencia']}</td>
                                <td>{$prescricao['duracao']}</td>
                                <td>{$prescricao['instrucoes']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma prescrição encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Logout button -->
    <div class="text-center mt-4">
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
			<br><br>
        </form>
    </div>
 
	<footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>