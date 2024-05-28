<?php
include 'includes/dosyam.php';
include 'includes/yapi.php';

if (!isset($_GET['id'])) {
    header("Location:gösterim.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $care_instructions = $_POST['care_instructions'];

    $stmt = $conn->prepare("UPDATE plants SET name = :name, description = :description, care_instructions = :care_instructions WHERE id = :id AND added_by = :user_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':care_instructions', $care_instructions);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    if ($stmt->execute()) {
        header("Location: gösterim.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt = $conn->prepare("SELECT * FROM plants WHERE id = :id AND added_by = :user_id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$plant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$plant) {
    header("Location: gösterim.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Plant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Plant</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($plant['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?php echo htmlspecialchars($plant['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Care Instructions</label>
                <textarea name="care_instructions" class="form-control" required><?php echo htmlspecialchars($plant['care_instructions']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Plant</button>
        </form>
    </div>
</body>
</html>
