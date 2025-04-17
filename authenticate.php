<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Check if user exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
  // Login success
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['name'] = $user['name'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['role'] = $user['role'];

  // Redirect based on role
  if ($user['role'] === 'volunteer') {
    header("Location: volunteer-dashboard.php");
  } elseif ($user['role'] === 'student') {
    header("Location: student-dashboard.php");
  } elseif ($user['role'] === 'admin') {
    header("Location: admin-dashboard.php");
  } else {
    echo "Unknown role.";
  }
  exit();
} else {
  echo "<h3 style='color: red;'>Invalid email or password.</h3>";
}
?>
