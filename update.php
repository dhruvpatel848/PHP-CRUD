<?php
require("model.php");

$pdo = new PDO(
    "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
    DB_USER, DB_PASSWORD, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

if (isset($_POST['updateUsers'])) {
    if (!empty($_POST['update'])) {
        foreach ($_POST['update'] as $id => $newName) {
            // Sanitize input to prevent SQL injection
            $id = intval($id);
            $newName = htmlspecialchars($newName);

            // Prepare the update statement
            $stmt = $pdo->prepare("UPDATE `users` SET `name` = :newName WHERE `id` = :id");

            // Execute the update statement with parameter bindings
            $stmt->execute(array(":newName" => $newName, ":id" => $id));
        }
        echo "Selected users updated successfully.";
    } else {
        echo "No users selected for updating.";
    }
}
?>
