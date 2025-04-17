<?php
session_start();
include 'includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  die("Unauthorized access.");
}

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$student_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT p.id, p.title, p.date, p.time, p.location, p.mode, u.name AS volunteer_name
  FROM enrollments e
  JOIN programs p ON e.program_id = p.id
  JOIN users u ON p.created_by = u.id
  WHERE e.user_id = :student_id
");
$stmt->execute(['student_id' => $student_id]);
$enrollments = $stmt->fetchAll();
?>

<div class="container py-5">
  <h2 class="mb-4 text-primary">📘 My Enrolled Programs</h2>

  <?php if (count($enrollments) === 0): ?>
    <p class="text-muted">You're not enrolled in any programs yet.</p>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach ($enrollments as $p): ?>
        <div class="col-md-6">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
              <p class="text-muted">With <?= htmlspecialchars($p['volunteer_name']) ?></p>
              <p><strong>Date:</strong> <?= $p['date'] ?> | <strong>Time:</strong> <?= $p['time'] ?></p>
              <p><strong>Mode:</strong> <?= htmlspecialchars($p['mode']) ?> (<?= $p['location'] ?>)</p>
              <a href="drop-program.php?program_id=<?= $p['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to drop this program?');">Drop</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
<!-- Motivation Section -->
<div class="container my-5">
  <div class="text-center">
    <blockquote class="blockquote">
      <p class="fs-4 fst-italic">"Education is the most powerful weapon which you can use to change the world."</p>
      <footer class="blockquote-footer text-muted">Nelson Mandela</footer>
    </blockquote>
  </div>
</div>

<!-- Why Staying Enrolled Section -->
<div class="container my-5">
  <h3 class="mb-4 text-primary">📈 Why Staying Enrolled Matters</h3>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title">Consistent Learning</h5>
          <p class="card-text">Stay on track with your academics by attending regular classes and completing your assignments on time.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title">Skill Development</h5>
          <p class="card-text">Learn valuable life and career skills like public speaking, coding, and financial literacy through our sessions.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title">Confidence & Growth</h5>
          <p class="card-text">Engage with mentors, ask questions, and become more confident in your learning journey.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Decorative Spacer -->
<div class="container mb-5">
  <p class="text-muted text-center">
    Keep learning. Keep growing. 🌱
  </p>
</div>

<?php include 'includes/footer.php'; ?>
