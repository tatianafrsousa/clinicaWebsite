<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db_connect.php';

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_paciente = $_POST['id_paciente'];
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];
    $notas_obs = $_POST['notas_obs'];
	

    if (!$id_paciente || !$data_consulta || !$hora_consulta || !$notas_obs) {
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'Médico não está logado']);
        exit;
    }
    
    $user_id = $_SESSION['user_id'];


    $sql_medico = "SELECT id_medico FROM medicos WHERE user_id = ?";
    $stmt_medico = $conn->prepare($sql_medico);
    if (!$stmt_medico) {
        echo json_encode(['success' => false, 'error' => 'SQL prepare error: ' . $conn->error]);
        exit;
    }
    
    $stmt_medico->bind_param('i', $user_id);
    $stmt_medico->execute();
    $stmt_medico->bind_result($id_medico);
    $stmt_medico->fetch();
    $stmt_medico->close();

    if (!$id_medico) {
        echo json_encode(['success' => false, 'error' => 'No médico found']);
        exit;
    }


    $sql = "INSERT INTO consultas (id_paciente, id_medico, data_consulta, hora_consulta, notas_obs) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'SQL prepare error: ' . $conn->error]);
        exit;
    }
    
    $stmt->bind_param('iisss', $id_paciente, $id_medico, $data_consulta, $hora_consulta, $notas_obs);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
