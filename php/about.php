<?php

include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre a Med+ - Clínica Médica</title>
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
        <h2 class="text-center mb-4">Med+ Sobre Nós</h2>
        <p>
    A <strong>Med+</strong> é uma clínica médica dedicada a oferecer cuidados de saúde de excelência, centrados nas necessidades dos nossos pacientes. Com uma equipa multidisciplinar de médicos altamente qualificados e especializados em diversas áreas, proporcionamos um atendimento integrado, personalizado e humano. Desde consultas de rotina a tratamentos especializados, estamos comprometidos com o bem-estar e a qualidade de vida dos nossos pacientes.
</p>

<p>
    Na <strong>Med+</strong>, acreditamos que a saúde é um bem precioso e que cada pessoa merece o melhor cuidado possível. Por isso, investimos em tecnologias avançadas e um ambiente acolhedor para que os nossos pacientes se sintam seguros e confiantes durante todo o processo de tratamento. Oferecemos uma ampla gama de especialidades médicas, desde a pediatria à geriatria, garantindo que cada etapa da vida dos nossos pacientes seja acompanhada com atenção e profissionalismo.
</p>

<p>
    A nossa missão é promover a saúde e a prevenção de doenças, proporcionando um atendimento de qualidade e um acompanhamento contínuo. Na <strong>Med+</strong>, cuidamos de si, com dedicação e profissionalismo, porque a sua saúde está nas melhores mãos.
</p>

    </div>

    <footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
