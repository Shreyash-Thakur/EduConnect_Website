<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EduConnect</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>

<nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background: linear-gradient(to right, #0d2d3e, #2d5c72);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php" style="background: linear-gradient(to right, #ffffff, #d4e3ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
      EduConnect
    </a>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white <?= $currentPage == 'index.php' ? 'fw-bold text-warning' : '' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $currentPage == 'about.php' ? 'fw-bold text-warning' : '' ?>" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= in_array($currentPage, ['student-dashboard.php', 'programs.php']) ? 'fw-bold text-warning' : '' ?>"
             href="<?= ($_SESSION['role'] ?? '') === 'student' ? 'student-dashboard.php' : 'programs.php' ?>">
             Programs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $currentPage == 'donate.php' ? 'fw-bold text-warning' : '' ?>" href="donate.php">Donate</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $currentPage == 'contact.php' ? 'fw-bold text-warning' : '' ?>" href="contact.php">Contact</a>
        </li>

        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              👤 <?= htmlspecialchars($_SESSION['name']) ?>
              <?php if ($_SESSION['role'] === 'student'): ?>
                <span class="badge bg-danger ms-1">2</span>
              <?php endif; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <?php if ($_SESSION['role'] === 'student'): ?>
                <li><a class="dropdown-item" href="student-dashboard.php">Student Dashboard</a></li>
                <li><a class="dropdown-item" href="student-profile.php">Student Profile</a></li>
              <?php elseif ($_SESSION['role'] === 'volunteer'): ?>
                <li><a class="dropdown-item" href="volunteer-dashboard.php">Volunteer Dashboard</a></li>
              <?php elseif ($_SESSION['role'] === 'admin'): ?>
                <li><a class="dropdown-item" href="admin-dashboard.php">Admin Panel</a></li>
              <?php endif; ?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
          <li class="nav-item"><a class="btn btn-light ms-2" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- ✅ Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
