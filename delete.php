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
        $deleteIds = implode(',', $_POST['delete']);
        $deleteStmt = $pdo->prepare("DELETE FROM `users` WHERE `id` IN ($deleteIds)");
        $deleteStmt->execute();
        echo "Selected users deleted successfully.";
    } else {
        echo "No users selected for deletion.";
    }
}
?>
