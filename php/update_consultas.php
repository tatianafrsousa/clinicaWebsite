<?php
include 'db_connect.php';

$id_consulta = $_POST['id_consulta'];
$data_consulta = $_POST['data_consulta'];
$hora_consulta = $_POST['hora_consulta'];
$notas_obs = $_POST['notas_obs'];

$sql = "UPDATE consultas SET data_consulta = ?, hora_consulta = ?, notas_obs = ? WHERE id_consulta = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $data_consulta, $hora_consulta, $notas_obs, $id_consulta);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
$stmt->close();
$conn->close();
?>
