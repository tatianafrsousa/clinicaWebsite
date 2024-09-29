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

$sql_consultas = "SELECT c.id_consulta, c.data_consulta, c.hora_consulta, p.nome AS paciente_nome, c.notas_obs, p.id_paciente 
                  FROM consultas c 
                  JOIN pacientes p ON c.id_paciente = p.id_paciente 
                  WHERE c.id_medico = ?
                  ORDER BY c.data_consulta DESC";
$stmt_consultas = $conn->prepare($sql_consultas);
$stmt_consultas->bind_param('i', $id_medico);
$stmt_consultas->execute();
$result_consultas = $stmt_consultas->get_result();

if ($result_consultas->num_rows > 0) {
  while ($row = $result_consultas->fetch_assoc()) {
    echo "<tr>
            <td>{$row['data_consulta']}</td>
            <td>{$row['hora_consulta']}</td>
            <td>{$row['paciente_nome']}</td>
            <td>{$row['notas_obs']}</td>
            <td>
              <button class='btn btn-sm btn-info' 
                data-id='{$row['id_consulta']}'
                data-paciente-id='{$row['id_paciente']}'
                data-paciente-nome='{$row['paciente_nome']}'
                onclick='openNewPrescricaoModal(this)'>Nova Prescrição
              </button>
              <button class='btn btn-sm btn-warning' 
                data-id='{$row['id_consulta']}' 
                data-data-consulta='{$row['data_consulta']}' 
                data-hora-consulta='{$row['hora_consulta']}' 
                data-notas-obs='{$row['notas_obs']}' 
                onclick='openConsultationModal(this)'>Editar
              </button>
              <button class='btn btn-sm btn-danger' 
                onclick=\"if(confirm('Tem certeza que deseja eliminar esta consulta?')) { window.location.href='delete_consulta_process.php?id={$row['id_consulta']}'; }\">Eliminar
              </button>
            </td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='5'>Nenhuma consulta encontrada.</td></tr>";
}

$stmt_consultas->close();
$conn->close();
?>
