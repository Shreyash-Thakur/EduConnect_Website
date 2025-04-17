<?php include 'includes/header.php'; ?>

<div class="container py-5">
  <h2 class="text-center mb-5 text-primary">
    📚 <strong>Our Programs</strong>
  </h2>

  <div class="row text-center g-5">
    <!-- Online Tutoring -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100 p-4">
        <div class="mb-3 fs-1 text-primary"><i class="bi bi-laptop"></i></div>
        <h4 class="fw-bold">Online Tutoring</h4>
        <p class="text-muted">
          Live interactive classes conducted over Google Meet or Zoom.
          Each session is designed to enhance concept clarity and boost confidence through
          personalized support.
        </p>
        <ul class="text-start small text-secondary ps-3">
          <li>Flexible timing for students</li>
          <li>Covers Maths, Science, English & more</li>
          <li>1:1 or small group sessions</li>
          <li>Practice worksheets included</li>
          <li>Progress tracked for each student</li>
        </ul>
        <p class="mt-2"><em>💡 Ideal for students who need help catching up on fundamentals.</em></p>
      </div>
    </div>

    <!-- Community Centers -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100 p-4">
        <div class="mb-3 fs-1 text-primary"><i class="bi bi-house-door-fill"></i></div>
        <h4 class="fw-bold">Community Learning Centers</h4>
        <p class="text-muted">
          Safe, welcoming environments equipped with digital tools for self-paced and assisted learning. Run by local volunteers and staff.
        </p>
        <ul class="text-start small text-secondary ps-3">
          <li>Wi-Fi enabled rooms</li>
          <li>Access to laptops & tablets</li>
          <li>Scheduled group learning hours</li>
          <li>Workshops, games, books, mentorship</li>
          <li>Parent & community engagement</li>
        </ul>
        <p class="mt-2"><em>🏠 Serving underserved neighborhoods across Mumbai, Delhi & Bengaluru.</em></p>
      </div>
    </div>

    <!-- Skill Training -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100 p-4">
        <div class="mb-3 fs-1 text-primary"><i class="bi bi-lightbulb-fill"></i></div>
        <h4 class="fw-bold">Skill Development & Career Readiness</h4>
        <p class="text-muted">
          Beyond academics – these programs help students build 21st-century skills like coding, communication, and creativity.
        </p>
        <ul class="text-start small text-secondary ps-3">
          <li>Public speaking workshops</li>
          <li>Basic coding & digital tools</li>
          <li>Resume building for teens</li>
          <li>Financial literacy bootcamps</li>
          <li>AI & robotics exposure for older students</li>
        </ul>
        <p class="mt-2"><em>🚀 Prepare students not just to pass, but to succeed in life.</em></p>
      </div>
    </div>
  </div>

  <!-- Repeat some cards to increase scroll length -->
  <div class="row g-5 mt-5">
    <?php for ($i = 0; $i < 3; $i++): ?>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-4">
          <div class="mb-3 fs-1 text-primary"><i class="bi bi-book-fill"></i></div>
          <h4 class="fw-bold">Reading & Writing Clubs</h4>
          <p class="text-muted">
            Weekly sessions to build vocabulary, comprehension and expressive writing. Includes reading circles and short story contests.
          </p>
          <ul class="text-start small text-secondary ps-3">
            <li>English & Hindi sessions</li>
            <li>Weekly reading goals</li>
            <li>Story prompts and journaling</li>
            <li>Poetry & essay competitions</li>
            <li>Guest author sessions</li>
          </ul>
        </div>
      </div>
    <?php endfor; ?>
  </div>

  <div class="my-5 text-center">
    <p class="lead">Want to join or support a program?</p>
    <a href="donate.php" class="btn btn-primary px-4">Donate to a Program</a>
    <a href="register.php" class="btn btn-outline-dark ms-3">Become a Volunteer</a>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'includes/footer.php'; ?>
