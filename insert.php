<?php
// Include your database configuration file
require("model.php");

// Check if the form is submitted
if(isset($_POST['insertUsers'])) {
    // Get the input data from the form
    $newID = $_POST['newID'];
    $newName = $_POST['newName'];

    // Sanitize input to prevent SQL injection
    $newID = intval($newID);
    $newName = htmlspecialchars($newName);

    try {
        // Establish a database connection using PDO
        $pdo = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
            DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Prepare the insert statement
        $stmt = $pdo->prepare("INSERT INTO `users` (`id`, `name`) VALUES (:newID, :newName)");

        // Execute the insert statement with parameter bindings
        $stmt->execute(array(":newID" => $newID, ":newName" => $newName));

        // Output success message
        echo "New user inserted successfully.";
    } catch(PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
