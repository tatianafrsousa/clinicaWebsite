<?php
session_start();
include('db_connect.php');


if (!isset($_SESSION['user_id'])) {
  echo "<tr><td colspan='5'>Erro: Médico não está logado.</td></tr>";
  exit;
}

$user_id = $_SESSION['user_id'];


$query_medico = "SELECT id_medico FROM medicos WHERE user_id = ?";
$stmt_medico = $conn->prepare($query_medico);
$stmt_medico->bind_param('i', $user_id);
$stmt_medico->execute();
$stmt_medico->bind_result($id_medico);
$stmt_medico->fetch();
$stmt_medico->close();

if (!$id_medico) {
  echo "<tr><td colspan='5'>Erro: Médico não encontrado.</td></tr>";
  exit;
}


$query = "SELECT p.id_prescricao, p.nome_medicamento, p.dosagem, p.frequencia, p.duracao, p.instrucoes, c.data_consulta, pac.nome AS paciente_nome
          FROM prescricoes p
          JOIN consultas c ON p.id_consulta = c.id_consulta
          JOIN pacientes pac ON c.id_paciente = pac.id_paciente
          WHERE c.id_medico = ?
          ORDER BY c.data_consulta DESC"; 

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_medico);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nome_medicamento']}</td>
                <td>{$row['dosagem']}</td>
                <td>{$row['frequencia']}</td>
                <td>{$row['duracao']}</td>
                <td>{$row['instrucoes']}</td>
                <td>
                    <button class='btn btn-sm btn-warning' 
                        data-id='{$row['id_prescricao']}' 
                        data-nome-medicamento='{$row['nome_medicamento']}'
                        data-dosagem='{$row['dosagem']}'
                        data-frequencia='{$row['frequencia']}'
                        data-duracao='{$row['duracao']}'
                        data-instrucoes='{$row['instrucoes']}'
                        onclick='openPrescriptionModal(this)' style='margin-bottom: 2px;'>Editar
                    </button>
                    
                    <button class='btn btn-sm btn-danger' 
                        onclick=\"if(confirm('Tem certeza que deseja eliminar esta prescrição?')) { window.location.href='delete_prescricao_process.php?id={$row['id_prescricao']}'; }\">Eliminar
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nenhuma prescrição encontrada.</td></tr>";
}

$stmt->close();
$conn->close();
?>
