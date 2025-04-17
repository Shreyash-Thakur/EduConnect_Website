<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  header("Location: login.php");
  exit();
}

$student_id = $_SESSION['user_id'];
$program_id = isset($_GET['program_id']) ? intval($_GET['program_id']) : 0;

if ($program_id <= 0) {
  $_SESSION['error'] = "Invalid program selected.";
  header("Location: student-dashboard.php");
  exit();
}

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Check if already registered
$check = $pdo->prepare("SELECT * FROM enrollments WHERE user_id = :user AND program_id = :program");
$check->execute(['user' => $student_id, 'program' => $program_id]);

if ($check->rowCount() > 0) {
  $_SESSION['error'] = "You are already registered for this program.";
  header("Location: student-dashboard.php");
  exit();
}

// Register student
$stmt = $pdo->prepare("INSERT INTO enrollments (user_id, program_id) VALUES (:user, :program)");
$stmt->execute(['user' => $student_id, 'program' => $program_id]);

$_SESSION['success'] = "You have been successfully registered for the program!";
header("Location: student-dashboard.php");
exit();
?>
