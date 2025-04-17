<?php
include 'includes/header.php';
include 'auth.php';

// Check program ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<div class='container mt-5'><h4>Invalid Program ID</h4></div>";
  exit;
}

$programId = $_GET['id'];

// Connect to DB
$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$stmt = $pdo->prepare("SELECT * FROM programs WHERE id = ?");
$stmt->execute([$programId]);
$program = $stmt->fetch();

if (!$program) {
  echo "<div class='container mt-5'><h4>Program not found</h4></div>";
  exit;
}

// Subject → Image mapping
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
$imgKey = $map[$program['subject']] ?? 'default';
$imagePath = "images/subjects/$imgKey.jpg";
if (!file_exists($imagePath)) $imagePath = "images/subjects/default.jpg";
?>

<div class="container py-5">
  <div class="card shadow border-0">
    <img src="<?= $imagePath ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?= $program['subject'] ?>">
    <div class="card-body">
      <h3><?= htmlspecialchars($program['title']) ?></h3>
      <p class="text-muted"><?= htmlspecialchars($program['subject']) ?> • <?= date('F j, Y', strtotime($program['date'])) ?> • <?= htmlspecialchars($program['location']) ?></p>
      <hr>
      <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($program['description'])) ?></p>
      <p><strong>Time:</strong> <?= $program['time'] ?> | <strong>Duration:</strong> <?= $program['duration'] ?> hours</p>
      <p><strong>Level:</strong> <?= $program['level'] ?> | <strong>Mode:</strong> <?= ucfirst($program['mode']) ?></p>
      <p><strong>Age Group:</strong> <?= $program['age_group'] ?> | <strong>Capacity:</strong> <?= $program['capacity'] ?></p>

      <?php if ($program['mode'] === 'online' && !empty($program['meet_link'])): ?>
        <p><strong>Google Meet Link:</strong> <a href="<?= $program['meet_link'] ?>" target="_blank"><?= $program['meet_link'] ?></a></p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
