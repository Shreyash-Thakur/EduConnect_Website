<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'volunteer') {
  die("Unauthorized access.");
}

$program_id = $_GET['id'] ?? null;
if (!$program_id) die("Program ID missing.");

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");

// Get participants
$stmt = $pdo->prepare("
  SELECT u.name, u.email 
  FROM enrollments e
  JOIN users u ON e.user_id = u.id
  WHERE e.program_id = :program_id
");
$stmt->execute(['program_id' => $program_id]);
$students = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <h3 class="mb-4">Participants for Program #<?= $program_id ?></h3>
  <?php if (count($students) === 0): ?>
    <p>No students have registered yet.</p>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($students as $s): ?>
        <li class="list-group-item d-flex justify-content-between">
          <span><?= htmlspecialchars($s['name']) ?></span>
          <small class="text-muted"><?= htmlspecialchars($s['email']) ?></small>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
