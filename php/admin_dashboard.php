<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql_medico = "SELECT * FROM medicos WHERE user_id = ?";
$stmt = $conn->prepare($sql_medico);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result_medico = $stmt->get_result();

if ($result_medico->num_rows > 0) {
    $medico = $result_medico->fetch_assoc();
} else {
    echo "<script>alert('Erro: Médico não encontrado.'); window.location.href = 'login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados do médico (somente contato e email)
    $contato = $_POST['contato'];
    $email = $_POST['email'];

    $sql_update = "UPDATE medicos SET contato = ?, email = ? WHERE id_medico = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('ssi', $contato, $email, $medico['id_medico']);
    $stmt_update->execute();

    // Atualiza a informação de sessão com o novo email
    $_SESSION['username'] = $email;

    echo "<script>alert('Informações atualizadas com sucesso!'); window.location.href = 'admin_dashboard.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="PT-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Med+ - Perfil de Médico</title>
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
        <form method="POST" action="admin_dashboard.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" value="<?= $medico['nome'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="apelido" class="form-label">Apelido</label>
                <input type="text" class="form-control" id="apelido" value="<?= $medico['apelido'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="especialidade" class="form-label">Especialidade</label>
                <input type="text" class="form-control" id="especialidade" value="<?= $medico['id_especialidade'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="contato" class="form-label">Contato</label>
                <input type="text" class="form-control" id="contato" name="contato" value="<?= $medico['contato'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $medico['email'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar Informações</button>
        </form>

        <h2 class="text-center mt-5 mb-4">Consultas</h2>
        <table class="table table-bordered table-hover table-dark" id="consultasTable">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Motivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
				<?php
				$sql_consultas = "SELECT c.id_consulta, c.data_consulta, c.hora_consulta, p.id_paciente, p.nome AS paciente_nome, c.notas_obs 
								  FROM consultas c 
								  JOIN pacientes p ON c.id_paciente = p.id_paciente 
								  WHERE c.id_medico = ?";
				$stmt_consultas = $conn->prepare($sql_consultas);
				$stmt_consultas->bind_param('i', $medico['id_medico']);
				$stmt_consultas->execute();
				$result_consultas = $stmt_consultas->get_result();

				if ($result_consultas->num_rows > 0) {
					while ($consulta = $result_consultas->fetch_assoc()) {
						?>
						<tr>
							<td><?= $consulta['data_consulta']; ?></td>
							<td><?= $consulta['hora_consulta']; ?></td>
							<td><?= $consulta['paciente_nome']; ?></td>
							<td><?= $consulta['notas_obs']; ?></td>
							<td>
								<button class="btn btn-sm btn-info" 
								  data-id="<?= $consulta['id_consulta']; ?>"
								data-paciente-id="<?= $consulta['id_paciente']; ?>"
								  data-paciente-nome="<?= $consulta['paciente_nome'] ?>"
								  onclick="openNewPrescricaoModal(this)">
								  Nova Prescrição
								</button>
								<button class="btn btn-sm btn-warning" 
								  data-id="<?= $consulta['id_consulta']; ?>" 
								  data-data-consulta="<?= addslashes($consulta['data_consulta']); ?>" 
								  data-hora-consulta="<?= addslashes($consulta['hora_consulta']); ?>" 
								  data-notas-obs="<?= addslashes($consulta['notas_obs']); ?>" 
								  onclick="openConsultationModal(this)">
								  Editar
								</button>
								<button class='btn btn-sm btn-danger' 
									onclick="if(confirm('Tem certeza que deseja eliminar esta consulta?')) { window.location.href='delete_consulta_process.php?id=<?= $consulta['id_consulta'] ?>'; }">
									Eliminar
								</button>
								
							</td>
						</tr>
						<?php
					}
				} else {
					echo "<tr><td colspan='5'>Nenhuma consulta encontrada.</td></tr>";
				}
				?>
			</tbody>
        </table>

        <h2 class="text-center mt-5 mb-4">Prescrições</h2>
        <table class="table table-bordered table-hover table-dark" id="prescricoesTable">
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>Dose</th>
                    <th>Frequência</th>
                    <th>Duração</th>
                    <th>Instruções</th>
					<th>Ações</th>
                </tr>
            </thead>
            <tbody id="prescricoesTableBody">
				<?php
				$sql_prescricoes = "SELECT p.id_prescricao, p.nome_medicamento, p.dosagem, p.frequencia, p.duracao, p.instrucoes 
									FROM prescricoes p 
									JOIN consultas c ON p.id_consulta = c.id_consulta 
									WHERE c.id_medico = ?";
				$stmt_prescricoes = $conn->prepare($sql_prescricoes);
				$stmt_prescricoes->bind_param('i', $medico['id_medico']);
				$stmt_prescricoes->execute();
				$result_prescricoes = $stmt_prescricoes->get_result();

				if ($result_prescricoes->num_rows > 0) {
					while ($prescricao = $result_prescricoes->fetch_assoc()) {
						?>
						<tr>
							<td><?= $prescricao['nome_medicamento']; ?></td>
							<td><?= $prescricao['dosagem']; ?></td>
							<td><?= $prescricao['frequencia']; ?></td>
							<td><?= $prescricao['duracao']; ?></td>
							<td><?= $prescricao['instrucoes']; ?></td>
							<td>
								<button class="btn btn-sm btn-warning" 
								  data-id="<?= $prescricao['id_prescricao']; ?>" 
								  data-nome-medicamento="<?= addslashes($prescricao['nome_medicamento']); ?>" 
								  data-dosagem="<?= addslashes($prescricao['dosagem']); ?>" 
								  data-frequencia="<?= addslashes($prescricao['frequencia']); ?>" 
								  data-duracao="<?= addslashes($prescricao['duracao']); ?>" 
								  data-instrucoes="<?= addslashes($prescricao['instrucoes']); ?>" 
								  onclick="openPrescriptionModal(this)" style="margin-bottom: 2px;">
								  &nbsp;&nbsp;Editar&nbsp;&nbsp;
								</button>
								
								<button class='btn btn-sm btn-danger' 
									onclick="if(confirm('Tem certeza que deseja eliminar esta prescrição?')) { window.location.href='delete_prescricao_process.php?id=<?= $prescricao['id_prescricao'] ?>'; }">
									Eliminar&nbsp;
								 </button>
							</td>
						</tr>
						<?php
					}
				} else {
					echo "<tr><td colspan='6'>Nenhuma prescrição encontrada.</td></tr>";
				}
				?>
			</tbody>

        </table>
		
		<h2 class="text-center mt-5 mb-4">Pacientes - Marcar Nova Consulta</h2>
		<table class="table table-bordered table-hover table-dark">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Apelido</th>
					<th>Data de Nascimento</th>
					<th>Sexo</th>
					<th>Contato</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql_pacientes = "SELECT id_paciente, nome, apelido, data_nascimento, sexo, contato FROM pacientes";
				$result_pacientes = $conn->query($sql_pacientes);

				if ($result_pacientes->num_rows > 0) {
					while ($paciente = $result_pacientes->fetch_assoc()) {
						?>
						<tr>
							<td><?= $paciente['nome'] ?></td>
							<td><?= $paciente['apelido'] ?></td>
							<td><?= $paciente['data_nascimento'] ?></td>
							<td><?= $paciente['sexo'] == 'M' ? 'Masculino' : 'Feminino'; ?></td>
							<td><?= $paciente['contato'] ?></td>
							<td>
								<button class="btn btn-sm btn-success" 
								  data-id="<?= $paciente['id_paciente'] ?>" 
								  data-nome="<?= $paciente['nome'] ?>"
								  onclick="openNewConsultaModal(this)">
								  Marcar Consulta
								</button>
							</td>
						</tr>
						<?php
					}
				} else {
					echo "<tr><td colspan='6'>Nenhum paciente encontrado.</td></tr>";
				}
				?>
			</tbody>
		</table>

		
    </div>

    <div class="text-center mt-4">
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
			<br><br>
        </form>
		
    </div>

    <footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2024 Clinica Médica Med+. Todos os direitos reservados.</p>
    </footer>
	
	<!-- Modal para editar Consultas -->
<div id="editConsultationModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Consulta</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="consultationForm">
          <input type="hidden" id="id_consulta" name="id_consulta">
          <div class="form-group">
            <label for="data_consulta">Data</label>
            <input type="date" class="form-control" id="data_consulta" name="data_consulta" required>
          </div>
          <div class="form-group">
            <label for="hora_consulta">Hora</label>
            <input type="time" class="form-control" id="hora_consulta" name="hora_consulta" required>
          </div>
          <div class="form-group">
            <label for="notas_obs">Notas</label>
            <textarea class="form-control" id="notas_obs" name="notas_obs" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="submitConsultationForm()">Salvar Mudanças</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar Prescricoes -->
<div id="editPrescriptionModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Prescrição</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="prescriptionForm">
          <input type="hidden" id="id_prescricao" name="id_prescricao">
          <div class="form-group">
            <label for="nome_medicamento">Medicamento</label>
            <input type="text" class="form-control" id="nome_medicamento" name="nome_medicamento" required>
          </div>
          <div class="form-group">
            <label for="dosagem">Dosagem</label>
            <input type="text" class="form-control" id="dosagem" name="dosagem" required>
          </div>
          <div class="form-group">
            <label for="frequencia">Frequência</label>
            <input type="text" class="form-control" id="frequencia" name="frequencia" required>
          </div>
          <div class="form-group">
            <label for="duracao">Duração</label>
            <input type="text" class="form-control" id="duracao" name="duracao" required>
          </div>
          <div class="form-group">
            <label for="instrucoes">Instruções</label>
            <textarea class="form-control" id="instrucoes" name="instrucoes" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="submitPrescriptionForm()">Salvar Mudanças</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Nova Consulta -->
<div id="openNewConsultaModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Marcar Nova Consulta para <span id="pacienteNome"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newConsultationForm">
          <input type="hidden" name="id_paciente" id="id_paciente" />
          <div class="mb-3">
            <label for="data_consulta" class="form-label">Data</label>
            <input type="date" class="form-control" name="data_consulta" id="data_consulta" required />
          </div>
          <div class="mb-3">
            <label for="hora_consulta" class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora_consulta" id="hora_consulta" required />
          </div>
          <div class="mb-3">
            <label for="notas_obs" class="form-label">Notas</label>
            <textarea class="form-control" name="notas_obs" id="notas_obs" rows="3"></textarea>
            <br>
          </div>

          <button type="button" class="btn btn-primary" onclick="submitNewConsultationForm(event)">Marcar Consulta</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Nova Prescrição -->
<div id="openNewPrescricaoModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nova Prescrição para <span id="pacienteNomePrescricao"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newPrescriptionForm">

          <input type="hidden" name="id_consulta" id="id_consulta_hidden" />
          <input type="hidden" name="id_paciente" id="id_paciente_hidden" />


          <div class="mb-3">
            <label for="id_consulta_display" class="form-label">Consulta ID</label>
            <input type="text" class="form-control" id="id_consulta_display" disabled />
          </div>
          <div class="mb-3">
            <label for="id_paciente_display" class="form-label">Paciente ID</label>
            <input type="text" class="form-control" id="id_paciente_display" disabled />
          </div>


          <div class="mb-3">
            <label for="nome_medicamento" class="form-label">Medicamento</label>
            <input type="text" class="form-control" name="nome_medicamento" id="nome_medicamento" required />
          </div>
          <div class="mb-3">
            <label for="dosagem" class="form-label">Dosagem</label>
            <input type="text" class="form-control" name="dosagem" id="dosagem" required />
          </div>
          <div class="mb-3">
            <label for="frequencia" class="form-label">Frequência</label>
            <input type="text" class="form-control" name="frequencia" id="frequencia" required />
          </div>
          <div class="mb-3">
            <label for="duracao" class="form-label">Duração</label>
            <input type="text" class="form-control" name="duracao" id="duracao" required />
          </div>
          <div class="mb-3">
            <label for="instrucoes" class="form-label">Instruções</label>
            <textarea class="form-control" name="instrucoes" id="instrucoes" rows="3"></textarea>
          </div>
          
          <button type="button" class="btn btn-primary" onclick="submitNewPrescriptionForm(event)">Criar Prescrição</button>
        </form>
      </div>
    </div>
  </div>
</div>





	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-QJZzUVzMiN1Y0d4z3V1l9XxWhcOcO7X5u4T1lf+k0nKpEQm5U5clDvBfkI5p36R4" crossorigin="anonymous"></script>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-WffSCQsNkyDvyINrE1Dv2T8OmIHC1l/K+9C1DH/wCZ2im0I8Z7NKKZqiVsHT8nMG" crossorigin="anonymous"></script>

	<script>
  // Open the Consultation Edit Modal with data from button's data attributes
  function openConsultationModal(button) {
    const id_consulta = button.getAttribute('data-id');
    const data_consulta = button.getAttribute('data-data-consulta');
    const hora_consulta = button.getAttribute('data-hora-consulta');
    const notas_obs = button.getAttribute('data-notas-obs');

    // Populate the modal fields with the extracted values
    document.getElementById('id_consulta').value = id_consulta;
    document.getElementById('data_consulta').value = data_consulta;
    document.getElementById('hora_consulta').value = hora_consulta;
    document.getElementById('notas_obs').value = notas_obs;

    // Show the modal using Bootstrap's modal method
    new bootstrap.Modal(document.getElementById('editConsultationModal')).show();
  }

  // Submit the consultation form via AJAX
  function submitConsultationForm() {
    const formData = new FormData(document.getElementById('consultationForm'));

    fetch('update_consultas.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert('Consulta atualizada com sucesso!');
        location.reload();
      } else {
        alert('Erro ao atualizar consulta.');
      }
    })
    .catch(error => console.error('Error:', error));
  }

  // Open the Prescription Edit Modal with data from button's data attributes
  function openPrescriptionModal(button) {
    const id_prescricao = button.getAttribute('data-id');
    const nome_medicamento = button.getAttribute('data-nome-medicamento');
    const dosagem = button.getAttribute('data-dosagem');
    const frequencia = button.getAttribute('data-frequencia');
    const duracao = button.getAttribute('data-duracao');
    const instrucoes = button.getAttribute('data-instrucoes');

    // Populate the modal fields with the extracted values
    document.getElementById('id_prescricao').value = id_prescricao;
    document.getElementById('nome_medicamento').value = nome_medicamento;
    document.getElementById('dosagem').value = dosagem;
    document.getElementById('frequencia').value = frequencia;
    document.getElementById('duracao').value = duracao;
    document.getElementById('instrucoes').value = instrucoes;

    // Show the modal using Bootstrap's modal method
    new bootstrap.Modal(document.getElementById('editPrescriptionModal')).show();
  }

  // Submit the prescription form via AJAX
  function submitPrescriptionForm() {
    const formData = new FormData(document.getElementById('prescriptionForm'));

    fetch('update_prescricoes.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert('Prescrição atualizada com sucesso!');
        location.reload();
      } else {
        alert('Erro ao atualizar prescrição.');
      }
    })
    .catch(error => console.error('Error:', error));
  }
  
// Open New Consultation Modal for Paciente
function openNewConsultaModal(button) {
  const id_paciente = button.getAttribute('data-id');
  const pacienteNome = button.getAttribute('data-nome');

  // Populate the modal with the selected patient's info
  document.getElementById('id_paciente').value = id_paciente;
  document.getElementById('pacienteNome').innerText = pacienteNome;

  // Show the modal using Bootstrap's modal method
  const modalElement = document.getElementById('openNewConsultaModal');
  const modalInstance = new bootstrap.Modal(modalElement);
  modalInstance.show(); // Open the modal
}


// Function to submit the New Consultation Form via AJAX
function submitNewConsultationForm(event) {
  event.preventDefault();

  const formData = new FormData(document.getElementById('newConsultationForm'));

  // Submit the form via AJAX
  fetch('add_consulta_process.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(result => {
      console.log(result); // Log the result for debugging
      if (result.success) {
        alert('Consulta marcada com sucesso!');

        // Refresh the table dynamically
        fetch('fetch_consultas.php')
          .then(response => response.text())
          .then(tableHTML => {
            document.getElementById('consultasTable').innerHTML = tableHTML;

            // Close the modal
            const modalElement = document.getElementById('openNewConsultaModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
          })
          .catch(error => console.error('Error fetching consultations:', error));
      } else {
        alert('Erro ao marcar consulta: ' + result.error);
      }
    })
    .catch(error => {
      console.error('Error submitting consultation:', error);
      alert('Erro ao marcar consulta.');
    });
}

// Opening the Nova Prescrição modal
function openNewPrescricaoModal(button) {
  const id_consulta = button.getAttribute('data-id');
  const id_paciente = button.getAttribute('data-paciente-id');
  const pacienteNome = button.getAttribute('data-paciente-nome');
  
  console.log("id_consulta:", id_consulta);
  console.log("id_paciente:", id_paciente);

  // Populate both hidden inputs and disabled inputs with the same values
  document.getElementById('id_consulta_hidden').value = id_consulta;
  document.getElementById('id_paciente_hidden').value = id_paciente;
  
  document.getElementById('id_consulta_display').value = id_consulta;
  document.getElementById('id_paciente_display').value = id_paciente;
  
  document.getElementById('pacienteNomePrescricao').innerText = pacienteNome;

  // Show the modal using Bootstrap's modal method
  const modal = new bootstrap.Modal(document.getElementById('openNewPrescricaoModal'));
  modal.show(); // Open the modal
}



// Function to submit the New Prescricao Form via AJAX
function submitNewPrescriptionForm(event) {
  event.preventDefault();

  // Gather form data
  const formData = new FormData(document.getElementById('newPrescriptionForm'));

  // Debugging: log form data
  for (var pair of formData.entries()) {
    console.log(pair[0] + ': ' + pair[1]);
  }

  // Submit the form via AJAX
  fetch('add_prescricao_process.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert('Prescrição criada com sucesso!');

        // Refresh the table dynamically
		fetch('fetch_prescricoes.php')
		  .then(response => response.text())
		  .then(tableHTML => {
			document.getElementById('prescricoesTableBody').innerHTML = tableHTML;

            // Close the modal
            const modalElement = document.getElementById('openNewPrescricaoModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
          })
          .catch(error => console.error('Error fetching prescriptions:', error));
      } else {
        alert('Erro ao criar prescrição.');
      }
    })
    .catch(error => console.error('Error submitting prescription:', error));
}



</script>

</body>
</html>
