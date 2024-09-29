<?php
include 'db_connect.php'; // Removed 'php/' since this file is in the same folder

$sql = "SELECT medicos.nome, medicos.apelido, medicos.contato, medicos.email, especialidades.nome_especialidade 
        FROM medicos 
        JOIN especialidades ON medicos.id_especialidade = especialidades.id_especialidade";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Med+ - Médicos</title>
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
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Todos os Médicos</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($medico = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $medico['nome'] . " " . $medico['apelido'] . "</h5>";
                    echo "<p class='card-text'><strong>Especialidade:</strong> " . $medico['nome_especialidade'] . "</p>";
                    echo "<p class='card-text'><strong>Contato:</strong> " . $medico['contato'] . "</p>";
                    echo "<p class='card-text'><strong>Email:</strong> " . $medico['email'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center'>Nenhum médico encontrado.</p>";
            }
            ?>
        </div>
    </div>
	
	<footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
