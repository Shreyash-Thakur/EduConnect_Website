<?php
try {
  $dbh = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error: " . $e->getMessage());
}
?>
