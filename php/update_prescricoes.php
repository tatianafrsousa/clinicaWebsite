<?php
include 'db_connect.php';

$id_prescricao = $_POST['id_prescricao'];
$nome_medicamento = $_POST['nome_medicamento'];
$dosagem = $_POST['dosagem'];
$frequencia = $_POST['frequencia'];
$duracao = $_POST['duracao'];
$instrucoes = $_POST['instrucoes'];

$sql = "UPDATE prescricoes SET nome_medicamento = ?, dosagem = ?, frequencia = ?, duracao = ?, instrucoes = ? WHERE id_prescricao = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssi', $nome_medicamento, $dosagem, $frequencia, $duracao, $instrucoes, $id_prescricao);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
$stmt->close();
$conn->close();
?>
