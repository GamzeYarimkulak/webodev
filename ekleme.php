<?php
include 'includes/dosyam.php';
include 'includes/yapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $care_instructions = $_POST['care_instructions'];
    $added_by = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO plants (name, description, care_instructions, added_by) VALUES (:name, :description, :care_instructions, :added_by)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':care_instructions', $care_instructions);
    $stmt->bindParam(':added_by', $added_by);

    if ($stmt->execute()) {
        header("Location: gösterim.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Plant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Plant</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Care Instructions</label>
                <textarea name="care_instructions" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Plant</button>
        </form>
    </div>
</body>
</html>
