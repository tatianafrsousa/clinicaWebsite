<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatar - Med+</title>
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
        <h2 class="text-center mb-4">Contatar</h2>
        <form id="contactForm">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea class="form-control" id="message" rows="5" required></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="submitForm()">Enviar</button>
            <br><br>
        </form>
    </div>

    <footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>

    <script>
        function submitForm() {
            alert('Pedido de contato enviado com sucesso!');
            window.location.href = 'index.php';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
