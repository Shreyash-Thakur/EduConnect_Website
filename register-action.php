<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Collect form input
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Validate
if (!$name || !$email || !$password || !$role) {
  die("All required fields are missing.");
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert into `users` table
$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $email, $hashedPassword, $role]);

$user_id = $pdo->lastInsertId();

// Insert role-specific data
if ($role === 'student') {
  $age = $_POST['age'] ?? null;
  $class = $_POST['class'] ?? null;
  $city = $_POST['city'] ?? null;

  $stmt = $pdo->prepare("INSERT INTO students (user_id, age, class, city) VALUES (?, ?, ?, ?)");
  $stmt->execute([$user_id, $age, $class, $city]);

} elseif ($role === 'volunteer') {
  $qualification = $_POST['qualification'] ?? '';
  $experience = $_POST['experience'] ?? 0;
  $phone = $_POST['phone'] ?? '';

  $stmt = $pdo->prepare("INSERT INTO volunteers (user_id, qualification, experience, phone) VALUES (?, ?, ?, ?)");
  $stmt->execute([$user_id, $qualification, $experience, $phone]);
}

// Set session
$_SESSION['user_id'] = $user_id;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['role'] = $role;

// Redirect
if ($role === 'student') {
  header("Location: student-dashboard.php");
} elseif ($role === 'volunteer') {
  header("Location: volunteer-dashboard.php");
} else {
  header("Location: index.php");
}
exit();
