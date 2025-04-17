<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  die("Unauthorized access.");
}

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$student_id = $_SESSION['user_id'];
$program_id = $_GET['program_id'] ?? 0;

$stmt = $pdo->prepare("DELETE FROM enrollments WHERE user_id = :uid AND program_id = :pid");
$stmt->execute([
  'uid' => $student_id,
  'pid' => $program_id
]);

header("Location: student-profile.php?dropped=1");
exit();
