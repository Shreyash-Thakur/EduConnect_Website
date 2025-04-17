<?php include 'includes/header.php'; ?>

<?php
// ✅ Check if the user came via ?program_id=...
$programId = isset($_GET['program_id']) ? intval($_GET['program_id']) : null;
?>

<div class="container py-5">
  <h2 class="text-center text-success mb-4">Register an Account</h2>
  <p class="text-center text-muted mb-4">
    Join us as a volunteer or student and help bridge the education gap for underprivileged children in India.
  </p>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger text-center"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <form action="process-registration.php<?= $programId ? '?program_id=' . $programId : '' ?>" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
    <div class="mb-3">
      <label for="role" class="form-label">Register as</label>
      <select name="role" id="role" class="form-select" onchange="toggleRoleFields()" required>
        <option value="">Select</option>
        <option value="student">Student</option>
        <option value="volunteer">Volunteer</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <!-- Volunteer fields -->
    <div id="volunteerFields" style="display: none;">
      <div class="mb-3">
        <label for="qualification" class="form-label">Qualifications</label>
        <input type="text" name="qualification" id="qualification" class="form-control">
      </div>
      <div class="mb-3">
        <label for="experience" class="form-label">Experience (years)</label>
        <input type="number" name="experience" id="experience" class="form-control" min="0">
      </div>
    </div>

    <!-- Student fields -->
    <div id="studentFields" style="display: none;">
      <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" name="age" id="age" class="form-control" min="5" max="25">
      </div>
      <div class="mb-3">
        <label for="grade" class="form-label">Current Grade/Class</label>
        <input type="text" name="grade" id="grade" class="form-control">
      </div>
      <div class="mb-3">
        <label for="interests" class="form-label">Learning Interests</label>
        <input type="text" name="interests" id="interests" class="form-control" placeholder="e.g. Maths, English, Computers">
      </div>
    </div>

    <button type="submit" class="btn btn-success w-100 mt-4">Register</button>
  </form>
</div>

<script>
function toggleRoleFields() {
  const role = document.getElementById("role").value;
  document.getElementById("volunteerFields").style.display = role === "volunteer" ? "block" : "none";
  document.getElementById("studentFields").style.display = role === "student" ? "block" : "none";
}
</script>

<?php include 'includes/footer.php'; ?>
