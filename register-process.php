<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'student'; // default is student

// Validate input
if (empty($name) || empty($email) || empty($password)) {
  die("Please fill all required fields.");
}

// Hash password
$hashed = password_hash($password, PASSWORD_BCRYPT);

// Insert user into DB
$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
$stmt->execute([
  'name' => $name,
  'email' => $email,
  'password' => $hashed,
  'role' => $role
]);

// ✅ Fetch the new user's ID
$_SESSION['user_id'] = $pdo->lastInsertId();
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['role'] = $role;

// ✅ Redirect to correct dashboard
if ($role === 'volunteer') {
  header("Location: volunteer-dashboard.php");
} else {
  header("Location: student-dashboard.php");
}
exit();
