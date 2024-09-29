<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id_prescricao = $_GET['id'];

    $sql = "DELETE FROM prescricoes WHERE id_prescricao = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_prescricao);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?success=prescricao_deleted');
    } else {
        echo "Erro ao eliminar prescrição.";
    }
    $stmt->close();
    $conn->close();
}
?>
