<!DOCTYPE html>
<html>
  <head>
    <title>Not really a good design</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- (A) SEARCH FORM -->
    <form method="post">
      <input type="text" name="search" required>
      <input type="submit" value="Search">
    </form>

    <!-- (B) SEARCH + SHOW RESULTS -->
    <form method="post">
      <div id="results"><?php
        if (isset($_POST["search"])) {
          // (B1) DATABASE SETTINGS - CHANGE TO YOUR OWN!
          define("DB_HOST", "localhost");
          define("DB_NAME", "CRUD");
          define("DB_CHARSET", "utf8mb4");
          define("DB_USER", "root");
          define("DB_PASSWORD", "");

          // (B2) CONNECT TO DATABASE
          $pdo = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
            DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
          ]);

          // (B3) SEARCH
          $searchTerm = "%{$_POST["search"]}%";
          $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `name` LIKE ? OR `id` LIKE ?");
          $stmt->execute([$searchTerm, $searchTerm]);
          $results = $stmt->fetchAll();

          // Display results
          if ($results) {
            echo "<ul>";
            foreach ($results as $row) {
              echo "<li>" . htmlspecialchars($row["name"]) . " (ID: " . htmlspecialchars($row["id"]) . ")</li>";
            }
            echo "</ul>";
          } else {
            echo "No results found.";
          }
        }
      ?></div>
    </form>
  </body>
</html>
