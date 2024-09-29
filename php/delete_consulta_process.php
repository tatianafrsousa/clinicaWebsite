<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id_consulta = $_GET['id'];

    $sql = "DELETE FROM consultas WHERE id_consulta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_consulta);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?success=consulta_deleted');
    } else {
        echo "Erro ao eliminar consulta.";
    }
    $stmt->close();
    $conn->close();
}
?>
