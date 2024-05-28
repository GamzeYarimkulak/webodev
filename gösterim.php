<?php
include 'includes/dosyam.php';
include 'includes/yapi.php';
include 'includes/fonksiyonlarim.php';

$plants = getPlants($conn, $_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="heet" href="css/sekil.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <a href="ekleme.php" class="btn btn-primary">Add Plant</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Care Instructions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plants as $plant): ?>
                <tr>
                    <td><?php echo htmlspecialchars($plant['name']); ?></td>
                    <td><?php echo htmlspecialchars($plant['description']); ?></td>
                    <td><?php echo htmlspecialchars($plant['care_instructions']); ?></td>
                    <td>
                        <a href="edit_plant.php?id=<?php echo $plant['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="silme.php?id=<?php echo $plant['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
