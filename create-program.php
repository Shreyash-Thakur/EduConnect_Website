<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login & role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'volunteer') {
  die("Unauthorized access.");
}

// DB connection
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Collect form data
$title       = $_POST['title'];
$subject     = $_POST['subject'];
$description = $_POST['description'];
$date        = $_POST['date'];
$time        = $_POST['time'];
$duration    = $_POST['duration'];
$mode        = $_POST['mode'];
$location    = $_POST['location'];
$level       = $_POST['level'];
$age_group   = $_POST['age_group'];
$capacity    = $_POST['capacity'];
$meet_link   = $_POST['meet_link'] ?? null;
$created_by  = $_SESSION['user_id'];

// Insert into DB with meet_link
$sql = "INSERT INTO programs 
(title, subject, description, date, time, duration, mode, location, level, age_group, capacity, meet_link, created_by) 
VALUES 
(:title, :subject, :description, :date, :time, :duration, :mode, :location, :level, :age_group, :capacity, :meet_link, :created_by)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':title'       => $title,
  ':subject'     => $subject,
  ':description' => $description,
  ':date'        => $date,
  ':time'        => $time,
  ':duration'    => $duration,
  ':mode'        => $mode,
  ':location'    => $location,
  ':level'       => $level,
  ':age_group'   => $age_group,
  ':capacity'    => $capacity,
  ':meet_link'   => $meet_link,
  ':created_by'  => $created_by
]);

// Redirect
header("Location: volunteer-dashboard.php");
exit();
?>
