<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'volunteer') {
  die("Unauthorized access.");
}

$program_id = $_GET['id'] ?? null;
if (!$program_id) die("Invalid request.");

// DB connection
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Ensure program belongs to logged-in user
$stmt = $pdo->prepare("DELETE FROM programs WHERE id = :id AND created_by = :uid");
$stmt->execute([
  'id' => $program_id,
  'uid' => $_SESSION['user_id']
]);

header("Location: volunteer-dashboard.php");
exit();
