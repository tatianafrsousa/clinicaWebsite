<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db_connect.php';

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $id_consulta = $_POST['id_consulta'];
	$id_paciente = $_POST['id_paciente'];
    $nome_medicamento = $_POST['nome_medicamento'];
    $dosagem = $_POST['dosagem'];
    $frequencia = $_POST['frequencia'];
    $duracao = $_POST['duracao'];
    $instrucoes = $_POST['instrucoes'];


    if (!$id_consulta) {
        $id_paciente = $_POST['id_paciente'];  
        $sql_consulta = "SELECT id_consulta FROM consultas WHERE id_paciente = ? ORDER BY data_consulta DESC LIMIT 1";
        $stmt_consulta = $conn->prepare($sql_consulta);
        $stmt_consulta->bind_param('i', $id_paciente);
        $stmt_consulta->execute();
        $stmt_consulta->bind_result($id_consulta);
        $stmt_consulta->fetch();
        $stmt_consulta->close();
        
        if (!$id_consulta) {
            echo json_encode(['success' => false, 'error' => 'No consulta found for this paciente']);
            exit;
        }
    }


    if (!$id_consulta || !$nome_medicamento || !$dosagem || !$frequencia || !$duracao || !$instrucoes) {
        echo json_encode(['success' => false, 'error' => 'Missing required fields']);
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



    $sql = "INSERT INTO prescricoes (id_consulta, nome_medicamento, dosagem, frequencia, duracao, instrucoes) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssss', $id_consulta, $nome_medicamento, $dosagem, $frequencia, $duracao, $instrucoes);

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
