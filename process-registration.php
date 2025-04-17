<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Collect basic form fields
$role = $_POST['role'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Check for duplicate email
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
if ($stmt->rowCount() > 0) {
  $_SESSION['error'] = "Email already registered.";
  header("Location: register.php");
  exit();
}

// Insert into users table
$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (:name, :email, :password, :role, NOW())");
$stmt->execute([
  'name' => $name,
  'email' => $email,
  'password' => $password,
  'role' => $role
]);

$user_id = $pdo->lastInsertId();
$_SESSION['user_id'] = $user_id;
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['role'] = $role;

// Volunteer Details
if ($role === 'volunteer') {
  $qualification = $_POST['qualification'];
  $experience = $_POST['experience'];

  $stmt = $pdo->prepare("INSERT INTO volunteer_profiles (user_id, qualification, experience) VALUES (:user_id, :qualification, :experience)");
  $stmt->execute([
    'user_id' => $user_id,
    'qualification' => $qualification,
    'experience' => $experience
  ]);
}

// Student Details
if ($role === 'student') {
  $age = $_POST['age'];
  $grade = $_POST['grade'];
  $interests = $_POST['interests'];

  $stmt = $pdo->prepare("INSERT INTO student_profiles (user_id, age, grade, interests) VALUES (:user_id, :age, :grade, :interests)");
  $stmt->execute([
    'user_id' => $user_id,
    'age' => $age,
    'grade' => $grade,
    'interests' => $interests
  ]);
}

// Enroll if program_id exists
if (isset($_GET['program_id']) && $role === 'student') {
  $program_id = intval($_GET['program_id']);
  $stmt = $pdo->prepare("INSERT INTO enrollments (user_id, program_id) VALUES (:user_id, :program_id)");
  $stmt->execute([
    'user_id' => $user_id,
    'program_id' => $program_id
  ]);
  header("Location: student-dashboard.php?enrolled=1");
  exit();
}

// Redirect
if ($role === 'student') {
  header("Location: student-dashboard.php");
} elseif ($role === 'volunteer') {
  header("Location: volunteer-dashboard.php");
} else {
  header("Location: index.php");
}
exit();
?>
