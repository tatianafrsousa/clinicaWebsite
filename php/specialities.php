<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Med+ - Especialidades</title>
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
        <h2 class="text-center mb-4">Especialidades Med+</h2>
        <div class="row">
            <!-- Pediatrics -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/newborn.png" class="card-img-top" alt="Pediatria">
                    <div class="card-body">
                        <h5 class="card-title">Pediatria</h5>
                        <p class="card-text">Prestação de cuidado de saúde de crianças e adolescentes.</p>
                        <a href="medicos.php?especialidade=1" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
            <!-- Dermatology -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/dermatology.png" class="card-img-top" alt="Dermatologia">
                    <div class="card-body">
                        <h5 class="card-title">Dermatologia</h5>
                        <p class="card-text">Diagnóstico e tratamento das doenças dermatovenereológicas.</p>
                        <a href="medicos.php?especialidade=2" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
            <!-- Psychiatry -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/psychiatry.png" class="card-img-top" alt="Psiquiatria">
                    <div class="card-body">
                        <h5 class="card-title">Psiquiatria</h5>
                        <p class="card-text">Tratamento de problemas mentais, emocionais ou comportamentais.</p>
                        <a href="medicos.php?especialidade=3" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
			<p></p>
            <!-- Cardiology -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/cardiology.png" class="card-img-top" alt="Cardiologia">
                    <div class="card-body">
                        <h5 class="card-title">Cardiologia</h5>
                        <p class="card-text">Problemas cardíacos e tratamentos cardiovasculares.</p>
                        <a href="medicos.php?especialidade=4" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
            <!-- Nutrition -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/nutritionist.png" class="card-img-top" alt="Nutrição">
                    <div class="card-body">
                        <h5 class="card-title">Nutrição</h5>
                        <p class="card-text">Diagnósticos nutricionais e planeamento alimentar.</p>
                        <a href="medicos.php?especialidade=5" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
            <!-- Psychology -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/psychology.png" class="card-img-top" alt="Psicologia">
                    <div class="card-body">
                        <h5 class="card-title">Psicologia</h5>
                        <p class="card-text">Diagnosticar, compreender e orientar a saúde mental.</p>
                        <a href="medicos.php?especialidade=6" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
			<p></p>
            <!-- Obstetrics -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/obstetrical.png" class="card-img-top" alt="Obstetrícia">
                    <div class="card-body">
                        <h5 class="card-title">Obstetrícia</h5>
                        <p class="card-text">Acompanhamento, aconselhamento e diagnóstico pré-natal.</p>
                        <a href="medicos.php?especialidade=7" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
            <!-- Surgery -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/surgery.png" class="card-img-top" alt="Cirurgia">
                    <div class="card-body">
                        <h5 class="card-title">Cirurgia</h5>
                        <p class="card-text">Cirurgias para tratamento de doenças, lesões, entre outros.</p>
                        <a href="medicos.php?especialidade=8" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
            <!-- Neurology -->
            <div class="col-md-4">
                <div class="card especialidade">
                    <img src="assets/neurology.png" class="card-img-top" alt="Neurologia">
                    <div class="card-body">
                        <h5 class="card-title">Neurologia</h5>
                        <p class="card-text">Diagnóstico e tratamento dos distúrbios do sistema nervoso.</p>
                        <a href="medicos.php?especialidade=9" class="btn btn-primary show-on-hover">Médicos</a>
						<p></p>
                    </div>
                </div>
            </div>
			<p></p>
        </div>
    </div>

    <footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
