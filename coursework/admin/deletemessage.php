<?php
include '../system/include/DatabaseConnection.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}
header("Location: contactmessages.php");
exit();
