<?php
// (A) DATABASE CONNECTION
require "model.php";

// (B) SEARCH FOR USERS
$results = $_DB->select(
  "SELECT * FROM `users` WHERE `name` LIKE ?",
  ["%{$_POST["search"]}%"]
);

// (C) OUTPUT RESULTS
echo json_encode(count($results)==0 ? null : $results);