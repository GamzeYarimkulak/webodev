<?php
function registerUser($conn, $username, $password) {
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    return $stmt->execute();
}

function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function addPlant($conn, $name, $description, $care_instructions, $added_by) {
    $stmt = $conn->prepare("INSERT INTO plants (name, description, care_instructions, added_by) VALUES (:name, :description, :care_instructions, :added_by)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':care_instructions', $care_instructions);
    $stmt->bindParam(':added_by', $added_by);
    return $stmt->execute();
}

function getPlants($conn, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM plants WHERE added_by = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPlant($conn, $id, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM plants WHERE id = :id AND added_by = :user_id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updatePlant($conn, $id, $name, $description, $care_instructions, $user_id) {
    $stmt = $conn->prepare("UPDATE plants SET name = :name, description = :description, care_instructions = :care_instructions WHERE id = :id AND added_by = :user_id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':care_instructions', $care_instructions);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    return $stmt->execute();
}

function deletePlant($conn, $id, $user_id) {
    $stmt = $conn->prepare("DELETE FROM plants WHERE id = :id AND added_by = :user_id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    return $stmt->execute();
}
?>
