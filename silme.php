<?php
include 'includes/dosyam.php';
include 'includes/yapi.php';

if (!isset($_GET['id'])) {
    header("Location: gösterim.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM plants WHERE id = :id AND added_by = :user_id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':user_id', $_SESSION['user_id']);

if ($stmt->execute()) {
    header("Location: gösterim.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>
