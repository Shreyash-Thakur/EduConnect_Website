<?php
include 'includes/header.php';
include 'auth.php';

$pdo = new PDO("mysql:host=localhost;dbname=educonnect_portal", "root", "");
$volunteer_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT p.*, 
    (SELECT COUNT(*) FROM enrollments e WHERE e.program_id = p.id) AS enrolled_count
  FROM programs p
  WHERE p.created_by = :volunteer_id
  ORDER BY p.date ASC
");
$stmt->execute(['volunteer_id' => $volunteer_id]);
$programs = $stmt->fetchAll();
?>

<style>
  body {
    background-color: #f7f9fc;
  }
  .card-program {
    transition: all 0.3s ease-in-out;
    border-radius: 12px;
    overflow: hidden;
    border: none;
  }
  .card-program:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    transform: translateY(-5px);
  }
  .program-image {
    height: 180px;
    object-fit: cover;
    border-bottom: 1px solid #dee2e6;
  }
  .tag-btn {
    padding: 3px 10px;
    font-size: 0.75rem;
    border-radius: 50px;
  }
  .dashboard-btns a {
    font-size: 0.85rem;
  }
  .gradient-header {
    background: linear-gradient(to right, #0d2d3e, #2d5c72);
    color: white;
  }
  .btn-primary {
    background-color: #0d2d3e;
    border-color: #0d2d3e;
  }
  .btn-primary:hover {
    background-color: #103549;
  }
</style>

<div class="container-fluid bg-light py-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <?php $firstLetter = strtoupper(substr($_SESSION['name'], 0, 1)); ?>
          <div style="width: 70px; height: 70px; line-height: 70px; font-size: 28px; background-color: #0d2d3e; color: white; border-radius: 50%; margin: 0 auto;">
            <?= $firstLetter ?>
          </div>
          <h5 class="mt-3 mb-1"><?= htmlspecialchars($_SESSION['name']) ?></h5>
          <p class="text-muted small mb-1"><i class="bi bi-envelope"></i> <?= $_SESSION['email'] ?></p>
          <p class="text-muted small"><i class="bi bi-calendar-event"></i> Joined April 2025</p>
        </div>
      </div>
      <div class="card mt-3 border-0 shadow-sm">
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action active text-white" style="background-color: #0d2d3e;">My Programs</a>
          <a href="#createProgramForm" class="list-group-item list-group-item-action" data-bs-toggle="modal">+ Create New Program</a>
        </div>
      </div>
    </div>

    <!-- Programs Grid -->
    <div class="col-md-9">
      <div class="card shadow-sm border-0">
        <div class="card-header gradient-header d-flex justify-content-between align-items-center rounded-top">
          <h5 class="mb-0">My Programs</h5>
          <div class="btn-group" role="group">
            <button class="btn btn-light btn-sm filter-btn" data-filter="all">All</button>
            <button class="btn btn-outline-light btn-sm filter-btn" data-filter="upcoming">Upcoming</button>
            <button class="btn btn-outline-light btn-sm filter-btn" data-filter="completed">Completed</button>
          </div>
        </div>

        <div class="card-body">
          <?php if (count($programs) === 0): ?>
            <p class="text-center text-muted">You haven’t created any programs yet.</p>
          <?php else: ?>
            <div class="row g-4">
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
              <?php foreach ($programs as $p): ?>
                <?php
                  $subkey = $map[$p['subject']] ?? 'default';
                  $imgPath = "images/subjects/{$subkey}.jpg";
                  if (!file_exists($imgPath)) $imgPath = "images/subjects/default.jpg";
                  $today = date('Y-m-d');
                  $status = ($p['date'] >= $today) ? 'upcoming' : 'completed';
                ?>
                <div class="col-md-6 program-card" data-status="<?= $status ?>">
                  <div class="card card-program shadow-sm">
                    <img src="<?= $imgPath ?>" class="card-img-top program-image" alt="<?= $p['subject'] ?>">
                    <div class="card-body">
                      <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
                      <p class="text-muted small"><?= htmlspecialchars($p['subject']) ?> • <?= date('M d, Y', strtotime($p['date'])) ?> • <?= htmlspecialchars($p['location']) ?></p>
                      <span class="badge bg-<?= $status === 'upcoming' ? 'success' : 'secondary' ?> tag-btn mb-2"><?= ucfirst($status) ?></span>
                      <p class="text-muted small">Enrollment: <?= $p['enrolled_count'] ?>/<?= $p['capacity'] ?></p>
                      <div class="d-flex gap-2 dashboard-btns">
                        <a href="view-program.php?id=<?= $p['id'] ?>" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="edit-program.php?id=<?= $p['id'] ?>" class="btn btn-outline-dark btn-sm">Edit</a>
                        <a href="view-participants.php?id=<?= $p['id'] ?>" class="btn btn-outline-info btn-sm">Participants</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CREATE PROGRAM MODAL -->
<div class="modal fade" id="createProgramForm" tabindex="-1" aria-labelledby="createProgramFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="create-program.php" method="POST" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="createProgramFormLabel">Create New Program</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label>Program Title</label><input type="text" name="title" class="form-control" required></div>
          <div class="col-md-6">
            <label>Subject</label>
            <select name="subject" class="form-select" required>
              <option value="">-- Select --</option>
              <option value="Mathematics">Mathematics</option>
              <option value="Science (General)">Science</option>
              <option value="English Language & Communication">English</option>
              <option value="Hindi & Regional Languages">Hindi</option>
              <option value="Social Studies & Civics">Social Studies</option>
              <option value="Computer Basics & Coding for Kids">Coding</option>
              <option value="AI, Robotics & Technology">Robotics</option>
              <option value="Digital Literacy & Online Safety">Digital Literacy</option>
              <option value="Public Speaking & Soft Skills">Soft Skills</option>
              <option value="Yoga, Fitness & Mental Wellness">Fitness</option>
              <option value="Career Guidance & Resume Building">Career</option>
              <option value="Financial Literacy & Entrepreneurship">Finance</option>
            </select>
          </div>
          <div class="col-md-12"><label>Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
          <div class="col-md-4"><label>Date</label><input type="date" name="date" class="form-control" required></div>
          <div class="col-md-4"><label>Time</label><input type="time" name="time" class="form-control" required></div>
          <div class="col-md-4"><label>Duration (hours)</label><input type="number" name="duration" class="form-control"></div>
          <div class="col-md-6">
            <label>Program Type</label>
            <select name="mode" class="form-select" id="modeSelect" required>
              <option value="online">Online</option>
              <option value="offline">Offline</option>
            </select>
          </div>
          <div class="col-md-6"><label>Venue / Platform</label><input type="text" name="location" class="form-control" required></div>
          <div class="col-md-12" id="meetLinkRow" style="display: none;">
            <label>Meet/Zoom Link</label>
            <input type="url" name="meet_link" class="form-control" placeholder="https://meet.google.com/...">
          </div>
          <div class="col-md-4"><label>Level</label><select name="level" class="form-select"><option>Beginner</option><option>Intermediate</option><option>Advanced</option></select></div>
          <div class="col-md-4"><label>Age Group</label><select name="age_group" class="form-select"><option>6–10</option><option>11–14</option><option>15–18</option></select></div>
          <div class="col-md-4"><label>Max Capacity</label><input type="number" name="capacity" class="form-control" required></div>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="checkbox" required>
          <label class="form-check-label">I confirm I will conduct this program and follow EduConnect guidelines.</label>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="submit">Create Program</button>
      </div>
    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Show/hide meet link
  document.getElementById('modeSelect').addEventListener('change', function () {
    document.getElementById('meetLinkRow').style.display = this.value === 'online' ? 'block' : 'none';
  });

  // Filter logic
  const filterButtons = document.querySelectorAll(".filter-btn");
  const programCards = document.querySelectorAll(".program-card");

  filterButtons.forEach(button => {
    button.addEventListener("click", () => {
      const filter = button.getAttribute("data-filter");

      filterButtons.forEach(btn => btn.classList.remove("btn-light"));
      filterButtons.forEach(btn => btn.classList.add("btn-outline-light"));
      button.classList.remove("btn-outline-light");
      button.classList.add("btn-light");

      programCards.forEach(card => {
        const status = card.getAttribute("data-status");
        card.style.display = (filter === "all" || status === filter) ? "block" : "none";
      });
    });
  });
</script>
