<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/header.php';
include 'auth.php';

// Check if student is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  die("Unauthorized access.");
}

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$student_id = $_SESSION['user_id'];

// Fetch all programs + volunteer name + enrollment stats
$stmt = $pdo->query("
  SELECT 
    p.*, 
    u.name AS volunteer_name,
    (SELECT COUNT(*) FROM enrollments e WHERE e.program_id = p.id) AS enrolled,
    (SELECT COUNT(*) FROM enrollments e WHERE e.program_id = p.id AND e.user_id = $student_id) > 0 AS already_enrolled
  FROM programs p
  JOIN users u ON p.created_by = u.id
  ORDER BY p.date ASC
");

$programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
  <h2 class="mb-4 text-primary">📚 Available Programs</h2>

  <!-- ✅ Show Success/Error Messages -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success text-center"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php endif; ?>
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>

  <?php
    $map = [
      'Mathematics' => 'math',
      'Science (General)' => 'science',
      'English Language & Communication' => 'english',
      'Hindi & Regional Languages' => 'hindi',
      'Social Studies & Civics' => 'socialstudies',
      'Computer Basics & Coding for Kids' => 'coding',
      'AI, Robotics & Technology' => 'robotics',
      'Digital Literacy & Online Safety' => 'digital-literacy',
      'Public Speaking & Soft Skills' => 'softskills',
      'Yoga, Fitness & Mental Wellness' => 'fitness',
      'Career Guidance & Resume Building' => 'career',
      'Financial Literacy & Entrepreneurship' => 'finance'
    ];
  ?>

  <div class="row g-4">
    <?php foreach ($programs as $p): ?>
      <?php
        $subkey = $map[$p['subject']] ?? 'default';
        $imgPath = "images/subjects/{$subkey}.jpg";
        if (!file_exists($imgPath)) $imgPath = "images/subjects/default.jpg";
      ?>
      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <img src="<?= $imgPath ?>" class="card-img-top" alt="<?= $p['subject'] ?>" style="height: 180px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
            <p><strong>Date:</strong> <?= $p['date'] ?></p>
            <p><strong>Time:</strong> <?= $p['time'] ?></p>
            <p><strong>Mode:</strong> <?= htmlspecialchars($p['mode']) ?> (<?= htmlspecialchars($p['location']) ?>)</p>
            <p><strong>Teacher:</strong> <?= htmlspecialchars($p['volunteer_name']) ?></p>
            <p><strong>Seats:</strong> <?= $p['enrolled'] ?>/<?= $p['capacity'] ?></p>

            <?php if ($p['already_enrolled']): ?>
              <button class="btn btn-success btn-sm" disabled>Registered</button>
            <?php elseif ($p['enrolled'] >= $p['capacity']): ?>
              <button class="btn btn-secondary btn-sm" disabled>Full</button>
            <?php else: ?>
              <a href="register-program.php?program_id=<?= $p['id'] ?>" class="btn btn-outline-primary btn-sm">Register</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
