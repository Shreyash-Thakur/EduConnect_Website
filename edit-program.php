<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'volunteer') {
  die("Unauthorized access.");
}

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$program_id = $_GET['id'] ?? null;

// Fetch program
$stmt = $pdo->prepare("SELECT * FROM programs WHERE id = :id AND created_by = :user_id");
$stmt->execute(['id' => $program_id, 'user_id' => $_SESSION['user_id']]);
$program = $stmt->fetch();

if (!$program) {
  die("Program not found or you do not have access.");
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'title' => $_POST['title'],
    'subject' => $_POST['subject'],
    'description' => $_POST['description'],
    'date' => $_POST['date'],
    'time' => $_POST['time'],
    'duration' => $_POST['duration'],
    'mode' => $_POST['mode'],
    'location' => $_POST['location'],
    'level' => $_POST['level'],
    'age_group' => $_POST['age_group'],
    'capacity' => $_POST['capacity'],
    'id' => $program_id
  ];

  $update = $pdo->prepare("UPDATE programs SET 
    title = :title, subject = :subject, description = :description,
    date = :date, time = :time, duration = :duration,
    mode = :mode, location = :location,
    level = :level, age_group = :age_group, capacity = :capacity
    WHERE id = :id");

  $update->execute($data);
  header("Location: volunteer-dashboard.php");
  exit();
}
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <h3>Edit Program: <?= htmlspecialchars($program['title']) ?></h3>
  <form method="POST" class="row g-3 mt-3">
    <div class="col-md-6">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="<?= $program['title'] ?>" required>
    </div>
    <div class="col-md-6">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control" value="<?= $program['subject'] ?>">
    </div>
    <div class="col-12">
      <label>Description</label>
      <textarea name="description" class="form-control"><?= $program['description'] ?></textarea>
    </div>
    <div class="col-md-4">
      <label>Date</label>
      <input type="date" name="date" class="form-control" value="<?= $program['date'] ?>" required>
    </div>
    <div class="col-md-4">
      <label>Time</label>
      <input type="time" name="time" class="form-control" value="<?= $program['time'] ?>" required>
    </div>
    <div class="col-md-4">
      <label>Duration</label>
      <input type="number" name="duration" class="form-control" value="<?= $program['duration'] ?>">
    </div>
    <div class="col-md-6">
      <label>Mode</label>
      <select name="mode" class="form-select">
        <option <?= $program['mode'] === 'online' ? 'selected' : '' ?>>online</option>
        <option <?= $program['mode'] === 'offline' ? 'selected' : '' ?>>offline</option>
      </select>
    </div>
    <div class="col-md-6">
      <label>Venue / Platform</label>
      <input type="text" name="location" class="form-control" value="<?= $program['location'] ?>">
    </div>
    <div class="col-md-4">
      <label>Level</label>
      <select name="level" class="form-select">
        <option <?= $program['level'] === 'Beginner' ? 'selected' : '' ?>>Beginner</option>
        <option <?= $program['level'] === 'Intermediate' ? 'selected' : '' ?>>Intermediate</option>
        <option <?= $program['level'] === 'Advanced' ? 'selected' : '' ?>>Advanced</option>
      </select>
    </div>
    <div class="col-md-4">
      <label>Age Group</label>
      <select name="age_group" class="form-select">
        <option <?= $program['age_group'] === '6–10' ? 'selected' : '' ?>>6–10</option>
        <option <?= $program['age_group'] === '11–14' ? 'selected' : '' ?>>11–14</option>
        <option <?= $program['age_group'] === '15–18' ? 'selected' : '' ?>>15–18</option>
      </select>
    </div>
    <div class="col-md-4">
      <label>Max Capacity</label>
      <input type="number" name="capacity" class="form-control" value="<?= $program['capacity'] ?>">
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Save Changes</button>
    </div>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
